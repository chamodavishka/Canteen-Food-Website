<?php
  require '../../config.php';

  // IF customer id empty
  if(empty($_POST["deleteSubmit"])){
    if(empty($_POST["deleteUser"])){
      header("Location: suspendedUsers.php");
    }
  }

  // Get suspend id
  if (isset($_POST["deleteSubmit"])) {
    $suspendId = $_POST["deleteSubmit"];
  }

  // If delete confirmed
  if (isset($_POST["deleteUser"])) {
    $suspendId = $_POST["deleteUser"];

    // Retrieve user details
    $result = mysqli_query($conn,  "SELECT * FROM suspended_customer INNER JOIN customer ON suspended_customer.customer_id = customer.customer_id WHERE suspend_id='$suspendId'");
    $searchRow = mysqli_fetch_assoc($result);
    $customerId = $searchRow["customer_id"];
    $fname = $searchRow["fname"];
    $lname = $searchRow["lname"];
    $email = $searchRow["email"];
    $reg_no = $searchRow["reg_no"];
    $profile_pic = $searchRow["profile_pic"];
    $wallet = $searchRow["wallet"];
    $reason = $searchRow["reason"];
    $reg_date = $searchRow["reg_date"];
    
    // Take current date
    date_default_timezone_set("Asia/Colombo");
    $del_date = date("Y-m-d");

    // Save deleted user details
    $query1 = "INSERT INTO deleted_user VALUES ('','$fname','$lname','$email','$reg_no','$profile_pic','$wallet','$reason','$reg_date','$del_date')";
    mysqli_query($conn,$query1);

    // Delete user
    $query2 = "DELETE FROM customer WHERE customer_id='$customerId'";
    mysqli_query($conn,$query2);

    // Set a window location
    echo "<script>
      let url = 'http://localhost/files/CanteenFCT/admin/user/suspendedUsers.php';
      window.location= url;
    </script>";
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
        // Set a function, window location with suspend id
        function myFunction() {  
          let url = 'http://localhost/files/CanteenFCT/admin/user/suspendedUsers.php#';
          url += "<?=$suspendId; ?>";
          window.location= url;
        }
      </script>
  </head>
  <body>
    <!-- Display model -->
    <div id="id01" class="modal">
      <form class="modal-content animate" action="" method="post" enctype="multipart/form-data">
        <div class="container">
        <span onclick="myFunction()" class="close" title="Close Modal">&times;</span>
          <br><br><img src="images/alert.png" style="width:70px; margin-left:200px;"><br><br>
          <h1 class="textcenter"><span id="demo1"></span></h1>
          <p class="textcenter"><span id="demo2"></span></p>
          <hr>
          
          <div class="clearfix">
            <form action="deleteSusp.php" method="POST">
              <button type="submit" name="deleteUser" value="<?=$suspendId; ?>" class="signupbtn"><span id="demo3"></span></button>
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
          let url = 'http://localhost/files/CanteenFCT/admin/user/suspendedUsers.php#';
          url += "<?=$suspendId; ?>";
          window.location= url;
        }
      }
    </script>
  
  </body>
</html>

<?php
// Show text in model
if (isset($_POST["deleteSubmit"])) {
    echo "<script> 
        document.getElementById('demo1').innerHTML = 'Are you sure?';
        document.getElementById('demo2').innerHTML = 'you will not be able to revert this!';
        document.getElementById('demo3').innerHTML = 'Yes, Delete!';
      </script>";
  }
?>