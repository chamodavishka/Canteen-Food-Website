<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" type="text/css" href="action.css">
      <script>
        function myFunction() {
          window.location='adCategory.php';
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

    if(empty($_POST["submit_cateUpdate"])){
        header("Location: adCategory.php");
    }

    if (isset($_POST["submit_cateUpdate"])) {
        $categoryId = $_POST["submit_cateUpdate"];
        $categoryName = $_POST["cateName"];
        if(!empty($_FILES["catePic"]["name"])) {
            $categoryPic = $_FILES["catePic"]["name"];
            $target_dir = "categoryPic/";
            $target_file = $target_dir . basename($_FILES["catePic"]["name"]);
            $query = "UPDATE category SET cate_pic='$categoryPic' WHERE cate_id='$categoryId'";
            mysqli_query($conn,$query);
            move_uploaded_file($_FILES["catePic"]["tmp_name"], $target_file);
        }
        $duplicate = mysqli_query($conn, "SELECT * FROM category WHERE cate_name = '$categoryName' AND cate_id != $categoryId");
        if(mysqli_num_rows($duplicate) > 0) {
            echo "<script> 
                document.getElementById('id01').style.display = 'block';
                document.getElementById('demo1').innerHTML = 'ERROR!';
                document.getElementById('demo2').innerHTML = 'Category Name Already Existing.';
                document.getElementById('demo3').innerHTML = 'Try Again';
            </script>";
        }
        else {
            $query = "UPDATE category SET cate_name='$categoryName' WHERE cate_id='$categoryId'";
            mysqli_query($conn,$query);
            echo "<script>
              let url = 'http://localhost/files/CanteenFCT/admin/category/adCategory.php#';
              url += $categoryId;
              window.location= url;
            </script>";
        }        
    }
?>
