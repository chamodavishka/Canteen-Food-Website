<?php
    require '../../config.php';

    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        
        $sql = "SELECT * FROM customer WHERE customer_id=$userId";
        $searchRows = $conn->query($sql);

        $sql2 = "SELECT * FROM customer WHERE customer_id=$userId";
        $searchRows2 = $conn->query($sql2);
        $searchRow2 = mysqli_fetch_assoc($searchRows2);
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin FCT Canteen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adFood.css">
    <link rel="stylesheet" type="text/css" href="addFood.css">
    <link rel="stylesheet" type="text/css" href="depositRecord.css">
    <link rel="stylesheet" type="text/css" href="tab.css">

  </head>
  <body>

    <div class="mainSideNav">
      <h1 style="color: #444; font-family: 'Franklin Gothic Medium', 
        'Arial Narrow', Arial, sans-serif; font-weight: bold; text-align: center;">FCT Canteen</h1>
      <ul class="sidenav">
        <li><a href="http://localhost/files/CanteenFCT/admin/dashboard/dashboard.php">DASHBOARD</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/category/adCategory.php">CATEGORIES</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/food/adFood.php">FOODS</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/order/adOrder.php">ORDERS</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/sensor/sensor.php">SENSORS</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/deposit/adDeposit.php">DEPOSIT</a></li>
        <li><a href="#CONTACT">MESSAGES</a></li>
        <li><a class="current" href="http://localhost/files/CanteenFCT/admin/user/adUser.php">USERS</a></li>
        <li><a href="#CONTACT">SETTINGS</a></li>
        <li><a href="#CONTACT">LOGOUT</a></li>
      </ul>
    </div>

    <div class="content"><br><br>

        <div class="container">

            <?php
            if(mysqli_num_rows($searchRows)>0) {
            ?>
                
                <h2 class="text">Suspension - <?php echo $searchRow2["fname"]; ?><?php echo " "; ?><?php echo $searchRow2["lname"]; ?></h2>
                <hr>

                <table class="cateItem">
                        <tr id = "Visible">
                            <th style="border-top: none;" colspan="5">USER DETAILS</th>
                        </tr>
                        <tr style="background-color:#ddd;">
                            <td><span class="spanRecode2">Image</span></td>
                            <td><span class="spanRecode2">Name & Email</span></td>
                            <td><span class="spanRecode2">User Id</span></td>
                            <td><span class="spanRecode2">Wallet</span></td>
                            <td><span class="spanRecode2">RegDate</span></td>
                        </tr>
                <?php
                    }
                    while($searchRow = mysqli_fetch_assoc($searchRows)){
                ?>
                    <tr style="background-color:#f9f9f9;">
                        <td><image class="zoomUser" src="../../signup_form/profilePic/<?php echo $searchRow["profile_pic"]; ?>" width="50px" height="50px"></td>
                        <td><span class="spanRecode"><?php echo $searchRow["fname"]; ?><?php echo " "; ?><?php echo $searchRow["lname"]; ?>
                        <br><?php echo $searchRow["email"]; ?></span></td>
                        <td><span class="spanRecode"><?php echo $searchRow["reg_no"]; ?></span></td>
                        <td><span class="spanRecode">Rs. <?php echo $searchRow["wallet"]; ?></span></td>
                        <td><span class="spanRecode"><?php echo $searchRow["reg_date"]; ?></span></td>
                    </tr>
                </table>
                <?php
                    }
                ?>

            <form action="userSuspendAction.php" method="POST" autocomplete="off">
                <div class="row">
                    <div class="col-25">
                        <label for="reasonSuspend">Reason</label>
                    </div>
                    <div class="col-75">
                        <textarea id="reasonSuspend" name="reasonSuspend" placeholder="Enter the Suspending Reason.." maxlength="500" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="noticeSuspend">Notice for User</label>
                    </div>
                    <div class="col-75">
                        <textarea id="noticeSuspend" name="noticeSuspend" maxlength="500" required>After reviewing your account, we have noted several concerns within your account activity. As a result, we have suspended your account. If you feel this action was taken in error and would like to continue to use your account, we would like to verify your account and account activity directly with you.</textarea>
                    </div>
                </div><br>
                <div class="row">
                    <button type="submit" class="buttonUpdate" name="suspendSubmit" value="<?=$searchRow2["customer_id"]; ?>">Suspend</button>
                    <button type="button" class="buttonCancel" name="cancelSubmit" value="<?=$searchRow2["customer_id"]; ?>" onclick="cancelFunction()">Cancel</button>
                </div>
            </form><br>

        </div>

    </div><br><br>

    <script>
      function cancelFunction() {
          let url = 'http://localhost/files/CanteenFCT/admin/user/adUser.php';
          window.location= url;
      }
    </script>

  </body>
</html>