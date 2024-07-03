<?php
  require 'config.php';

  if (isset($_POST["addCart"])) {
    $foodId = $_POST["addCart"];
    $requests = $_POST["requests"];
    $quantity = $_POST["quantity"];
    $fname = $_POST["fname"];
    $fpic = $_POST["fpic"];
    $fprice = $_POST["fprice"];

    if (isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], "foodId");

        if (!in_array($foodId, $session_array_id)) {
            $session_array = array (
                "foodId" => $foodId,
                "requests" => $requests,
                "quantity" => $quantity,
                "fname" => $fname,
                "fpic" => $fpic,
                "fprice" => $fprice
            );
    
            $_SESSION['cart'][] = $session_array;
        }
    } else {
        $session_array = array (
            "foodId" => $foodId,
            "requests" => $requests,
            "quantity" => $quantity,
            "fname" => $fname,
            "fpic" => $fpic,
            "fprice" => $fprice
        );

        $_SESSION['cart'][] = $session_array;
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            resize: none;
            height: 70px;
        }
        textarea:valid {
            border: 2px solid var(--dark-orange);
        }

    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---- title --------->
    <title>FCT eCanteen</title>

    <!------ favicon icon ----------->
    <link rel="style icon" href="./images/favicon.png">

    <!---- customer css file ------->
    <link rel="stylesheet" href="./css/sign.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/category.css">
    <link rel="stylesheet" type="text/css" href="adFood.css">
    <link rel="stylesheet" type="text/css" href="addFood.css">

    <!----- GOOGLE FONTS ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,400;1,700;1,800;1,900&display=swap" rel="stylesheet">  

    <!-------- font awesome cdn link --------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!------------ Iconscout CSS -------------->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!--------- boxicons cdn link ---------->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    
        <div class="top-header">
            <div class="header-one">
                    <a class="logo" href="./signInUp.php">FCT <span>Canteen</span></a>

                    <div class="navbar">
                        <a href="./signInUp.php">Home</a>
                        <a href="#">Our Menu</a>
                        <a href="#">Order List</a>      
                        <a href="#" class="popular">Popular Food</a>         
                    </div> 

                    <div class="search-box">
                        <input class="hidden-search" type="search" placeholder="search here">
                    </div>
    
                    <div class="icons">
                        <div id="search-btn" class="fas fa-search hidden-search-icon"></div>
                        <a href="./signup_form/signin.php" id="heart" class="fas fa-heart"></a>
                        <a href="cart.php" id="shopping-cart" style="color: var(--dark-orange);" class="fas fa-shopping-cart"><span id="link_wrapper5"></span></a>
                        <a href="./signup_form/signin.php"><div id="login-btn" class="fas fa-user"></div></a>
                    </div>

                    <span class="fa fa-bars" id="menuBar"></span>
                </div>
            </div>
        </div>

        

    <div class="nameCart">My Cart</div>
    
        <div class="none">
            <div class="row1">
                <div id="link_wrapper1"></div>     
            </div>
        </div>

        <div class="row3">
            <div class="container2">
                <div class="extra">

                    <div style="overflow-x:auto;">
                        <div id="link_wrapper4"></div> 
                    </div><br><br>
                </div>

            <form action="actionDeposit.php" method="post" autocomplete="off">

                <h2 class="text1">PRICE DETAILS</h2>
                <hr>

                <div class="row">
                    <div class="col-total">
                        <label for="totalPrice" class="total">Items</label>
                    </div>
                    <div class="col-total">
                        <div id="link_wrapper2"></div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-total">
                        <label for="amountDeposit" class="total">Amount payable</label>
                    </div>
                    <div class="col-total">
                        <div id="link_wrapper3"></div> 
                    </div>
                </div> 

                <br>
                <hr style="margin-top:-6px;"><br>
                <div class="row">
                    <div style="width:100%; margin-top:4.4px;">
                    <button type="button" class="button" onclick="remove()"><span>Pay Now </span></button>
                    </div>
                </div>

            </form>
            </div>
        </div><div class="row"></div>

   

    <!----- footer section  ------->
    <section  class="footer section">
        <div class="footer-content">
            <div class="footer-col">
                <h3>Our Links</h3>
                <div class="links">
                    <a href="#">Menu</a>
                    <a href="#">About Us</a>
                    <a href="#">Services</a>
                </div>
            </div>

            <div class="footer-col">
                <h3>Location</h3>
                <div class="links">
                    <p class="text">Faculty Of Computing Technology</p>
                    <p class="text">University Of Kelaniya</p>
                </div>
            </div>

            <div class="footer-col">
                <h3>Contact Us</h3>
                <div class="links">
                    <p class="icon"><i class="fas fa-phone"></i>+9477-123-2345</p>
                    <p class="icon"><i class="fas fa-phone"></i>+9477-123-2345</p>
                    <p class="icon"><i class="fas fa-envelope"></i>info@gmail.com</p>
                </div>
            </div>

        </div>
    </section>

     <!----- cutomer js file ------->
    <script src="./Js/script.js"></script>

    <script>
        function loadXMLDoc1() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("link_wrapper1").innerHTML =
            this.responseText;
            }
        };
        xhttp.open("GET", "showCartItemN.php", true);
        xhttp.send();
        }
        setInterval(function(){
            loadXMLDoc1();
            // 1sec
        },1000);

        window.onload = loadXMLDoc1;
    </script>

    <script>
      function remove(str) {
        
        const xhttp = new XMLHttpRequest();

        xhttp.open("GET", "removeCartItem.php?q="+str);
        xhttp.send();
      }
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
        xhttp.open("GET", "cartPayItem.php", true);
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
        xhttp.open("GET", "cartPayPrice.php", true);
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
        xhttp.open("GET", "showCartItemE.php", true);
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
        xhttp.open("GET", "cartItems.php", true);
        xhttp.send();
        }
        setInterval(function(){
            loadXMLDoc5();
            // 1sec
        },1000);

        window.onload = loadXMLDoc5;
    </script>

<script>
      function add(str) {
        
        const xhttp = new XMLHttpRequest();

        xhttp.open("GET", "index/addQty.php?q="+str);
        xhttp.send();
      }

      function subtract(str) {
        
        const xhttp = new XMLHttpRequest();

        xhttp.open("GET", "index/subtractQty.php?q="+str);
        xhttp.send();
      }
    </script>

</body>
</html>
