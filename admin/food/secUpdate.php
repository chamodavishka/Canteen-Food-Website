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

    if(empty($_POST["submit_foodUpdate"])){
        header("Location: adFood.php");
    }

    if (isset($_POST["submit_foodUpdate"])) {
        $foodId = $_POST["submit_foodUpdate"];
        $foodName = $_POST["foodName"];
        $foodPrice = $_POST["foodPrice"];
        $foodQuantity = $_POST["foodQuantity"];
        $foodCategoryId = $_POST["foodCategory"];
        $foodShowcaseId = $_POST["foodShowcase"];
        $foodDescription = $_POST["foodDescription"];
        $selection = $_POST["radio"];
        $refillQuantity = 0;

        if (($selection) != 'null'){
          if (!empty($_POST["refillQuantity1"])) {
            $refillQuantity = $_POST["refillQuantity1"];
          }
          if (!empty($_POST["refillQuantity2"])) {
            $refillQuantity = $_POST["refillQuantity2"];
          }
        } else {
          $refillQuantity = 0;
        }

        

        
        if(!empty($_FILES["foodImage"]["name"])) {
            $foodPic = $_FILES["foodImage"]["name"];
            $target_dir = "foodPic/";
            $target_file = $target_dir . basename($_FILES["foodImage"]["name"]);
            $query = "UPDATE food SET food_pic='$foodPic' WHERE food_id='$foodId'";
            mysqli_query($conn,$query);
            move_uploaded_file($_FILES["foodImage"]["tmp_name"], $target_file);
        }
        $duplicate = mysqli_query($conn, "SELECT * FROM food WHERE food_name = '$foodName' AND food_id != $foodId");
        if(mysqli_num_rows($duplicate) > 0) {
            echo "<script> 
                document.getElementById('id01').style.display = 'block';
                document.getElementById('demo1').innerHTML = 'ERROR!';
                document.getElementById('demo2').innerHTML = 'Food Name Already Existing.';
                document.getElementById('demo3').innerHTML = 'Try Again';
            </script>";
        }
        else {
            $query = "UPDATE food SET food_name='$foodName', food_price='$foodPrice', 
            food_quantity='$foodQuantity', food_description='$foodDescription', refill='$refillQuantity', 
            cate_id='$foodCategoryId', showcase_id='$foodShowcaseId' WHERE food_id='$foodId'";
            mysqli_query($conn,$query);
            echo "<script>
                let url = 'http://localhost/files/CanteenFCT/admin/food/adFood.php#';
                url += $foodId;
                window.location= url;
            </script>";
        }        
    }
?>
