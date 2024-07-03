<?php
  require '../../config.php';

  if(empty($_POST["cateUpdate"])){
      header("Location: adCategory.php");
  }

  if (isset($_POST["cateUpdate"])) {
    $cateId = $_POST["cateUpdate"];
    $result = mysqli_query($conn, "SELECT * FROM category WHERE cate_id = '$cateId'");
    $cateRow = mysqli_fetch_assoc($result);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="update.css">
    <script>
        function getImagePreview(event){
            var image=URL.createObjectURL(event.target.files[0]);
            var imagediv= document.getElementById('preview');
            var newimg=document.createElement('img');
            imagediv.innerHTML='';
            newimg.src=image;
            newimg.width="66";
            newimg.height="66";
            imagediv.appendChild(newimg);
        }
    </script>

    <script>
        function cancelFunction(value) {
          let url = 'http://localhost/files/CanteenFCT/admin/category/adCategory.php#';
          url += value;
          window.location= url;
        }
    </script>

  </head>
  <body>

    <div class="mainSideNav">
      <h1 style="color: #444; font-family: 'Franklin Gothic Medium', 
        'Arial Narrow', Arial, sans-serif; font-weight: bold; text-align: center;">FCT Canteen</h1>
      <ul class="sidenav">
        <li><a href="http://localhost/files/CanteenFCT/admin/dashboard/dashboard.php">DASHBOARD</a></li>
        <li><a class="current" href="http://localhost/files/CanteenFCT/admin/category/adCategory.php">CATEGORIES</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/food/adFood.php">FOODS</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/order/adOrder.php">ORDERS</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/sensor/sensor.php">SENSORS</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/deposit/adDeposit.php">DEPOSIT</a></li>
        <li><a href="#CONTACT">MESSAGES</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/user/adUser.php">USERS</a></li>
        <li><a href="#CONTACT">SETTINGS</a></li>
        <li><a href="#CONTACT">LOGOUT</a></li>
      </ul>
    </div>

    <div class="content"><br><br>

      <div class="containerUpdate">
        <h2 class="text">UPDATE Category - <?=$cateRow["cate_name"]; ?></h2>
        <hr>

        <form action="secActionUpdate.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-25">
              <label for="cateName">Category Name:</label>
            </div>
            <div class="col-75">
              <input type="text" id="cateName" name="cateName" value="<?=$cateRow["cate_name"]; ?>" required>
            </div>
          </div>

          <div class="row">
            <div class="col-25">
              <label for="catePic">Category Image:</label>
            </div>
            <div class="col-75">
              <input type="file" name="catePic" accept="image/*" id="catePic" 
                style="display: none; visibility: none;" onchange="getImagePreview(event)">            
              <label for="catePic" style="padding-left:10px;">
                <img src="./images/image-editing.png" width="30" height="30" style="cursor: pointer;">
              </label>
              <div style="width:70px; height:70px; border: 2px solid #ddd; float:left;" id="preview">
                <img src="categoryPic/<?php echo $cateRow["cate_pic"]; ?>" alt="" width="66px" height="66px">
              </div>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="buttonSubmit" name="submit_cateUpdate" value="<?=$cateRow["cate_id"]; ?>">Save</button>
            <button type="button" class="buttonCancel" name="cancel" value="<?=$cateRow["cate_id"]; ?>" onclick="cancelFunction(this.value)">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  
  </body>
</html>
