<?php
require '../../config.php';

if(!isset($_POST["submit_cate"])){
  if(empty($_POST["cateVisible"])){
    if(empty($_POST["cateHide"])){
      header("Location: adCategory.php");
    }
  }
}

if (isset($_POST["cateHide"])) {
  $categoryId = $_POST["cateHide"];
  $query = "UPDATE category SET cate_status='Hidden' WHERE cate_id='$categoryId'";
  mysqli_query($conn,$query);
  echo "<script>
    let url = 'http://localhost/files/CanteenFCT/admin/category/adCategory.php#';
    url += 'Visible';
    window.location= url;
  </script>";
}

if (isset($_POST["cateVisible"])) {
  $categoryId = $_POST["cateVisible"];
  $query = "UPDATE category SET cate_status='Visible' WHERE cate_id='$categoryId'";
  mysqli_query($conn,$query);
  echo "<script>
    let url = 'http://localhost/files/CanteenFCT/admin/category/adCategory.php#';
    url += 'Hidden';
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
  if (isset($_POST["submit_cate"])) {
    $categoryName = $_POST["cate_name"];
    $categoryPic = $_FILES["cate_pic"]["name"];

    $target_dir = "categoryPic/";
    $target_file = $target_dir . basename($_FILES["cate_pic"]["name"]);

    $duplicate = mysqli_query($conn, "SELECT * FROM category WHERE cate_name = '$categoryName'");
    if(mysqli_num_rows($duplicate) > 0) {
      echo "<script> 
        document.getElementById('id01').style.display = 'block';
        document.getElementById('demo1').innerHTML = 'ERROR!';
        document.getElementById('demo2').innerHTML = 'Category Name Already Existing.';
        document.getElementById('demo3').innerHTML = 'Try Again';
      </script>";
    }
    else {
        $query = "INSERT INTO category VALUES('','$categoryName','Visible','$categoryPic')";
        mysqli_query($conn,$query);

        move_uploaded_file($_FILES["cate_pic"]["tmp_name"], $target_file);

        header('Location: adCategory.php');
    }
  }
?>