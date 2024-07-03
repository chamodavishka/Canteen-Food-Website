<?php
  require '../../config.php';

  if(empty($_POST["restoreSubmit"])){
    if(empty($_POST["restoreUser"])){
      header("Location: suspendedUsers.php");
    }
  }

  if (isset($_POST["restoreSubmit"])) {
    $suspendId = $_POST["restoreSubmit"];
  }

  if (isset($_POST["restoreUser"])) {
    $suspendId = $_POST["restoreUser"];
    $query = "DELETE FROM suspended_customer WHERE suspend_id='$suspendId'";
    mysqli_query($conn,$query);

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
        function myFunction() {  
          let url = 'http://localhost/files/CanteenFCT/admin/user/suspendedUsers.php#';
          url += "<?=$suspendId; ?>";
          window.location= url;
        }
      </script>
  </head>
  <body>
  <div id="id01" class="modal">
    <form class="modal-content animate" action="" method="post" enctype="multipart/form-data">
      <!--sign up text-->
      <div class="container">
      <span onclick="myFunction()" class="close" title="Close Modal">&times;</span>
        <br><br><img src="images/alert.png" style="width:70px; margin-left:200px;"><br><br>
        <h1 class="textcenter"><span id="demo1"></span></h1>
        <p class="textcenter"><span id="demo2"></span></p>
        <hr>
        
        <div class="clearfix">
          <form action="restoreSusp.php" method="POST">
            <button type="submit" name="restoreUser" value="<?=$suspendId; ?>" class="signupbtn"><span id="demo3"></span></button>
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
if (isset($_POST["restoreSubmit"])) {
    echo "<script> 
        document.getElementById('demo1').innerHTML = 'Are you sure?';
        document.getElementById('demo2').innerHTML = 'User will be restore again!';
        document.getElementById('demo3').innerHTML = 'Yes, Restore!';
      </script>";
  }
?>