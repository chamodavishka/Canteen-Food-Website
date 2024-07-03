<?php
require '../config.php';

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id = '$id'");
    $row = mysqli_fetch_assoc($result);
}else {
    header("Location: ../signInUp.php");
}

    $foodResult = "SELECT * FROM watchlist INNER JOIN food ON watchlist.food_id = food.food_id WHERE watchlist.customer_id='$id'";
    $foodRows = $conn->query($foodResult);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----- Rice title ------>
    <title>FCT eCanteen</title>

    <!------ favicon icon ----------->
    <link rel="style icon" href="../images/favicon.png">

    <!---- customer css file ------->
    <link rel="stylesheet" href="../css/sign.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/category.css">
    <link rel="stylesheet" href="index.css">
      
       
   
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

       <style>
        .containerWL {
            background-color: white;
            padding: 50px 20px 20px 20px;
            box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2), 0 9px 30px 0 rgba(0, 0, 0, 0.19);
            min-height: 200px;
            width:700px;
            margin-left:200px;
            margin-bottom: 30px;
            margin-top:30px;
            text-align:center;
        }
        .spanWL {
            font-size:20px;
            color:#777;
            font-weight:400;
        }
       </style>
   
     
</head>
<body>
    
    <div class="top-header">
        <div class="header-one">
                <a class="logo" href="index.php">FCT <span>Canteen</span></a>

                <div class="navbar">
                    <a href="index.php">Home</a>
                    <a href="orders.php">Order List</a>
                    <a href="watchlist.php" style="color: var(--dark-orange);">Watchlist</a>      
                    <a href="#popular_food" class="popular">Popular Food</a>         
                </div> 

                <div class="search-box">
                    <input class="hidden-search" type="search" placeholder="search here">
                </div>

                <div class="icons">
                    <a href="cart.php" id="shopping-cart" class="fas fa-shopping-cart"><span id="link_wrapper1"></a>
                    <a class="uil uil-coins ab"><span class="walletSpan">Rs. <?php echo $row["wallet"]; ?>.00</span></a>
                    <a class="ab dropdown">
                        <img class="userImg" src="../signup_form/profilePic/<?php echo $row["profile_pic"]; ?>">
                        <span class="nameSpan dropbtn"><?php echo $row["fname"]; ?><i class="uil uil-angle-down ab ap"></i></span>
                        <div class="dropdown-content">
                            <span class="userSpan">Link 1</span>
                            <span class="userSpan">Link 2</span>
                            <span class="userSpan"onclick="logout()">Log out</span>
                        </div>
                    </a>
                </div>

                <span class="fa fa-bars" id="menuBar"></span>
            </div>
        </div>
    </div>

    <!---- category items ------->
    <section class="category_items">
        <div class="food_items">
        <?php
          if(mysqli_num_rows($foodRows)>0) {
            while($foodRow = mysqli_fetch_assoc($foodRows)){
        ?>
            <div class="col-2" id="<?php echo $foodRow["food_id"]; ?>" onclick="getFoodId(this.id)">
                <div class="image">
                    <img src="../admin/food/foodPic/<?php echo $foodRow["food_pic"]; ?>" alt="">
                </div>
                <div class="pop-content">
                    <h5 style="font-size:18px"><?php echo $foodRow["food_name"]; ?></h5>
                    <i class="bx bx-heart"></i>
                </div>
                <div class="price">
                    <p>LKR <?php echo $foodRow["food_price"]; ?>.00</p>
                </div>
            </div>
        <?php
            }
          } else {
        ?>
            <div class="containerWL">
                <span class="spanWL">There are currently no items in the watchlist available for viewing.</span>
            </div>
        <?php
          }
        ?>
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
    <script src="../Js/script.js"></script>

</body>
</html>

<script>
  function getFoodId(svalue) {
    let url = "http://localhost/files/CanteenFCT/index/food.php"
    window.location.href = url+"?foodId="+svalue;
  }

  function logout() {
    window.location = "http://localhost/files/CanteenFCT/signup_form/logout.php";
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
    xhttp.open("GET", "../cartItemsN.php", true);
    xhttp.send();
    }
    setInterval(function(){
        loadXMLDoc5();
        // 1sec
    },1000);

    window.onload = loadXMLDoc5;
</script>