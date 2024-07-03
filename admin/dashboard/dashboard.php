<?php
  require '../../config.php';
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
        <h1 class="dbText">OVERVIEW</h1>

        <div class="container" onclick="openNew()">
            <span class="dsHeader">New Orders</span><br>
            <span class="dsValue" id="link_wrapper"></span>
        </div>

        <div class="container" onclick="openFood()">
            <span class="dsHeader">Sold out</span><br>
            <span class="dsValue" id="link_wrapper1"></span>
        </div>

        <div class="container"onclick="openWatchlist()">
            <span class="dsHeader">Watchlist</span><br>
            <span class="dsValue" id="link_wrapper2"></span>
        </div>

        <div class="container" onclick="openCategory()">
            <span class="dsHeader">Categories</span><br>
            <span class="dsValue" id="link_wrapper3"></span>
        </div>

        <div class="container" onclick="openFood()">
            <span class="dsHeader">Foods</span><br>
            <span class="dsValue" id="link_wrapper4"></span>
        </div>

        <div class="container" onclick="openUser()">
            <span class="dsHeader">Users</span><br>
            <span class="dsValue" id="link_wrapper5"></span>
        </div>

    </div><br><br>


  </body>
</html>

<script>
    function loadXMLDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("link_wrapper").innerHTML =
        this.responseText;
        }
    };
    xhttp.open("GET", "newOrdersAmount.php", true);
    xhttp.send();
    }
    setInterval(function(){
        loadXMLDoc();
        // 1sec
    },1000);

    window.onload = loadXMLDoc;
</script>

<script>
    function loadXMLDoc1() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("link_wrapper1").innerHTML =
        this.responseText;
        }
    };
    xhttp.open("GET", "soldOutAmount.php", true);
    xhttp.send();
    }
    setInterval(function(){
        loadXMLDoc1();
        // 1sec
    },1000);

    window.onload = loadXMLDoc1;
</script>

<script>
    function loadXMLDoc2() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("link_wrapper2").innerHTML =
        this.responseText;
        }
    };
    xhttp.open("GET", "watchlistAmount.php", true);
    xhttp.send();
    }
    setInterval(function(){
        loadXMLDoc2();
        // 1sec
    },1000);

    window.onload = loadXMLDoc2;
</script>

<script>
    function loadXMLDoc3() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("link_wrapper3").innerHTML =
        this.responseText;
        }
    };
    xhttp.open("GET", "categoryAmount.php", true);
    xhttp.send();
    }
    setInterval(function(){
        loadXMLDoc3();
        // 1sec
    },1000);

    window.onload = loadXMLDoc3;
</script>

<script>
    function loadXMLDoc4() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("link_wrapper4").innerHTML =
        this.responseText;
        }
    };
    xhttp.open("GET", "foodAmount.php", true);
    xhttp.send();
    }
    setInterval(function(){
        loadXMLDoc4();
        // 1sec
    },1000);

    window.onload = loadXMLDoc4;
</script>

<script>
    function loadXMLDoc5() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("link_wrapper5").innerHTML =
        this.responseText;
        }
    };
    xhttp.open("GET", "userAmount.php", true);
    xhttp.send();
    }
    setInterval(function(){
        loadXMLDoc5();
        // 1sec
    },1000);

    window.onload = loadXMLDoc5;
</script>

<script>
    function openNew() {
        let url = "http://localhost/files/CanteenFCT/admin/order/adorder.php"
        window.location.href = url;
    }

    function openCategory() {
        let url = "http://localhost/files/CanteenFCT/admin/category/adCategory.php"
        window.location.href = url;
    }

    function openFood() {
        let url = "http://localhost/files/CanteenFCT/admin/food/adFood.php"
        window.location.href = url;
    }

    function openUser() {
        let url = "http://localhost/files/CanteenFCT/admin/user/adUser.php"
        window.location.href = url;
    }

    function openWatchlist() {
        let url = "http://localhost/files/CanteenFCT/admin/dashboard/watchlistItems.php"
        window.location.href = url;
    }
</script>