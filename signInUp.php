<?php
  require 'config.php';
  if(!empty($_SESSION["id"])){
    header("Location: index.php");
  }
  //php for sign up
  if (isset($_POST["submitup"])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $student_no = $_POST["student_no"];
    $email = $_POST["email"];
    $contact_no = $_POST["contact_no"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];
    $profile_picture = $_POST["profile_pic"];
    $duplicate = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$email'");
    if(mysqli_num_rows($duplicate) > 0) {
      echo "<script> alert('Email has Already Taken'); </script>";
    }
    else {
      if($password == $repeat_password) {
        $query = "INSERT INTO customer VALUES('','$first_name','$last_name','$contact_no','$email','$student_no','$password','$profile_picture','')";
        mysqli_query($conn,$query);
        echo "<script> alert('Registration is Successful'); </script>";
      }
      else {
        echo "<script> alert('Password does Not Match'); </script>";
      }
    }

  }
  //php for sign in
  if (isset($_POST["submitin"])) {
    $userEmail = $_POST["lEmail"];
    $userPassword = $_POST["lPassword"];
    $result = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$userEmail'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0) {
      if($userPassword == $row["password"]){
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["customer_id"];
        header("Location: index.php");
      }
      else {
        echo "<script> alert('Wrong Password'); </script>";
      }
    }
    else {
      echo "<script> alert('User Not Registered'); </script>";
    }
  }

    $cateResult = "SELECT * FROM category WHERE cate_status='Visible' 
    AND cate_id= ANY(SELECT DISTINCT cate_id FROM food WHERE food_quantity > 0)";
    $cateRows = $conn->query($cateResult);

    $popularFoodResult = "SELECT food_id FROM ordered_foods GROUP BY food_id ORDER BY COUNT(food_id) DESC LIMIT 9";
    $popularFoodsIds = $conn->query($popularFoodResult);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!---- title --------->
    <title>FCT eCanteen</title>

    <!------ favicon icon ----------->
    <link rel="style icon" href="./images/favicon.png">

    <!---- customer css file ------->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/sign.css">
    <link rel="stylesheet" href="./css/searchBtn.css">

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

    <!------ swiper cdn link --------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>
<body>

    <!-------- header section start ----------->
    <div class="top-header">
        <div class="header-one">
                <a class="logo" href="./signInUp.php">FCT <span>Canteen</span></a>

                <div class="navbar">
                    <a href="signinUp.php">Home</a>
                    <a href="./signup_form/signin.php">Order List</a>
                    <a href="./signup_form/signin.php">Watchlist</a>      
                    <a href="#popular_food" class="popular">Popular Food</a>         
                </div> 

                <div class="search-box">
                    <input type="search" placeholder="search here">
                </div>

                <div class="icons">
                    <div id="search-btn" class="fas fa-search"></div>
                    <a href="./signup_form/signin.php"  class="fas fa-heart"></a>
                    <a href="cart.php" class="fas fa-shopping-cart"><span id="link_wrapper1"></span></a>
                    <a href="./signup_form/signin.php"><div id="login-btn" class="fas fa-user"></div></a>
                </div>

                <span class="fa fa-bars" id="menuBar"></span>
            </div>
        </div>
    </div>

    <!-------- home section start ----------->
    <section class="home" id="home">
        <div class="row">  
            <div class="swiper mySwiper">    
                <div class="swiper-wrapper">   
                  <div class="swiper-slide">
                        <img src="./images/bg 1.jpg" alt="">
                        <div class="content">
                            <div class="order">
                                <h2>Get Your Best Ordering</h2>
                                <button id="order-now" class="order-btn" type="submit" onclick="location1()" name="ordernow">Order Now</button>
                                <button id="contact-now" class="contact-btn" type="submit" name="contactus" onclick="location2()">food trend</button>
                            </div>
                        </div>
                  </div>
                  <div class="swiper-slide">
                        <img src="./images/bg 2.jpg" alt="">
                        <div class="content">
                            <div class="order">
                                <h2>Get Your Best Ordering</h2> 
                                <button id="order-now2" class="order-btn" type="submit" onclick="location1()" name="ordernow">Order Now</button>
                                <button id="contact-now2" class="contact-btn" type="submit" name="contactus" onclick="location2()">food trend</button>
                                   
                            </div>
                        </div>
                  </div>
                  <div class="swiper-slide">
                        <img src="./images/bg 3.jpg" alt="">
                        <div class="content">
                            <div class="order">
                                <h2>Get Your Best Ordering</h2>
                                <button id="order-now3" class="order-btn" type="submit" onclick="location1()" name="ordernow">Order Now</button>
                                <button id="contact-now3" class="contact-btn" type="submit" name="contactus" onclick="location2()">food trend</button>
                            </div>
                        </div>
                  </div>   
                </div>
            </div>
        </div>
    </section>

    <!---------- Category section start -------->
    <section id="Location1" class="items section">
        <div class="main-row">
            <div class="items-topics">
                <h2>our Categories</h2>
            </div>
            <div class="ourCat">
                <?php
                    while($cateRow = mysqli_fetch_assoc($cateRows)){
                ?>   
                        <div class="col-1" id="<?php echo $cateRow["cate_id"]; ?>" onclick="getCateFood(this.id)">
                            <div class="images">
                                <img src="admin/category/categoryPic/<?php echo $cateRow["cate_pic"]; ?>" alt="">
                            </div>
                            <div class="cat-content">
                                <h3><?php echo $cateRow["cate_name"]; ?></h3>                 
                            </div>
                        </div>
                <?php
                    }
                ?>                
            </div>
        </div>
    </section>


        <!--------- popular foods -------->
        <section class="popular section" id="popular_food">
        <div class="main-row">
            <div class="items-topics">
                <h2 class="popular-title">Popular Foods</h2>
            </div>

            <div class="popular-foods">
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
                        <i class="fa fa-heart-o"></i>
                    </div>
                    <div class="price">
                        <p>Rs. <?php echo $popularFoodRow["food_price"]; ?>.00</p>
                    </div>
                </div>
            <?php
              }
            ?>

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


    <!----- swiper js link ------->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!----- cutomer js file ------->
    <script src="./Js/script.js"></script>
    <script src="./Js/searchBtn.js"></script>
    
</body>
</html>

<script>
  function getCateFood(svalue) {
    let url = "http://localhost/files/CanteenFCT/cateFood.php"
    window.location.href = url+"?cateId="+svalue;
  }

  function location1() {
    window.location = "http://localhost/files/CanteenFCT/signInUp.php#Location1";
  }

  function location2() {
    window.location = "http://localhost/files/CanteenFCT/index/index.php#popular_food";
  }

  function getFoodId(svalue) {
    let url = "http://localhost/files/CanteenFCT/food.php"
    window.location.href = url+"?foodId="+svalue;
  }

</script>

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