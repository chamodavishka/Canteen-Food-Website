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
    <link rel="stylesheet" type="text/css" href="modelCan.css">

    <style>
      *{font-family: 'Poppins', sans-serif;}
    </style>

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
            <button style="background-color:#ccc;" class="tablinks" onclick="openNew()">New</button>
            <button class="tablinks" onclick="openProcessing()">Processing</button>
            <button class="tablinks" onclick="openReady()">Ready</button>
            <button class="tablinks" onclick="openFinished()">Finished</button>
            <button class="tablinks" onclick="openCanceled()">Canceled</button>
          </div>

          <div id="link_wrapper"></div>

        </div>

    </div><br><br>

    <div id="id03" class="modal3">
  
      <form class="modal3-content3 animate3" action="newOrderActions.php" method="post">
          <div class="imgcontainer3">
          <span onclick="document.getElementById('id03').style.display='none'" class="close3" title="Close Modal">&times;</span>
          </div>
          <div class="containerReq">
              <h1 class="modelh1">Cancel Order</h1>
              <p class="modelp">Confirming this action will result in the cancellation of this order.</p>
              <input type="hidden" id="req1" name="req1" required>
              <input type="hidden" id="req2" name="req2" required>
              <input type="hidden" id="req3" name="req3" required>
              <button type="button" class="cnbtn2" onclick="document.getElementById('id03').style.display='none'">Cancel</button>
              <button type="submit" class="sbbtn2" name="canOrder">Confirm</button>
          </div>
      </form>
    </div>

    <div id="id04" class="modal3">
  
      <form class="modal3-content3 animate3" action="newOrderActions.php" method="post">
          <div class="imgcontainer3">
          <span onclick="document.getElementById('id04').style.display='none'" class="close3" title="Close Modal">&times;</span>
          </div>
          <div class="containerReq">
              <h1 class="modelh1">Mark as Processing</h1>
              <p class="modelp">Proceeding with this action will initiate the processing of the order.</p>
              <input type="hidden" id="req4" name="req4" required>
              <button type="button" class="cnbtn2" onclick="document.getElementById('id04').style.display='none'">Cancel</button>
              <button type="submit" class="sbbtn2" name="proOrder">Confirm</button>
          </div>
      </form>
    </div>

    <div id="id05" class="modal3">
  
      <form class="modal3-content3 animate3" action="newOrderActions.php" method="post">
          <div class="imgcontainer3">
          <span onclick="document.getElementById('id05').style.display='none'" class="close3" title="Close Modal">&times;</span>
          </div>
          <div class="containerReq">
              <h1 class="modelh1">Mark as Ready</h1>
              <p class="modelp">Continuing with this action will signify the readiness of the order.</p>
              <input type="hidden" id="req5" name="req5" required>
              <button type="button" class="cnbtn2" onclick="document.getElementById('id05').style.display='none'">Cancel</button>
              <button type="submit" class="sbbtn2" name="reaOrder">Confirm</button>
          </div>
      </form>
    </div>

    <script>
      function openNew() {
        let url = "http://localhost/files/CanteenFCT/admin/order/adorder.php"
        window.location.href = url;
      }

      function openProcessing() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabProcess.php"
        window.location.href = url;
      }

      function openReady() {
        let url = "http://localhost/files/CanteenFCT/admin/order/tabReady.php"
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
    </script>


    <script>
        function loadXMLDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper").innerHTML =
            this.responseText;
            }
        };
        xhttp.open("GET", "findNewOrders.php", true);
        xhttp.send();
        }
        setInterval(function(){
            loadXMLDoc();
            // 1sec
        },1000);

        window.onload = loadXMLDoc;
    </script>

    <script>
        function canOrder(str) {
            document.getElementById("req1").value = str;
            tp = document.getElementById("tp").value;
            stid = document.getElementById("stid").value;
            document.getElementById("req2").value = tp;
            document.getElementById("req3").value = stid;
            document.getElementById('id03').style.display='block';
        }

        function proOrder(str) {
            document.getElementById("req4").value = str;
            document.getElementById('id04').style.display='block';
        }

        function reaOrder(str) {
            document.getElementById("req5").value = str;
            document.getElementById('id05').style.display='block';
        }
    </script>

    <script>
        // Get the modal
        var modal1 = document.getElementById('id03');
        var modal2 = document.getElementById('id04');
        var modal3 = document.getElementById('id05');
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

  </body>
</html>
