<?php
    require '../../config.php';

    $cateResult = "SELECT * FROM category";
    $cateRows = $conn->query($cateResult);


    $columnName = "cate_id";
    $order = "DESC";
    
    if (empty($_SESSION['commandCate'])) {
        $command = "latest";
    } else {
        $command = $_SESSION['commandCate'];
    }

    if (isset($_GET['cateColumnName']) && isset($_GET['cateOrder']) && isset($_GET['cateCommand']) && isset($_GET['cateShowIdConfirm'])){
        $columnName = $_GET['cateColumnName'];
        $order = $_GET['cateOrder'];
        $command = $_GET['cateCommand'];
        $cateShowIdConfirm = $_GET['cateShowIdConfirm'];
        $_SESSION['columnNameCate'] = $columnName;
        $_SESSION['orderCate'] = $order;
        $_SESSION['commandCate'] = $command;
        $_SESSION['cateShowIdConfirm'] = $cateShowIdConfirm;
        $_SESSION['lastSelectedTimeCate'] = time();
    }

    if (isset($_GET['commandShow']) && isset($_GET['cateShowIdConfirm'])) {
        $commandShow = $_GET['commandShow'];
        $cateShowIdConfirm = $_GET['cateShowIdConfirm'];
        $_SESSION['cateShowIdConfirm'] = $cateShowIdConfirm;
        $_SESSION['commandShowCate'] = $commandShow;
        $_SESSION['lastSelectedTimeCate'] = time();
    }

    if (!empty($_SESSION['commandCate']) || !empty($_SESSION['commandShowCate'])) {
      if (!empty($_SESSION['lastSelectedTimeCate'])) {
        if((time() - $_SESSION['lastSelectedTimeCate']) > 900) {
          unset($_SESSION['commandCate']);
          unset($_SESSION['commandShowCate']);
          $command = "latest";
          $columnName = "cate_id";
          $order = "DESC";
          $commandShow = 'both';
        }
      }
    }
    
    if (empty($_SESSION['commandShowCate'])) {
      $commandShow = "both";
      $_SESSION['commandShowCate'] = 'nothing';
    } else {
      $commandShow = $_SESSION['commandShowCate'];
    }

    if (($_SESSION['commandShowCate']) == 'onlyVisible') {
      if (empty($_SESSION['commandCate'])) {
        $cateResultVisible = "SELECT * FROM category WHERE cate_status='Visible' ORDER BY $columnName $order";
        $cateRowsVisible = $conn->query($cateResultVisible);

        $cateResultHidden = "SELECT * FROM category WHERE cate_status='Nothing' ORDER BY $columnName $order";
        $cateRowsHidden = $conn->query($cateResultHidden);
      } else {
        $cname = $_SESSION['columnNameCate'];
        $corder = $_SESSION['orderCate'];

        $cateResultVisible = "SELECT * FROM category WHERE cate_status='Visible' ORDER BY $cname $corder";
        $cateRowsVisible = $conn->query($cateResultVisible);

        $cateResultHidden = "SELECT * FROM category WHERE cate_status='Nothing' ORDER BY $cname $corder";
        $cateRowsHidden = $conn->query($cateResultHidden);
      }
    } elseif (($_SESSION['commandShowCate']) == 'onlyHidden') {
      if (empty($_SESSION['commandCate'])) {
        $cateResultVisible = "SELECT * FROM category WHERE cate_status='Nothing' ORDER BY $columnName $order";
        $cateRowsVisible = $conn->query($cateResultVisible);

        $cateResultHidden = "SELECT * FROM category WHERE cate_status='Hidden' ORDER BY $columnName $order";
        $cateRowsHidden = $conn->query($cateResultHidden);
    } else {
        $cname = $_SESSION['columnNameCate'];
        $corder = $_SESSION['orderCate'];

        $cateResultVisible = "SELECT * FROM category WHERE cate_status='Nothing' ORDER BY $cname $corder";
        $cateRowsVisible = $conn->query($cateResultVisible);

         $cateResultHidden = "SELECT * FROM category WHERE cate_status='Hidden' ORDER BY $cname $corder";
        $cateRowsHidden = $conn->query($cateResultHidden);
      }
    } else {
      if (empty($_SESSION['commandCate'])) {
          $cateResultVisible = "SELECT * FROM category WHERE cate_status='Visible' ORDER BY $columnName $order";
          $cateRowsVisible = $conn->query($cateResultVisible);

          $cateResultHidden = "SELECT * FROM category WHERE cate_status='Hidden' ORDER BY $columnName $order";
          $cateRowsHidden = $conn->query($cateResultHidden);
      } else {
          $cname = $_SESSION['columnNameCate'];
          $corder = $_SESSION['orderCate'];

          $cateResultVisible = "SELECT * FROM category WHERE cate_status='Visible' ORDER BY $cname $corder";
          $cateRowsVisible = $conn->query($cateResultVisible);

           $cateResultHidden = "SELECT * FROM category WHERE cate_status='Hidden' ORDER BY $cname $corder";
          $cateRowsHidden = $conn->query($cateResultHidden);
      }
      
    }
    if (!empty($_SESSION['cateShowIdConfirm'])) {
      unset($_SESSION['cateShowIdConfirm']);
      echo "<script>
      let url = 'http://localhost/files/CanteenFCT/admin/category/adCategory.php#cateShow';
      window.location= url;
      </script>";
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin FCT Canteen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adCategory.css">
    <link rel="stylesheet" type="text/css" href="refill.css">
    <link rel="stylesheet" type="text/css" href="addCateMod.css">
    <link rel="stylesheet" type="text/css" href="delModel.css">

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
            columnName = "cate_name";
            order = "DESC";
            break;
          case "earliest":
            columnName = "cate_id";
            order = "ASC";
            break;
          case "nameASC":
            columnName = "cate_name";
            order = "ASC";
            break;
          default:
            columnName = "cate_id";
            order = "DESC";
        }
        let cateShowIdConfirm = "confirm";
        let url = "http://localhost/files/CanteenFCT/admin/category/adCategory.php"
        window.location.href = url+"?cateColumnName="+columnName+"&cateOrder="+order+"&cateCommand="+svalue+"&cateShowIdConfirm="+cateShowIdConfirm;
      }

      function getValueShow(svalue) {
        let cateShowIdConfirm = "confirm";
        let url = "http://localhost/files/CanteenFCT/admin/category/adCategory.php"
        window.location.href = url+"?commandShow="+svalue+"&cateShowIdConfirm="+cateShowIdConfirm;
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

      <!-- Display category -->   
      <div class="cateShowDiv">
        
        <br><br>
        <button onclick="document.getElementById('id02').style.display='block'" class="refillbtn">Add</button>
        <button onclick="document.getElementById('id01').style.display='block'" class="refillbtn">Refill</button>
        <span style="margin-left: 2%; color: #666;"><b>Sort: </b></span>
          <select id="cateSort" style="width:auto;" onchange="getValue(this.options[this.selectedIndex].value)">
            <option value="latest" <?php if ($command == "latest") {echo "selected";} ?>>Latest Created Category</option>
            <option value="earliest" <?php if ($command == "earliest") {echo "selected";} ?>>Earliest Created Category</option>
            <option value="nameASC" <?php if ($command == "nameASC") {echo "selected";} ?>>Category Name Ascending Order</option>
            <option value="nameDESC" <?php if ($command == "nameDESC") {echo "selected";} ?>>Category Name Descending Order</option>
          </select>

          <span style="margin-left: 2%; color: #666;"><b>Show: </b></span>
          <select id="cateSort" style="width:auto;" onchange="getValueShow(this.options[this.selectedIndex].value)">
            <option value="both" <?php if ($commandShow == "both") {echo "selected";} ?>>Both Visible and Hidden Categories</option>
            <option value="onlyVisible" <?php if ($commandShow == "onlyVisible") {echo "selected";} ?>>Visible Categories Only</option>
            <option value="onlyHidden" <?php if ($commandShow == "onlyHidden") {echo "selected";} ?>>Hidden Categories Only</option>
          </select>
          <br>

        <!-- Display visible category -->
        <table class="cateItem">
        <?php
            if(mysqli_num_rows($cateRowsVisible)>0) {
        ?>
              <tr id = "Visible"><th style="border-top: none;" colspan="5">VISIBLE CATEGORIES</th></tr>
        <?php
            }
            while($cateRow = mysqli_fetch_assoc($cateRowsVisible)){
        ?>
            <tr id="<?=$cateRow["cate_id"]; ?>">
                <td><image src="categoryPic/<?php echo $cateRow["cate_pic"]; ?>" width="90px" height="75px"></td>
                <td><h4><?php echo $cateRow["cate_name"]; ?></h4></td>
                <td>
                    <form action="action.php" method="POST">
                        <button type="submit" class="hideCateButton" name="cateHide" value="<?=$cateRow["cate_id"]; ?>">Hide</button>
                    </form>
                </td>
                <td>
                    <form action="actionUpdate.php" method="POST">
                        <button type="submit" class="editCateButton" name="cateUpdate" value="<?=$cateRow["cate_id"]; ?>">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="actionDelete.php" method="POST">
                        <button type="button" class="deleteCateButton" name="cateDeleteWarning" value="<?=$cateRow["cate_id"]; ?>" onclick="delCate(this.value)">Delete</button>
                    </form>
                </td>
            </tr>
        <?php
            }
        //Display hidden category
            if (mysqli_num_rows($cateRowsHidden)>0) {
        ?>
              <tr id = "Hidden"><th colspan="5">HIDDEN CATEGORIES</th></tr>
        <?php
            }
            while($cateRow = mysqli_fetch_assoc($cateRowsHidden)){
        ?>
            <tr id="<?=$cateRow["cate_id"]; ?>">
                <td><image src="categoryPic/<?php echo $cateRow["cate_pic"]; ?>" width="90px" height="75px"></td>
                <td><h4><?php echo $cateRow["cate_name"]; ?></h4></td>
                <td>
                    <form action="action.php" method="POST">
                        <button type="submit" class="hideCateButton" name="cateVisible" value="<?=$cateRow["cate_id"]; ?>">Visible</button>
                    </form>
                </td>
                <td>
                    <form action="actionUpdate.php" method="POST">
                        <button type="submit" class="editCateButton" name="cateUpdate" value="<?=$cateRow["cate_id"]; ?>">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="actionDelete.php" method="POST">
                        <button type="button" class="deleteCateButton" name="cateDeleteWarning" value="<?=$cateRow["cate_id"]; ?>" onclick="delCate(this.value)">Delete</button>
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




<div id="id02" class="modal2">
  
  <form class="modal2-content animate" action="action.php" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      
    <h2 style="text-align: center; margin: 24px 0 12px 0; position: relative; color:#555;">Add - Food Category</h2>
    <hr  class="hr2">

  <div class="row">
    <div class="col-25">
      <label for="cate_name">Name:</label>
    </div>
    <div class="col-75">
      <input style="float: left;" type="text" placeholder="Enter Category Name" 
                  name="cate_name" autocomplete="off" required id="cate_name" class="text1">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="foodFilter">Image:</label>
      
    </div>
    <div class="col-75">
      <input type="file" name="cate_pic" accept="image/*" id="cate_pic" 
          style="display: none; visibility: none;" onchange="getImagePreview(event)" required>            
          <label for="cate_pic">
          <div class="imgDiv" id="preview1">
            <img src="./images/image_placeholder.jpg" width="70px" height="70px">
          </div></label>
    </div>
  </div><hr class="hr3">
  
  <div class="row">
    <button type="submit" class="submitbtn3" name="submit_cate">Submit</button>
    <button type="button" class="cnbuttonadd" onclick="document.getElementById('id02').style.display='none'">Cancel</button>
  </div>

    </div>
  </form>
</div>

<div id="id03" class="modal3">
  
  <form class="modal3-content3 animate3" action="delCate.php" method="post">
    <div class="imgcontainer3">
      <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
      <div class="containerReq">
        <h1 style="text-align: center; color: #777">Delete Category</h1>
        <p style="text-align: center; color: #aaa">Are you sure? you will not be able to revert this!</p>
        <input type="hidden" id="req1" name="req1" required>
        <button type="button" class="cnbtn" onclick="document.getElementById('id03').style.display='none'">Cancel</button>
        <button type="submit" class="sbbtn" name="del_cate">Delete</button>
      </div>
  </form>
</div>

<script>
// Get the modal
var modal1 = document.getElementById('id01');
var modal2 = document.getElementById('id02');
var modal3 = document.getElementById('id03');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
    if (event.target == modal3) {
        modal3.style.display = "none";
    }
}
</script>

<script>
  function delCate(str) {
    document.getElementById('id03').style.display='block';
    document.getElementById("req1").value = str;
  }
</script>
  </body>
</html>