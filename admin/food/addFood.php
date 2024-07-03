<?php
  require '../../config.php';
  $cateResult = "SELECT * FROM category";
  $cateRows = $conn->query($cateResult);

  $showcaseResult = "SELECT * FROM showcase";
  $showcases = $conn->query($showcaseResult);
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

      function abc(x) {
        if(x==0){
          document.getElementById("refillQuantity").type = "number";
        }else{
          document.getElementById("refillQuantity").type = "hidden";
        }
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

        <h2 class="text">ADD - New Food</h2>
        <hr>

        <form action="addFoodAction.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="row">
          <div class="col-25">
            <label for="foodName">Name</label>
          </div>
          <div class="col-75">
            <input type="text" id="foodName" name="foodName" placeholder="Enter Food Name.." required autofocus>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="foodPrice">Price</label>
          </div>
          <div class="col-75">
            <input type="number" id="foodPrice" name="foodPrice" placeholder="Enter Food Price.." min="1" max="999999" required>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="foodQuantity">Quantity</label>
          </div>
          <div class="col-75">
            <input type="number" id="foodQuantity" name="foodQuantity" placeholder="Enter Food Quantity.." min="0" max="999" required>
          </div>
        </div>

        <div class="row">
          <div class="col-25">
            <label for="refillQuantity">Refill</label>
          </div>
          <div class="col-75 radioSelect">
            <input type="radio" name="radio" id="one" class="radio" onclick="abc(0)" checked><span class="radioSpan">Include</span>
            <input type="radio" name="radio" id="two" class="radio" onclick="abc(1)"><span class="radioSpan">Exclude</span>
            <input type="number" style="margin-top:12px" id="refillQuantity" name="refillQuantity" placeholder="Enter Refilling Quantity.." min="0" max="999" required>
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
              <option value="<?php echo $cateRow["cate_id"]; ?>"><?php echo $cateRow["cate_name"]; ?></option>
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
                <option value="<?php echo $showcase["showcase_id"]; ?>"><?php echo $showcase["showcase_name"]; ?></option>
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
            <textarea id="foodDescription" name="foodDescription" placeholder="Enter Food Description.." maxlength="250" required></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="foodImage">Image</label>
          </div>
          <div class="col-75">
            <input type="file" name="foodImage" accept="image/*" id="foodImage" 
              style="display: none; visibility: none;" onchange="getImagePreview(event)" required>            
            <label for="foodImage" style="padding-left:10px;">
              <img src="./images/imageIcon.png" width="30" height="30" style="cursor: pointer;">
            </label>
            <div style="width:70px; height:70px; border: 2px solid #ddd; float:left;" id="preview">
              <img src="./images/image_placeholder.jpg" width="66px" height="66px">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <input type="submit" value="Submit" name="submit_food">
          <button type="button" onclick="document.location='adFood.php'">Cancel</button>
        </div>
        </form>
      </div><br><br>
    </div>

</body>
</html>


