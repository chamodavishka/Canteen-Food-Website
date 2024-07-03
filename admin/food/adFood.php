<?php
    require '../../config.php';

    $cateResult = "SELECT * FROM category";
    $cateRows = $conn->query($cateResult);


    $columnName = "food_id";
    $order = "DESC";
    
    if (empty($_SESSION['command'])) {
        $command = "latest";
    } else {
        $command = $_SESSION['command'];
    }

    if (isset($_GET['foodColumnName']) && isset($_GET['foodOrder']) && isset($_GET['foodCommand']) && isset($_GET['foodShowIdConfirm'])){
        $columnName = $_GET['foodColumnName'];
        $order = $_GET['foodOrder'];
        $command = $_GET['foodCommand'];
        $foodShowIdConfirm = $_GET['foodShowIdConfirm'];
        $_SESSION['columnName'] = $columnName;
        $_SESSION['order'] = $order;
        $_SESSION['command'] = $command;
        $_SESSION['foodShowIdConfirm'] = $foodShowIdConfirm;
        $_SESSION['lastSelectedTime'] = time();
    }

    if (isset($_GET['commandShow']) && isset($_GET['foodShowIdConfirm'])) {
        $commandShow = $_GET['commandShow'];
        $foodShowIdConfirm = $_GET['foodShowIdConfirm'];
        $_SESSION['foodShowIdConfirm'] = $foodShowIdConfirm;
        $_SESSION['commandShow'] = $commandShow;
        $_SESSION['lastSelectedTime'] = time();
    }

    if (!empty($_SESSION['command']) || !empty($_SESSION['commandShow'])) {
      if (!empty($_SESSION['lastSelectedTime'])) {
        if((time() - $_SESSION['lastSelectedTime']) > 900) {
          unset($_SESSION['command']);
          unset($_SESSION['commandShow']);
          $command = "latest";
          $columnName = "food_id";
          $order = "DESC";
          $commandShow = 'both';
        }
      }
    }
    
    if (empty($_SESSION['commandShow'])) {
      $commandShow = "both";
      $_SESSION['commandShow'] = 'nothing';
    } else {
      $commandShow = $_SESSION['commandShow'];
    }

    if (($_SESSION['commandShow']) == 'onlyVisible') {
      if (empty($_SESSION['command'])) {
        $foodResultVisible = "SELECT * FROM food WHERE food_status='Visible' ORDER BY $columnName $order";
        $foodRowsVisible = $conn->query($foodResultVisible);

        $foodResultHidden = "SELECT * FROM food WHERE food_status='Nothing' ORDER BY $columnName $order";
        $foodRowsHidden = $conn->query($foodResultHidden);
      } else {
        $fname = $_SESSION['columnName'];
        $forder = $_SESSION['order'];

        $foodResultVisible = "SELECT * FROM food WHERE food_status='Visible' ORDER BY $fname $forder";
        $foodRowsVisible = $conn->query($foodResultVisible);

        $foodResultHidden = "SELECT * FROM food WHERE food_status='Nothing' ORDER BY $fname $forder";
        $foodRowsHidden = $conn->query($foodResultHidden);
      }
    } elseif (($_SESSION['commandShow']) == 'onlyHidden') {
      if (empty($_SESSION['command'])) {
        $foodResultVisible = "SELECT * FROM food WHERE food_status='Nothing' ORDER BY $columnName $order";
        $foodRowsVisible = $conn->query($foodResultVisible);

        $foodResultHidden = "SELECT * FROM food WHERE food_status='Hidden' ORDER BY $columnName $order";
        $foodRowsHidden = $conn->query($foodResultHidden);
    } else {
        $fname = $_SESSION['columnName'];
        $forder = $_SESSION['order'];

        $foodResultVisible = "SELECT * FROM food WHERE food_status='Nothing' ORDER BY $fname $forder";
        $foodRowsVisible = $conn->query($foodResultVisible);

        $foodResultHidden = "SELECT * FROM food WHERE food_status='Hidden' ORDER BY $fname $forder";
        $foodRowsHidden = $conn->query($foodResultHidden);
      }
    } else {
      if (empty($_SESSION['command'])) {
          $foodResultVisible = "SELECT * FROM food WHERE food_status='Visible' ORDER BY $columnName $order";
          $foodRowsVisible = $conn->query($foodResultVisible);

          $foodResultHidden = "SELECT * FROM food WHERE food_status='Hidden' ORDER BY $columnName $order";
          $foodRowsHidden = $conn->query($foodResultHidden);
      } else {
          $fname = $_SESSION['columnName'];
          $forder = $_SESSION['order'];

          $foodResultVisible = "SELECT * FROM food WHERE food_status='Visible' ORDER BY $fname $forder";
          $foodRowsVisible = $conn->query($foodResultVisible);

          $foodResultHidden = "SELECT * FROM food WHERE food_status='Hidden' ORDER BY $fname $forder";
          $foodRowsHidden = $conn->query($foodResultHidden);
      }
      
    }
    if (!empty($_SESSION['foodShowIdConfirm'])) {
      unset($_SESSION['foodShowIdConfirm']);
      echo "<script>
      let url = 'http://localhost/files/CanteenFCT/admin/food/adFood.php#cateShow';
      window.location= url;
      </script>";
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin FCT Canteen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adFood.css">
    <link rel="stylesheet" type="text/css" href="refill.css">
    <link rel="stylesheet" type="text/css" href="addCateMod.css">

    <script>
      function getImagePreview(event){
        var image=URL.createObjectURL(event.target.files[0]);
        var imagediv= document.getElementById('preview1');
        var newimg=document.createElement('img');
        imagediv.innerHTML='';
        newimg.src=image;
        newimg.width="70";
        newimg.height="70";    
        imagediv.appendChild(newimg);
      }
      
      function getValue(svalue) {
        let columnName="";
        let order="";
        switch (svalue) {
          case "nameDESC":
            columnName = "food_name";
            order = "DESC";
            break;
          case "earliest":
            columnName = "food_id";
            order = "ASC";
            break;
          case "nameASC":
            columnName = "food_name";
            order = "ASC";
            break;
          default:
            columnName = "food_id";
            order = "DESC";
        }
        let foodShowIdConfirm = "confirm";
        let url = "http://localhost/files/CanteenFCT/admin/food/adFood.php"
        window.location.href = url+"?foodColumnName="+columnName+"&foodOrder="+order+"&foodCommand="+svalue+"&foodShowIdConfirm="+foodShowIdConfirm;
      }

      function getValueShow(svalue) {
        let foodShowIdConfirm = "confirm";
        let url = "http://localhost/files/CanteenFCT/admin/food/adFood.php"
        window.location.href = url+"?commandShow="+svalue+"&foodShowIdConfirm="+foodShowIdConfirm;
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
      
      <!-- Display food -->   
      <div class="cateShowDiv">
        
        <br><br>
        <button onclick="document.location='addFood.php'" class="refillbtn">Add</button>
        <button onclick="document.getElementById('id01').style.display='block'"class="refillbtn">Refill</button>
        <span style="margin-left: 2%; color: #666;"><b>Sort: </b></span>
          <select id="cateSort" style="width:auto;" onchange="getValue(this.options[this.selectedIndex].value)">
            <option value="latest" <?php if ($command == "latest") {echo "selected";} ?>>Latest Created Food</option>
            <option value="earliest" <?php if ($command == "earliest") {echo "selected";} ?>>Earliest Created Food</option>
            <option value="nameASC" <?php if ($command == "nameASC") {echo "selected";} ?>>Food Name Ascending Order</option>
            <option value="nameDESC" <?php if ($command == "nameDESC") {echo "selected";} ?>>Food Name Descending Order</option>
          </select>

          <span style="margin-left: 2%; color: #666;"><b>Show: </b></span>
          <select id="cateSort" style="width:auto;" onchange="getValueShow(this.options[this.selectedIndex].value)">
            <option value="both" <?php if ($commandShow == "both") {echo "selected";} ?>>Both Visible and Hidden Food</option>
            <option value="onlyVisible" <?php if ($commandShow == "onlyVisible") {echo "selected";} ?>>Visible Food Only</option>
            <option value="onlyHidden" <?php if ($commandShow == "onlyHidden") {echo "selected";} ?>>Hidden Food Only</option>
          </select>
          <br>

        <!-- Display visible food -->
        <table class="cateItem">
        
        <?php
            if(mysqli_num_rows($foodRowsVisible)>0) {
        ?>
              <tr id = "Visible"><th style="border-top: none;" colspan="9">VISIBLE FOODS</th></tr>
        <?php
            }
            while($foodRow = mysqli_fetch_assoc($foodRowsVisible)){
        ?>
            <tr id="<?=$foodRow["food_id"]; ?>">
                <td><image src="foodPic/<?php echo $foodRow["food_pic"]; ?>" width="90px" height="75px"></td>
                <td><h4><?php echo $foodRow["food_name"]; ?></h4></td>
                <td><h4>Rs. <?php echo $foodRow["food_price"]; ?></h4></td>
                <td><h4>Qty <?php echo $foodRow["food_quantity"]; ?></h4></td>
                <td><h4>SC <?php if(($foodRow["showcase_id"])!=0){echo $foodRow["showcase_id"];}else{echo "null";} ?></h4></td>

                <td>
                    <form action="foodView.php" method="POST" target="_blank">
                        <button type="submit" class="viewCateButton" name="foodView" value="<?=$foodRow["food_id"]; ?>">View</button>
                    </form>
                </td>
                <td>
                    <form action="action.php" method="POST">
                        <button type="submit" class="hideCateButton" name="foodHide" value="<?=$foodRow["food_id"]; ?>">Hide</button>
                    </form>
                </td>
                <td>
                    <form action="actionUpdate.php" method="POST">
                        <button type="submit" class="editCateButton" name="foodUpdate" value="<?=$foodRow["food_id"]; ?>">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="actionDelete.php" method="POST">
                        <button type="submit" class="deleteCateButton" name="foodDeleteWarning" value="<?=$foodRow["food_id"]; ?>">Delete</button>
                    </form>
                </td>
            </tr>
        <?php
            }
        //Display hidden food
            if (mysqli_num_rows($foodRowsHidden)>0) {
        ?>
              <tr id = "Hidden"><th colspan="9">HIDDEN FOODS</th></tr>
        <?php
            }
            while($foodRow = mysqli_fetch_assoc($foodRowsHidden)){
        ?>
            <tr id="<?=$foodRow["food_id"]; ?>">
                <td><image src="foodPic/<?php echo $foodRow["food_pic"]; ?>" width="90px" height="75px"></td>
                <td><h4><?php echo $foodRow["food_name"]; ?></h4></td>
                <td><h4>Rs. <?php echo $foodRow["food_price"]; ?></h4></td>
                <td><h4>Qty <?php echo $foodRow["food_quantity"]; ?></h4></td>
                <td><h4>SC <?php if(($foodRow["showcase_id"])!=0){echo $foodRow["showcase_id"];}else{echo "null";} ?></h4></td>

                <td>
                    <form action="foodView.php" method="POST" target="_blank">
                        <button type="submit" class="viewCateButton" name="foodView" value="<?=$foodRow["food_id"]; ?>">View</button>
                    </form>
                </td>
                <td>
                    <form action="action.php" method="POST">
                        <button type="submit" class="hideCateButton" name="foodVisible" value="<?=$foodRow["food_id"]; ?>">Visible</button>
                    </form>
                </td>
                <td>
                    <form action="actionUpdate.php" method="POST">
                        <button type="submit" class="editCateButton" name="foodUpdate" value="<?=$foodRow["food_id"]; ?>">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="actionDelete.php" method="POST">
                        <button type="submit" class="deleteCateButton" name="foodDeleteWarning" value="<?=$foodRow["food_id"]; ?>">Delete</button>
                    </form>
                </td>
            </tr>
        <?php
            }
        ?>
        </table>
      </div>

    </div><br><br>

    

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="refillAction.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      
    <h2 style="text-align: center; margin: 24px 0 12px 0; position: relative; color:#555;">Refill - Food Quantity</h2>
    <hr  class="hr2">

  <div class="row">
    <div class="col-25">
      <label for="foodCategory">Category</label>
    </div>
    <div class="col-75">
      <select class="select1" id="foodCategory" name="foodCategory">
        <option value="all">All Categories</option>
      <?php
        while($cateRowR = mysqli_fetch_assoc($cateRows)){
      ?>
        <option value="<?php echo $cateRowR["cate_id"]; ?>"><?php echo $cateRowR["cate_name"]; ?></option>
      <?php
        }
      ?> 
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="foodFilter">Filter</label>
    </div>
    <div class="col-75">
      <select class="select1" id="foodFilter" name="foodFilter">
          <option value="all">All Foods</option>
          <option value="out">Only Sold Out</option>
      </select>
    </div>
  </div>
  
  <div class="row">
    <input type="submit" value="Submit" name="submit_refill">
    <button type="button" class="cnbutton" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
  </div>

    </div>
  </form>
</div>

<script>
// Get the modal
var modal1 = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}
</script>
  </body>
</html>