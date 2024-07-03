<?php
  require '../../config.php';

  $sql = "SELECT * FROM suspended_customer INNER JOIN customer ON suspended_customer.customer_id = customer.customer_id ORDER BY suspend_id DESC";
  $searchRows = $conn->query($sql);
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
            <button class="tablinks" onclick="openAdUser()">Active Accounts</button>
            <button style="background-color:#ccc;" class="tablinks" onclick="openSuspendedUser()">Suspended Accounts</button>
            <button class="tablinks" onclick="openDeletedUser()">Deleted Accounts</button>
          </div>

          <div class="row">
              <div class="col-25">
              <label for="idDepositUser">Search Users</label>
              </div>
              <div class="col-75">
              <input type="text" id="idDepositUser" name="idDepositUser" onkeyup="showRecords(this.value)" placeholder="Enter the User Id Number or Name..">
              </div>
          </div><br>
          <div id="txtHint2"></div>
          <div class="usersSus">

            <?php
              if(mysqli_num_rows($searchRows)>0) {
                while($searchRow = mysqli_fetch_assoc($searchRows)){
            ?>
              
                <button class="accordion" id="<?=$searchRow["suspend_id"]; ?>">
                  <?php echo $searchRow["reg_no"]; ?><?php echo " - "; ?>
                  <?php echo $searchRow["fname"]; ?><?php echo " "; ?><?php echo $searchRow["lname"]; ?><?php echo " - "; ?>
                  <?php echo $searchRow["email"]; ?>
                </button>
                <div class="panel">

                  <table class="tableUserDetails">
                    <tr>
                      <td style="width: 23%;">Wallet: <span class="spanRecode">Rs. <?php echo $searchRow["wallet"]; ?></span></td>
                      <td>RegDate: <span class="spanRecode"><?php echo $searchRow["reg_date"]; ?></span></td>
                      <td>SuspDate: <span class="spanRecode"><?php echo $searchRow["sus_date"]; ?></span></td>
                    </tr>

                    <tr>
                      <td><image style="border-radius: 50px;" class="zoomUserSusp" src="../../signup_form/profilePic/<?php echo $searchRow["profile_pic"]; ?>" width="40px" height="40px"></td>
                      <td colspan="2">Reason to Suspend: <span class="spanRecode"><?php echo $searchRow["reason"]; ?></span></td>
                    </tr>

                    <tr style="background-color: white;">
                        <td style="padding: 15px 0px 0px 40px;" colspan="3">
                          <form action="restoreSusp.php" method="post">
                            <button type="submit" style="margin-right:0px;" class="buttonUpdate" name="restoreSubmit" value="<?=$searchRow["suspend_id"]; ?>">Restore</button>
                          </form>
                          <form action="deleteSusp.php" method="post">
                            <button type="submit" class="buttonCancel" name="deleteSubmit" value="<?=$searchRow["suspend_id"]; ?>">Delete</button>
                          </form>      
                        </td>
                    </tr>
                  </table>

                </div>

            <?php
                }
              }
            ?>

          </div>


        </div>

    </div><br><br>

    <script>
      function showRecords(str) {
        
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("txtHint2").innerHTML = this.responseText;
        }
        xhttp.open("GET", "searchSuspUser.php?q="+str);
        xhttp.send();
      }
    </script>

    <script>
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

    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
            } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
            } 
        });
        }
    </script>

  </body>
</html>
