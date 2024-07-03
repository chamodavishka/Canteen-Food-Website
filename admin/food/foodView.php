<?php
require '../../config.php';

if(empty($_POST["foodView"])){
    header("Location: adFood.php");
}
if (isset($_POST["foodView"])) {
    $foodId = $_POST["foodView"];
    $result = mysqli_query($conn, "SELECT * FROM food WHERE food_id = '$foodId'");
    $row = mysqli_fetch_assoc($result);
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
    <link rel="style icon" href="../../images/favicon.png">

    <!---- customer css file ------->
    <link rel="stylesheet" href="../../css/sign.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/category.css">

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
                    <a class="logo" href="#">FCT <span>Canteen</span></a>

                    <div class="navbar">
                        <a href="#">Home</a>
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
                        <a href="./signup_form/signin.php" id="shopping-cart" class="fas fa-shopping-cart"></a>
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
                <img src="foodPic/<?php echo $row["food_pic"]; ?>" alt="">
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
                <div class="quantity">
                    <span class="lable">Quantity:</span>
                    <input type="number" value="1" min="1" max="<?php echo $row["food_quantity"]; ?>" required>
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
                    <label for="">Comment: </label>
                    <textarea id="subject" name="subject" placeholder="If there are any requests, comment on here.." maxlength="250" required></textarea>
                </div>
                <hr>
                <div class="payment">
                    <button class="buy">Buy It Now</button>
                    <button class="cart">Add to cart</button>
                    <button class="watch"><i class="bx bx-heart"></i>Add to watchlist</button>
                </div>
                
            </div>
        </div>
    </section>

    <!---- most popular food items -------->
    <section class="category_items">
        <h4>Popular Food Items <i class='bx bx-right-arrow-alt'></i></h4>
        <div class="food_items">
            <div class="col-2">
                <div class="image">
                    <img src="../../categoryPic/mix_rice.jpg" alt="">
                </div>
                <div class="pop-content">
                    <h4>Mix Rice</h4>
                    <i class="bx bx-heart"></i>
                </div>
                <div class="price">
                    <p>Rs: 550.00</p>
                </div>
            </div>
            <div class="col-2">
                <div class="image">
                    <img src="../../categoryPic/mix_rice.jpg" alt="">
                </div>
                <div class="pop-content">
                    <h4>Mix Rice</h4>
                    <i class="bx bx-heart"></i>
                </div>
                <div class="price">
                    <p>Rs: 550.00</p>
                </div>
            </div>
            <div class="col-2">
                <div class="image">
                    <img src="../../categoryPic/mix_rice.jpg" alt="">
                </div>
                <div class="pop-content">
                    <h4>Mix Rice</h4>
                    <i class="bx bx-heart"></i>
                </div>
                <div class="price">
                    <p>Rs: 550.00</p>
                </div>
            </div>
            <div class="col-2">
                <div class="image">
                    <img src="../../categoryPic/mix_rice.jpg" alt="">
                </div>
                <div class="pop-content">
                    <h4>Mix Rice</h4>
                    <i class="bx bx-heart"></i>
                </div>
                <div class="price">
                    <p>Rs: 550.00</p>
                </div>
            </div>
            
        </div>
    </section>
   

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