<?php
  require '../../config.php';

  $sql = "SELECT * FROM orders WHERE order_status = 'Finished' ORDER BY order_id DESC LIMIT 500";
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
            <button class="tablinks" onclick="openReady()">Ready</button>
            <button style="background-color:#ccc;" class="tablinks" onclick="openFinished()">Finished</button>
            <button class="tablinks" onclick="openCanceled()">Canceled</button>
          </div>

          <div class="usersSus">

            <?php
              if(mysqli_num_rows($searchRows)>0) {
                while($searchRow = mysqli_fetch_assoc($searchRows)){
                    $OID = $searchRow["order_id"];
                    $resultStId = mysqli_query($conn, "SELECT reg_no, customer_id FROM customer WHERE customer_id = ANY (SELECT customer_id FROM orders WHERE order_id = '$OID')");
                    $rowStId = mysqli_fetch_assoc($resultStId);
                    $stRegNo = $rowStId['reg_no'];
                    $stId = $rowStId['customer_id'];
            ?>
              
                <button class="accordion">
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


    <script>
      function openNew() {
        let url = "http://localhost/files/CanteenFCT/admin/order/adorder.php";
        window.location.href = url;
      }

      function openReady() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabReady.php";
        window.location.href = url;
      }

      function openFinished() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabFinished.php";
        window.location.href = url;
      }

      function openCanceled() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabCanceled.php";
        window.location.href = url;
      }

      function openProcessing() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabProcess.php";
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
