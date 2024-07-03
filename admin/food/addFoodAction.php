<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" type="text/css" href="action.css">
      <script>
        function myFunction() {
          window.location='adFood.php';
        }
      </script>
  </head>
  <body>
  <div id="id01" style="display:none;" class="modal">
    
    <form class="modal-content animate" action="" method="post" enctype="multipart/form-data">
      <!--model text-->
      <div class="container">
        <span onclick="myFunction()" class="close" title="Close Modal">&times;</span>
        <br><br><img src="images/alert.png" style="width:70px; margin-left:200px;"><br><br>
        <h1 class="textcenter"><span id="demo1"></span></h1>
        <p class="textcenter"><span id="demo2"></span></p>
        <hr>
        
        <div class="clearfix">
          <button type="button" onclick="myFunction()" class="signupbtn" name="submitup"><span id="demo3"></span></button>
        </div>
      </div>
    </form>
  </div>
<!--link js file-->
  <script src="action.js"></script>
  
  </body>
</html>

<?php
  require '../../config.php';

  if (isset($_POST["submit_food"])) {
    $foodName = $_POST["foodName"];
    $foodPrice = $_POST["foodPrice"];
    $foodQuantity = $_POST["foodQuantity"];
    $foodCategoryId = $_POST["foodCategory"];
    $foodShowcaseId = $_POST["foodShowcase"];
    $foodDescription = $_POST["foodDescription"];
    $foodPic = $_FILES["foodImage"]["name"];
    $refillQuantity = 0;

    if (isset($_POST["refillQuantity"])) {
      $refillQuantity = $_POST["refillQuantity"];
    }

    $target_dir = "foodPic/";
    $target_file = $target_dir . basename($_FILES["foodImage"]["name"]);

    $duplicate = mysqli_query($conn, "SELECT * FROM food WHERE food_name = '$foodName'");
    if(mysqli_num_rows($duplicate) > 0) {
      echo "<script> 
        document.getElementById('id01').style.display = 'block';
        document.getElementById('demo1').innerHTML = 'ERROR!';
        document.getElementById('demo2').innerHTML = 'Food Name Already Existing.';
        document.getElementById('demo3').innerHTML = 'Try Again';

      </script>";
    }
    else {
        $query = "INSERT INTO food VALUES('','$foodName','$foodPrice','$foodQuantity','$foodPic',
        '$foodDescription','$refillQuantity','Visible','$foodShowcaseId','$foodCategoryId')";
        mysqli_query($conn,$query);
        move_uploaded_file($_FILES["foodImage"]["tmp_name"], $target_file);
        header('Location: adFood.php');
    }
  }
?>

