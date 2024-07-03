<?php
  require '../../config.php';

  if(empty($_POST["foodUpdate"])){
    if(empty($_POST["submit_cateUpdate"])){
      header("Location: adFood.php");
    }
  }

  if (isset($_POST["foodUpdate"])) {
    $foodId = $_POST["foodUpdate"];
    $result = mysqli_query($conn, "SELECT * FROM food WHERE food_id = '$foodId'");
    $foodRow = mysqli_fetch_assoc($result);
  }

  $cateResult = "SELECT * FROM category";
  $cateRows = $conn->query($cateResult);

  $showcaseResult = "SELECT * FROM showcase";
  $showcases = $conn->query($showcaseResult);

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
    $query = "UPDATE category SET cate_name='$categoryName' WHERE cate_id='$categoryId'";
    mysqli_query($conn,$query);

    echo "<script>
      let url = 'http://localhost/files/CanteenFCT/admin/category/adCategory.php#';
      url += $categoryId;
      window.location= url;
    </script>";
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin FCT Canteen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="addFood.css">

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

      function abc(x,y) {
        if (x==0 ){
          if(y==0){
            document.getElementById("refillQuantity2").type = "number";
          }else{
            document.getElementById("refillQuantity2").type = "hidden";
            document.getElementById("refillQuantity1").type = "hidden";
          }
        } else {
            if(y==0){
              document.getElementById("refillQuantity1").type = "number";
            }else{
              document.getElementById("refillQuantity1").type = "hidden";
              document.getElementById("refillQuantity2").type = "hidden";
            }
        }
      }
  </script>
  <script>
      function cancelFunction(value) {
          let url = 'http://localhost/files/CanteenFCT/admin/food/adFood.php#';
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
        <li><a href="http://localhost/files/CanteenFCT/admin/category/adCategory.php">CATEGORIES</a></li>
        <li><a class="current" href="http://localhost/files/CanteenFCT/admin/food/adFood.php">FOODS</a></li>
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

      <div class="container">

        <h2 class="text">Update Food - <?=$foodRow["food_name"]; ?></h2>
        <hr>

        <form action="secUpdate.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="row">
          <div class="col-25">
            <label for="foodName">Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="foodName" name="foodName" value="<?=$foodRow["food_name"]; ?>" required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="foodPrice">Price</label>
          </div>
          <div class="col-75">
            <input type="number" id="foodPrice" name="foodPrice" value="<?=$foodRow["food_price"]; ?>" min="1" max="999999" required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="foodQuantity">Quantity</label>
          </div>
          <div class="col-75">
            <input type="number" id="foodQuantity" name="foodQuantity" value="<?=$foodRow["food_quantity"]; ?>" min="0" max="999" required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="refillQuantity">Refill</label>
          </div>
          <?php 
            $refillType1 = "number";
            $refillType2 = "hidden";
            if(($foodRow["refill"]) == 0) {
              $refillType1 = "hidden";
            }
          ?>
          <div class="col-75 radioSelect">
            <input type="radio" name="radio" id="one" class="radio" value="<?=$foodRow["refill"]; ?>" onclick="abc(this.value,0)" <?php if(($foodRow["refill"])>0){echo "checked";}?>><span class="radioSpan">Include</span>
            <input type="radio" name="radio" id="two" class="radio" value="null" onclick="abc(this.value,1)" <?php if(($foodRow["refill"])==0){echo "checked";}?>><span class="radioSpan">Exclude</span>
            <input type="<?=$refillType1; ?>" style="margin-top:12px" id="refillQuantity1" name="refillQuantity1" value="<?=$foodRow["refill"]; ?>" min="1" max="999" required>
            <input type="<?=$refillType2; ?>" style="margin-top:12px" id="refillQuantity2" name="refillQuantity2" placeholder="Enter Refilling Quantity.." min="1" max="999" required>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="foodCategory">Category</label>
          </div>
          <div class="col-75">
            <select id="foodCategory" name="foodCategory">
            <?php
              while($cateRow = mysqli_fetch_assoc($cateRows)){
            ?>
              <option value="<?php echo $cateRow["cate_id"]; ?>" <?php if(($cateRow["cate_id"])==($foodRow["cate_id"])){echo "selected";} ?>><?php echo $cateRow["cate_name"]; ?></option>
            <?php
              }
            ?> 
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="foodShowcase">Showcase</label>
          </div>
          <div class="col-75">
            <select id="foodShowcase" name="foodShowcase">
              <?php
                while($showcase = mysqli_fetch_assoc($showcases)){
              ?>
                <option value="<?php echo $showcase["showcase_id"]; ?>" <?php if(($showcase["showcase_id"])==($foodRow["showcase_id"])){echo "selected";} ?>><?php echo $showcase["showcase_name"]; ?></option>
              <?php
                }
              ?> 
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="foodDescription">Description</label>
          </div>
          <div class="col-75">
            <textarea id="foodDescription" name="foodDescription" maxlength="250" required><?=$foodRow["food_description"]; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="foodImage">Image</label>
          </div>
          <div class="col-75">
            <input type="file" name="foodImage" accept="image/*" id="foodImage" 
              style="display: none; visibility: none;" onchange="getImagePreview(event)">            
            <label for="foodImage" style="padding-left:10px;">
              <img src="./images/image-editing.png" width="30" height="30" style="cursor: pointer;">
            </label>
            <div style="width:70px; height:70px; border: 2px solid #ddd; float:left;" id="preview">
              <img src="foodPic/<?php echo $foodRow["food_pic"]; ?>" width="66px" height="66px">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <button type="submit" class="buttonUpdate" name="submit_foodUpdate" value="<?=$foodRow["food_id"]; ?>">Save</button>
          <button type="button" class="buttonCancel" name="cancel" value="<?=$foodRow["food_id"]; ?>" onclick="cancelFunction(this.value)">Cancel</button>
        </div>
        </form>
      </div><br><br>
    </div>

</body>
</html>