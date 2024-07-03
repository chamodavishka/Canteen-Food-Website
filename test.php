<!DOCTYPE html>
<html>
  <head>
    <title>Admin FCT Canteen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./admin/user/adFood.css">
    <link rel="stylesheet" type="text/css" href="./admin/user/addFood.css">
    <link rel="stylesheet" type="text/css" href="./admin/user/depositRecord.css">
    <link rel="stylesheet" type="text/css" href="./admin/user/tab.css">
    <link rel="stylesheet" type="text/css" href="./admin/user/suspendedUsers.css">

  </head>
  <body>
    <?php
        if (!empty($_SESSION['cart'])) {
            
        
    ?>
          <table class="cateItem">
            <tr id = "Visible">
                <th style="border-top: none;" colspan="6">My Cart</th>
            </tr>
            <tr style="background-color:#ddd;">
                <td><span class="spanRecode2">Image</span></td>
                <td><span class="spanRecode2">Name</span></td>
                <td><span class="spanRecode2">Quantity</span></td>
                <td><span class="spanRecode2">Price</span></td>
                <td><span class="spanRecode2">Requests</span></td>
                <td style="text-align:right;"><span class="spanRecode2" style="padding-right:37px;">Action</span></td>
            </tr>
    <?php

          foreach ($_SESSION['cart'] as $key => $value) {
            
            $requests = $value["requests"];

            if ($requests == "") {
                $requests = "No Requests";
            }
            
    ?>
          <tr>
            <td><image class="zoomUser" src="admin/food/foodPic/<?php echo $value["fpic"]; ?>" width="50px" height="50px"></td>
            <td><span class="spanRecode"><?php echo $value["fname"]; ?></span></td>
            <td><span class="spanRecode"><?php echo $value["quantity"]; ?></span></td>
            <td><span class="spanRecode">Rs. <?php echo $value["fprice"]; ?></span></td>
            <td><span class="spanRecode"><?php echo $requests; ?></span></td>

            <td><a href="cart.php?action=remove&foodId=<?=$value["foodId"]; ?>"><button type="button" class="deleteCateButton" name="suspendSubmit" value="<?php echo $value["foodId"]; ?>">Remove</button></a></td>
          </tr>
    <?php
          }
        }
    ?>
    </table>

    <?php
        if (isset($_GET["action"])) {
            if ($_GET["action"] == "remove") {
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($value["foodId"] == $_GET["foodId"]) {
                        unset($_SESSION['cart'][$key]);
                    }
                }
            }
        }
    ?>

  </body>
</html>