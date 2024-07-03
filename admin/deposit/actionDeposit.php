<?php
  require '../../config.php';

  if(empty($_POST["includeSubmit"])){
    if(empty($_POST["excludeSubmit"])){
      if(empty($_POST["confirmAction"])){
        header("Location: adDeposit.php");
      }
    }
  }

  if (isset($_POST["includeSubmit"])) {
    $userId = $_POST["includeSubmit"];
    $amount = $_POST["amountDeposit"];
    $depositStatus = "Include";
  }

  if (isset($_POST["excludeSubmit"])) {
    $userId = $_POST["excludeSubmit"];
    $amount = $_POST["amountDeposit"];
    $depositStatus = "Exclude";
  }

  if (isset($_POST["confirmAction"])) {
    $userId = $_POST["confirmAction"];
    $amount = $_POST["amountDeposit2"];
    $statusDeposit = $_POST["statusDeposit"];
    $result = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id='$userId'");
    $row = mysqli_fetch_assoc($result);

    date_default_timezone_set("Asia/Colombo");
    $dateTime = date("Y-m-d H:i:s");

    $walletAmount = $row['wallet'];

    if ($statusDeposit == "Include"){
      $newWalletAmount = $walletAmount + $amount;

      $query1 = "UPDATE customer SET wallet='$newWalletAmount' WHERE customer_id='$userId'";
      mysqli_query($conn,$query1);

      $query2 = "INSERT INTO deposit VALUES ('','$amount','$newWalletAmount','$dateTime','$statusDeposit','$userId')";
      mysqli_query($conn,$query2);

      header("Location: adDeposit.php");
    } else {
      if($walletAmount >= $amount){
        $newWalletAmount = $walletAmount - $amount;

        $query1 = "UPDATE customer SET wallet='$newWalletAmount' WHERE customer_id='$userId'";
        mysqli_query($conn,$query1);

        $query2 = "INSERT INTO deposit VALUES ('','$amount','$newWalletAmount','$dateTime','$statusDeposit','$userId')";
        mysqli_query($conn,$query2);

        header("Location: adDeposit.php");
      } else {
        header("Location: excludeAlert.php");
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" type="text/css" href="action.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
      <script>
        function myFunction() {  
          let url = 'http://localhost/files/CanteenFCT/admin/Deposit/adDeposit.php';
          window.location= url;
        }
      </script>
  </head>
  <body>
  <div id="id01" class="modal">
    <form class="modal-content animate" action="" method="post">
      <!--sign up text-->
      <div class="container">
      <span onclick="myFunction()" class="close" title="Close Modal">&times;</span>
        <br><br><img src="images/alert.png" style="width:70px; margin-left:200px;"><br><br>
        <h1 class="textcenter"><span id="demo1"></span></h1>
        <p class="textcenter">Amount: <span style="font-weight: bold;" id="demo2"></span></p>
        <hr>
        
        <div class="clearfix">
          <form action="actionDelete.php" method="POST">
          <input type="hidden" id="amountDeposit2" name="amountDeposit2" value="<?=$amount; ?>">
          <input type="hidden" id="statusDeposit" name="statusDeposit" value="<?=$depositStatus; ?>">
            <button type="submit" name="confirmAction" value="<?=$userId; ?>" class="signupbtn"><span id="demo3"></span></button>
          </form>
        </div>
      </div>
    </form>
  </div>

  <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
      let url = 'http://localhost/files/CanteenFCT/admin/Deposit/adDeposit.php';
      window.location= url;
      }
    }
  </script>
  
  <?php
    if (isset($_POST["includeSubmit"])) {
      echo "<script> 
          document.getElementById('demo1').innerHTML = 'Are you sure?';
          document.getElementById('demo2').innerHTML = 'Rs. $amount';
          document.getElementById('demo3').innerHTML = 'Yes, Include it!';
        </script>";
    }

    if (isset($_POST["excludeSubmit"])) {
      echo "<script> 
          document.getElementById('demo1').innerHTML = 'Are you sure?';
          document.getElementById('demo2').innerHTML = 'Rs. $amount';
          document.getElementById('demo3').innerHTML = 'Yes, Exclude it!';
        </script>";
    }
  ?>
  </body>
</html>