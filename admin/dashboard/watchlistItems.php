<?php
  require '../../config.php';

  $sql = "SELECT COUNT(food_id) AS amount, food_id FROM watchlist GROUP BY food_id";
  $searchRows = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin FCT Canteen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adFood.css">
    <link rel="stylesheet" type="text/css" href="addFood.css">
    <link rel="stylesheet" type="text/css" href="dashboard.css">

    <style>
      *{font-family: 'Poppins', sans-serif;}

      table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
      }

      th, td {
        text-align: left;
        padding: 16px;
      }

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      caption {
        font-size:20px;
        font-weight: 700;
        color: #555;
        margin-bottom: 15px;
      }
    </style>

  </head>
  <body>

    <div class="mainSideNav">
      <h1 style="color: #444; font-family: 'Franklin Gothic Medium', 
        'Arial Narrow', Arial, sans-serif; font-weight: bold; text-align: center;">FCT Canteen</h1>
      <ul class="sidenav">
        <li><a class="current" href="http://localhost/files/CanteenFCT/admin/dashboard/dashboard.php">DASHBOARD</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/category/adCategory.php">CATEGORIES</a></li>
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

        <div class="containerDB" onclick="openNew()">

          <table><caption>WATCHLIST</caption>
            <tr>
                <th>Food Name</th>
                <th>Food Price</th>
                <th>Watchers</th>
            </tr>
          <?php
            if(mysqli_num_rows($searchRows)>0) {
              while($searchRow = mysqli_fetch_assoc($searchRows)){
                $id = $searchRow["food_id"];
                $amount = $searchRow["amount"];
                $result = mysqli_query($conn, "SELECT food_name, food_price FROM food WHERE food_id = '$id'");
                $row = mysqli_fetch_assoc($result);
          ?>
            <tr>
                <td><?php echo $row['food_name']; ?></td>
                <td>Rs. <?php echo $row['food_price']; ?>.00</td>
                <td><?php echo $amount; ?></td>
            </tr>
          <?php
              }
            } else {
          ?>
            <tr>
                <td colspan="3">There are currently no items in the watchlist available for viewing.</td>
            </tr>
          <?php
            }
          ?>
          </table>
        </div>

        
  
 


    </div><br><br>


  </body>
</html>