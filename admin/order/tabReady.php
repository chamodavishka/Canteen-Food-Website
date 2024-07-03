<?php
  require '../../config.php';

  $sql = "SELECT * FROM orders WHERE order_status = 'Ready' ORDER BY order_id DESC";
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
    <link rel="stylesheet" type="text/css" href="modelCan.css">

  </head>
  <body>

    <div class="mainSideNav">
      <h1 style="color: #444; font-family: 'Franklin Gothic Medium', 
        'Arial Narrow', Arial, sans-serif; font-weight: bold; text-align: center;">FCT Canteen</h1>
      <ul class="sidenav">
        <li><a href="http://localhost/files/CanteenFCT/admin/dashboard/dashboard.php">DASHBOARD</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/category/adCategory.php">CATEGORIES</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/food/adFood.php">FOODS</a></li>
        <li><a class="current" href="http://localhost/files/CanteenFCT/admin/order/adOrder.php">ORDERS</a></li>
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

          <div class="tab">
            <button class="tablinks" onclick="openNew()">New</button>
            <button class="tablinks" onclick="openProcessing()">Processing</button>
            <button style="background-color:#ccc;" class="tablinks" onclick="openReady()">Ready</button>
            <button class="tablinks" onclick="openFinished()">Finished</button>
            <button class="tablinks" onclick="openCanceled()">Canceled</button>
          </div>

          <div class="usersSus">

            <?php
              if(mysqli_num_rows($searchRows)>0) {
                while($searchRow = mysqli_fetch_assoc($searchRows)){
                    $OID = $searchRow["order_id"];
                    $resultStId = mysqli_query($conn, "SELECT reg_no, customer_id, profile_pic FROM customer WHERE customer_id = ANY (SELECT customer_id FROM orders WHERE order_id = '$OID')");
                    $rowStId = mysqli_fetch_assoc($resultStId);
                    $stRegNo = $rowStId['reg_no'];
                    $stId = $rowStId['customer_id'];
                    $profilePic = $rowStId['profile_pic'];
            ?>
              
                <button class="accordion">
                  <image class="zoomUser" src="../../signup_form/profilePic/<?php echo $profilePic; ?>" width="15px" height="15px">
                  OID: <?php echo $searchRow["order_id"]; ?><?php echo " - "; ?>
                  <?php echo $stRegNo; ?><?php echo " - "; ?>Rs.
                  <?php echo $searchRow["total_price"]; ?>.00<?php echo " - "; ?>
                  <?php echo $searchRow["date_time"]; ?>
                </button>
                <div class="panel">

                  <table class="tableUserDetails">
                  <?php
                      $sql2 = "SELECT * FROM ordered_foods WHERE order_id = '$OID' ORDER BY order_food_id DESC";
                      $orderFoodRows = $conn->query($sql2);
                      while($orderFoodRow = mysqli_fetch_assoc($orderFoodRows)){
                        $fId = $orderFoodRow["food_id"];
                        $sql3 = "SELECT * FROM food WHERE food_id = '$fId'";
                        $foodRows = $conn->query($sql3);
                        $fname = "";
                        $fTPrice = 0;
                        while($foodRow = mysqli_fetch_assoc($foodRows)){
                            $fname = $foodRow["food_name"];
                            $fPrice = $foodRow["food_price"];
                            $fTPrice = $fPrice * ($orderFoodRow["quantity"]);
                        }
                    ?>

                    <tr>
                      <td class="tdFood">Dish: <span class="spanFood"><?php echo $fname; ?></span></td>
                      <td class="tdFood">Qty: <span class="spanFood"><?php echo $orderFoodRow["quantity"]; ?></span></td>
                      <td class="tdFood">TP: <span class="spanFood">Rs. <?php echo $fTPrice; ?>.00</span></td>
                      <td class="tdFood">Reqs: <span class="spanFood"><?php echo $orderFoodRow["comment"]; ?></span></td>
                    </tr>
                    <input type="hidden" id="tp" value="<?php echo $orderRow["total_price"]; ?>">
                    <?php
                      }
                    ?>
                    <input type="hidden" id="tp" value="<?php echo $searchRow["total_price"]; ?>">
                    <input type="hidden" id="stid" value="<?php echo $stId; ?>">
                    <tr>
                      <td style="background-color:white;" colspan="4">                  
                        <span class="cancelOrderSpan2" onclick="finOrder(<?php echo $OID; ?>)">Mark as Finished</span>
                      </td>
                    </tr>

                  </table>

                </div>

            <?php
                }
              } else{
            ?>
              <h3 class="header3">In the present moment, there are no orders in the finished stage available for display.</h3>
              <br><br><br>
            <?php
              }
            ?>

          </div>


        </div>

    </div><br><br>

    <div id="id05" class="modal3">
  
      <form class="modal3-content3 animate3" action="newOrderActions.php" method="post">
          <div class="imgcontainer3">
          <span onclick="document.getElementById('id05').style.display='none'" class="close3" title="Close Modal">&times;</span>
          </div>
          <div class="containerReq">
              <h1 class="modelh1">Mark as Finished</h1>
              <p class="modelp">Continuing with this action will result in the completion of the order.</p>
              <input type="hidden" id="req5" name="req5" required>
              <button type="button" class="cnbtn2" onclick="document.getElementById('id05').style.display='none'">Cancel</button>
              <button type="submit" class="sbbtn2" name="finOrder">Confirm</button>
          </div>
      </form>
    </div>

    <script>
      function openNew() {
        let url = "http://localhost/files/CanteenFCT/admin/order/adorder.php"
        window.location.href = url;
      }

      function openReady() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabReady.php"
        window.location.href = url;
      }

      function openCanceled() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabCanceled.php";
        window.location.href = url;
      }

      function openFinished() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabFinished.php";
        window.location.href = url;
      }

      function openProcessing() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabProcess.php"
        window.location.href = url;
      }

      function finOrder(str) {
        document.getElementById("req5").value = str;
        document.getElementById('id05').style.display='block';
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

    <script>
        // Get the modal
        var modal1 = document.getElementById('id05');
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }
    </script>

  </body>
</html>
