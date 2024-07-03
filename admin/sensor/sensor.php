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
    <link rel="stylesheet" type="text/css" href="depositRecord.css">
    <link rel="stylesheet" type="text/css" href="sensor.css">



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
        <li><a href="http://localhost/files/CanteenFCT/admin/order/adOrder.php">ORDERS</a></li>
        <li><a class="current" href="http://localhost/files/CanteenFCT/admin/sensor/sensor.php">SENSORS</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/deposit/adDeposit.php">DEPOSIT</a></li>
        <li><a href="#CONTACT">MESSAGES</a></li>
        <li><a href="http://localhost/files/CanteenFCT/admin/user/adUser.php">USERS</a></li>
        <li><a href="#CONTACT">SETTINGS</a></li>
        <li><a href="#CONTACT">LOGOUT</a></li>
      </ul>
    </div>

    <div class="content"><br><br>

        <div class="container">
            <h2 class="text">SENSORS</h2>
            <hr>

            <div class="usersSus">
                
                <button class="accordion">Showcase 01</button>
                <div class="panel">

                <table class="tableUserDetails">
                    <tr>
                        <td class="tdFood"><span class="spanFood">Humidity: </span><span id='humi'></span> gm<sup>-3</sup></td>
                        <td class="tdFood"><span class="spanFood">Temperature: </span><span id='temp'></span> &#8451;</td>
                        <td class="tdFood"><span class="spanFood">Light Density: </span><span id='ldrv'></span> Cd</td>
                    </tr>
                </table>

                </div>

            </div>
            <div class="usersSus">
                
                <button class="accordion">Showcase 02</button>
                <div class="panel">

                <table class="tableUserDetails">
                    <tr>
                        <td class="tdFood"><span class="spanFood">Humidity: </span><span id='humi1'></span> gm<sup>-3</sup></td>
                        <td class="tdFood"><span class="spanFood">Temperature: </span><span id='temp1'></span> &#8451;</td>
                        <td class="tdFood"><span class="spanFood">Light Density: </span><span id='ldrv1'></span> Cd</td>
                    </tr>
                </table>

                </div>

            </div>
            <div class="usersSus">
                
                <button class="accordion">Showcase 03</button>
                <div class="panel">

                <table class="tableUserDetails">
                    <tr>
                        <td class="tdFood"><span class="spanFood">Humidity: </span>Unavailable</td>
                        <td class="tdFood"><span class="spanFood">Temperature: </span>Unavailable</td>
                        <td class="tdFood"><span class="spanFood">Light Density: </span>Unavailable</td>
                    </tr>
                </table>

                </div>

            </div><br>
          
        </div>

    </div><br><br>

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

<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-database.js"></script>

<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyD0m4noOzovPD6vp0cVM0artqqr5TMEN-Y",
    authDomain: "dht11k-ed062.firebaseapp.com",
    databaseURL: "https://dht11k-ed062-default-rtdb.firebaseio.com",
    projectId: "dht11k-ed062",
    storageBucket: "dht11k-ed062.appspot.com",
    messagingSenderId: "992552229843",
    appId: "1:992552229843:web:d47f4a577bb48db7a3ed26",
    measurementId: "G-FRSHEW0XKJ"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

  
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  // getting reference to the database
  var database = firebase.database();

  //getting reference to the data we want
  var dataRef1 = database.ref('DHT/temperature'); 
  var dataRef2 = database.ref('DHT/humidity'); 
  var dataRef3 = database.ref('DHT/LDRValue');

  var dataRef4 = database.ref('DHT1/temperature'); 
  var dataRef5 = database.ref('DHT1/humidity'); 
  var dataRef6 = database.ref('DHT1/LDRValue');

  //fetch the data

  dataRef1.on('value', function(getdata1){
    var temp = getdata1.val();
    document.getElementById('temp').innerHTML = temp;
  })
 
  dataRef2.on('value', function(getdata2){
    var humi = getdata2.val();
   document.getElementById('humi').innerHTML = humi;
  })

  dataRef3.on('value', function(getdata3){
    var ldrv = getdata3.val();
   document.getElementById('ldrv').innerHTML = ldrv;
  })


  dataRef4.on('value', function(getdata4){
    var temp1 = getdata4.val();
    document.getElementById('temp1').innerHTML = temp1;
  })
 
  dataRef5.on('value', function(getdata5){
    var humi1 = getdata5.val();
   document.getElementById('humi1').innerHTML = humi1;
  })

  dataRef6.on('value', function(getdata6){
    var ldrv1 = getdata6.val();
   document.getElementById('ldrv1').innerHTML = ldrv1;
  })
</script>

  </body>
</html>
