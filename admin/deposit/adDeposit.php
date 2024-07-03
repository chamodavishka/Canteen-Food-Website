<!DOCTYPE html>
<html>
  <head>
    <title>Admin FCT Canteen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adFood.css">
    <link rel="stylesheet" type="text/css" href="addFood.css">
    <link rel="stylesheet" type="text/css" href="depositRecord.css">
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
        <li><a class="current" href="http://localhost/files/CanteenFCT/admin/deposit/adDeposit.php">DEPOSIT</a></li>
        <li><a href="#CONTACT">MESSAGES</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/user/adUser.php">USERS</a></li>
        <li><a href="#CONTACT">SETTINGS</a></li>
        <li><a href="#CONTACT">LOGOUT</a></li>
      </ul>
    </div>

    <div class="content"><br><br>

        <div class="container">

          <h2 class="text">DEPOSIT</h2>
          <hr>

          <form action="actionDeposit.php" method="post" autocomplete="off">
            <div class="row">
              <div class="col-25">
                <label for="idName">Search User</label>
              </div>
              <div class="col-75">
                <input type="text" id="idName" name="idName" onkeyup="showCustomer(this.value)" placeholder="Enter the Id Number or Name.." autofocus>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="amountDeposit">Amount</label>
              </div>
              <div class="col-75">
                <input type="number" id="amountDeposit" name="amountDeposit" placeholder="Enter the Amount.." min="1" max="100000" required>
              </div>
            </div>
            <br>
            <div id="txtHint"></div>
          </form><hr style="margin-top:13px; margin-bottom:0;"><br>
        </div><br><br>

        <div class="container">
          <h2 class="text">RECORDS</h2>
          <hr>

          <form action="" method="post" autocomplete="off">
            <div class="row">
              <div class="col-25">
                <label for="idDepositUser">Search Records</label>
              </div>
              <div class="col-75">
                <input type="text" id="idDepositUser" name="idDepositUser" onkeyup="showRecords(this.value)" placeholder="Enter the Deposit Id No or User Id No..">
              </div>
            </div>
            <div id="txtHint2">
              <?php
                  require '../../config.php';
                  $sql3 = "SELECT A.deposit_id, A.amount, A.new_amount, A.time, B.reg_no, A.deposit_status FROM deposit A, customer B 
                  WHERE A.customer_id=B.customer_id ORDER BY A.deposit_id DESC LIMIT 100";
                  $defaultRows2 = $conn->query($sql3);
              
                  if(mysqli_num_rows($defaultRows2)>0) {
              ?>
                  <table class="cateItem2">
                      <tr><th style="border-top: none;" colspan="5">DETAILS - LATEST RECORDS</th></tr>
                      <tr style="background-color:#ddd;">
                          <td><span class="spanRecode2">Deposit Id</span></td>
                          <td><span class="spanRecode2">Amount</span></td>
                          <td><span class="spanRecode2">Wallet Balance</span></td>
                          <td><span class="spanRecode2">Date & Time</span></td>
                          <td><span class="spanRecode2">User Id</span></td>
                      </tr>
              <?php
                  }
                  while($defaultRow2 = mysqli_fetch_assoc($defaultRows2)){
              ?>
                      <tr>
                          <td><span class="spanRecode"><?=$defaultRow2["deposit_id"]; ?></span></td>
                          <?php
                            if(($defaultRow2["deposit_status"]) == 'Include') {
                          ?>
                          <td><span class="spanRecode3">Rs. <?=$defaultRow2["amount"]; ?> (CR)</span></td>
                          <?php
                            } else {
                          ?>
                          <td><span class="spanRecode4">Rs. <?=$defaultRow2["amount"]; ?> (DR)</span></td>
                          <?php 
                            }
                          ?>
                          <td><span class="spanRecode">Rs. <?=$defaultRow2["new_amount"]; ?></span></td>
                          <td><span class="spanRecode"><?=$defaultRow2["time"]; ?></span></td>
                          <td><span class="spanRecode"><?=$defaultRow2["reg_no"]; ?></span></td>
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
    function showCustomer(str) {
      if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
      }
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
      xhttp.open("GET", "searchAction.php?q="+str);
      xhttp.send();
    }

    function showRecords(str) {
      
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
        document.getElementById("txtHint2").innerHTML = this.responseText;
      }
      xhttp.open("GET", "searchActionTwo.php?q="+str);
      xhttp.send();
    }
    </script>

  </body>
</html>
