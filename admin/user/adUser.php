<!DOCTYPE html>
<html>
  <head>
    <title>Admin FCT Canteen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adFood.css">
    <link rel="stylesheet" type="text/css" href="addFood.css">
    <link rel="stylesheet" type="text/css" href="depositRecord.css">
    <link rel="stylesheet" type="text/css" href="tab.css">
    <link rel="stylesheet" type="text/css" href="suspendedUsers.css">

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

          <div class="tab">
            <button style="background-color:#ccc;" class="tablinks" onclick="openAdUser()">Active Users</button>
            <button class="tablinks" onclick="openSuspendedUser()">Suspended Users</button>
            <button class="tablinks" onclick="openDeletedUser()">Deleted Accounts</button>
          </div>

          <form action="defaultUsersPageSwap.php" method="post" autocomplete="off">
            <div class="row">
              <div class="col-25">
                <label for="idDepositUser">Search Users</label>
              </div>
              <div class="col-75">
                <input type="text" id="idDepositUser" name="idDepositUser" onkeyup="showRecords(this.value)" placeholder="Enter the User Id Number or Name..">
              </div>
            </div><br>
            <div id="txtHint2">
                
              <?php
              require '../../config.php';
              $limit = 2;
              $offset = 0;
              if (!empty($_SESSION["offset"])){
                  $offset = $_SESSION["offset"];
                }

              $sql = "SELECT * FROM customer WHERE customer_id NOT IN (SELECT customer_id FROM suspended_customer) ORDER BY customer_id DESC LIMIT $offset,$limit";
              $searchRows = $conn->query($sql);

              $sql2 = "SELECT * FROM customer WHERE customer_id NOT IN (SELECT customer_id FROM suspended_customer) ORDER BY customer_id DESC";
              $rowsAmount = $conn->query($sql2);

              if(mysqli_num_rows($searchRows)>0) {
              ?>
              <table class="cateItem">
                      <tr id = "Visible">
                          <th style="border-top: none;" colspan="6">USER DETAILS</th>
                      </tr>
                      <tr style="background-color:#ddd;">
                          <td><span class="spanRecode2">Image</span></td>
                          <td><span class="spanRecode2">Name & Email</span></td>
                          <td><span class="spanRecode2">User Id</span></td>
                          <td><span class="spanRecode2">Wallet</span></td>
                          <td><span class="spanRecode2">RegDate</span></td>
                          <td style="text-align:right;"><span class="spanRecode2" style="padding-right:37px;">Action</span></td>
                      </tr>
              <?php
                  }
                  while($searchRow = mysqli_fetch_assoc($searchRows)){
              ?>
                  <tr>
                      <td><image style="border-radius: 50px;" class="zoomUser" src="../../signup_form/profilePic/<?php echo $searchRow["profile_pic"]; ?>" width="50px" height="50px"></td>
                      <td><span class="spanRecode"><?php echo $searchRow["fname"]; ?><?php echo " "; ?><?php echo $searchRow["lname"]; ?>
                      <br><?php echo $searchRow["email"]; ?></span></td>
                      <td><span class="spanRecode"><?php echo $searchRow["reg_no"]; ?></span></td>
                      <td><span class="spanRecode">Rs. <?php echo $searchRow["wallet"]; ?></span></td>
                      <td><span class="spanRecode"><?php echo $searchRow["reg_date"]; ?></span></td>

                      <td><button type="button" class="deleteCateButton" name="suspendSubmit" value="<?=$searchRow["customer_id"]; ?>" onclick="getUserId(this.value)">Suspend</button></td>
                  </tr>
              <?php
                  }
              ?>
              </table>

              <table class="pageSwap">
                  <?php
                      if(((mysqli_num_rows($rowsAmount))>($offset+$limit)) && ($offset == 0)) {
                  ?>

                      <tr>
                          <th class="next" style="border-top: none;"><button style="float:none;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="nextSubmit">Next &raquo;</button></th>
                      </tr>

                  <?php
                      }
                  ?>
                  <?php
                      if(($offset != 0) && ((mysqli_num_rows($rowsAmount))>($offset+$limit)) && ($offset < ($limit*2))) {
                  ?>

                      <tr>
                          <th class="next" style="border-top: none;"><button style="float:right;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="backSubmit">&laquo; Back</button></th>
                          <th class="next" style="border-top: none;"><button style="float:left;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="nextSubmit">Next &raquo;</button></th>
                      </tr>

                  <?php
                      }
                  ?>

                  <?php
                      if(($offset != 0) && ((mysqli_num_rows($rowsAmount))>($offset+$limit)) && ($offset>$limit)) {
                  ?>

                      <tr>
                          <th class="next" style="border-top: none;"><button style="float:none;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="backSubmit">&laquo; Back</button></th>
                          <th class="next" style="border-top: none;"><button style="float:none;" type="submit" class="hideCateButton" name="homeSubmit">Home</button></th>
                          <th class="next" style="border-top: none;"><button style="float:none;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="nextSubmit">Next &raquo;</button></th>
                      </tr>

                  <?php
                      }
                  ?>

                  <?php
                      if(($offset != 0) && ((mysqli_num_rows($rowsAmount))<=($offset+$limit))) {
                  ?>

                      <tr>
                          <th class="next" style="border-top: none;"><button style="float:right;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="backSubmit">&laquo; Back</button></th>
                          <th class="next" style="border-top: none;"><button style="float:left;" type="submit" class="hideCateButton" name="homeSubmit">Home</button></th>
                      </tr>

                  <?php
                      }
                  ?>
              </table>

            </div>
          </form>

        </div>

    </div><br><br>

    <script>
      function showRecords(str) {
        
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("txtHint2").innerHTML = this.responseText;
        }
        xhttp.open("GET", "searchAction.php?q="+str);
        xhttp.send();
      }
    </script>

    <script>
      function getUserId(svalue) {
        let url = "http://localhost/files/CanteenFCT/admin/user/userSuspend.php"
        window.location.href = url+"?userId="+svalue;
      }

      function openAdUser() {
        let url = "http://localhost/files/CanteenFCT/admin/user/adUser.php"
        window.location.href = url;
      }

      function openSuspendedUser() {
        let url = "http://localhost/files/CanteenFCT/admin/user/suspendedUsers.php"
        window.location.href = url;
      }

      function openDeletedUser() {
        let url = "http://localhost/files/CanteenFCT/admin/user/deletedUsers.php"
        window.location.href = url;
      }
    </script>

  </body>
</html>
