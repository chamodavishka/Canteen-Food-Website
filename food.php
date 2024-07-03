<?php
require 'config.php';
if (isset($_GET['foodId'])){
    $foodid = $_GET['foodId'];
    $result = mysqli_query($conn, "SELECT * FROM food WHERE food_id='$foodid'");
    $row = mysqli_fetch_assoc($result);

    $result1 = "SELECT feedback, customer_id FROM orders INNER JOIN ordered_foods ON orders.order_id = ordered_foods.order_id WHERE food_id = '$foodid' AND feedback != ''";
    $resultRows = $conn->query($result1);
}
if(empty($_GET['foodId'])) {
    header("Location: signInUp.php");
}
$cid = $row["cate_id"];
$popularFoodResult = "SELECT * FROM ordered_foods WHERE food_id = ANY (SELECT food_id FROM food WHERE cate_id='$cid') GROUP BY food_id ORDER BY COUNT(food_id) DESC LIMIT 4";
$popularFoodsIds = $conn->query($popularFoodResult);
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

        .containerWL {
            background-color: white;
            padding: 20px 20px 20px 20px;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2), 0 9px 30px 0 rgba(0, 0, 0, 0.19);
            height: auto;
            width:800px;
            margin-left:125px;
            margin-bottom: 30px;
            margin-top:10px;
            text-align:left;
        }
        .spanWL {
            font-size:18px;
            color:#666;
            font-weight:400;
        }
        .fbHeader {
            font-size:25px;
            color:#222;
            margin-left:125px;
        }

        .fbtable {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        .fbtd {
            text-align: left;
            padding: 16px;
            font-size:13px;
            color:#666;
        }

        .fbtr:nth-child(even) {
            background-color: #f2f2f2;
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
                        <a href="./signup_form/signin.php">Order List</a>
                        <a href="./signup_form/signin.php">Watchlist</a>      
                        <a href="#" class="popular">Popular Food</a>         
                    </div> 

                    <div class="search-box">
                        <input class="hidden-search" type="search" placeholder="search here">
                    </div>
    
                    <div class="icons">
                        <div id="search-btn" class="fas fa-search hidden-search-icon"></div>
                        <a href="./signup_form/signin.php" id="heart" class="fas fa-heart"></a>
                        <a href="cart.php" id="shopping-cart" class="fas fa-shopping-cart"><span id="link_wrapper1"></a>
                        <a href="./signup_form/signin.php"><div id="login-btn" class="fas fa-user"></div></a>
                    </div>

                    <span class="fa fa-bars" id="menuBar"></span>
                </div>
            </div>
        </div>

    <!---- price of items ------->
    <section class="price-items">
        <div class="details_pr">
            <div class="image">
                <img src="admin/food/foodPic/<?php echo $row["food_pic"]; ?>" alt="">
                <div class="pay-image">
                    <p class="lable" ><b>Description:</b> 
                        <span>
                            <?php echo $row["food_description"]; ?>
                            <br><br>
                            <b>Current Temparature:</b> <span>30 <sup style="font-size: 0.7rem;">o</sup>C</span>
                        </span>    
                    </p> 
                </div>
            </div>
            <div class="deatails_items">
                <h4><?php echo $row["food_name"]; ?></h4>
                <hr>
                <form action="cart.php" method="post">
                    <div class="quantity">
                        <span class="lable">Quantity:</span>
                        <input name="quantity" type="number" value="1" min="1" max="<?php echo $row["food_quantity"]; ?>" required>
                    </div>
                    <hr>
                    <div class="price">
                        <span class="lable">Price:</span>
                        <div class="text">   
                            <h2>LKR <span><?php echo $row["food_price"]; ?></span>.00</h2>
                        
                        </div>
                    </div>
                    <hr>
                    <div class="date">
                        <label for="">Requests: </label>
                        <textarea id="subject" name="requests" placeholder="If there are any requests, enter them here.." maxlength="200"></textarea>
                    </div>
                    <hr>

                    <input name="fname" type="hidden" value="<?=$row["food_name"]; ?>" required>
                    <input name="fpic" type="hidden" value="<?=$row["food_pic"]; ?>" required>
                    <input name="fprice" type="hidden" value="<?=$row["food_price"]; ?>" required>

                    <div class="payment">
                        <button type="button" onclick="locationSignIn()" class="buy">Buy It Now</button>
                        <button type="submit" name="addCart" value="<?=$row["food_id"]; ?>" class="cart op">Add to cart</button>
                        <button type="button" onclick="locationSignIn()" class="watch"><i class="bx bx-heart"></i>Add to watchlist</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php
        if (mysqli_num_rows($popularFoodsIds)>0) {
    ?>
    <section class="category_items">
        <h4>Popular Food Items <i class='bx bx-right-arrow-alt'></i></h4>
        <div class="food_items">

        <?php
          while($popularFoodId = mysqli_fetch_assoc($popularFoodsIds)){
            $fid = $popularFoodId['food_id'];
            $resultPopularFood = mysqli_query($conn, "SELECT * FROM food WHERE food_id='$fid'");
            $popularFoodRow = mysqli_fetch_assoc($resultPopularFood);
        ?>

            <div class="col-2" id="<?php echo $fid; ?>" onclick="getFoodId(this.id)">
                <div class="image">
                    <img src="admin/food/foodPic/<?php echo $popularFoodRow["food_pic"]; ?>" alt="">
                </div>
                <div class="pop-content">
                    <h4><?php echo $popularFoodRow["food_name"]; ?></h4>
                    <i class="bx bx-heart"></i>
                </div>
                <div class="price">
                    <p>Rs. <?php echo $popularFoodRow["food_price"]; ?>.00</p>
                </div>
            </div>

        <?php
          }
        ?>    
        </div>
    </section>
    <?php
        }
        if(mysqli_num_rows($resultRows)>0) {
    ?>
   
    <h4 class="fbHeader">Customer Feedback</h4>
    <div class="containerWL">
        <table class="fbtable">
        <?php 
                while($resultRow = mysqli_fetch_assoc($resultRows)){
                    $userid = $resultRow["customer_id"];
                    $resultName = mysqli_query($conn, "SELECT fname, lname FROM customer WHERE customer_id = '$userid'");
                    $userName = mysqli_fetch_assoc($resultName);
        ?>

            <tr class="fbtr">
                <td class="fbtd" style="font-weight:600;"><?php echo $userName["fname"]; ?><?php echo " "; ?><?php echo $userName["lname"]; ?></td>
                <td class="fbtd"><?php echo $resultRow["feedback"]; ?></td>
            </tr>

            <?php
                }
            ?>

        </table>
    </div>

    <?php
        }
    ?>
   

    <!----- footer section  ------->
    <section class="footer section">
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
</body>
</html>

<script>
    function loadXMLDoc5() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("link_wrapper1").innerHTML =
        this.responseText;
        }
    };
    xhttp.open("GET", "cartItemsN.php", true);
    xhttp.send();
    }
    setInterval(function(){
        loadXMLDoc5();
        // 1sec
    },1000);

    window.onload = loadXMLDoc5;
</script>

<script>
    function locationSignIn() {
        let url = "http://localhost/files/CanteenFCT/signup_form/signin.php"
        window.location.href = url;
    }
</script>