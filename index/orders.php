<?php
  require '../config.php';

  if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id = '$id'");
    $row = mysqli_fetch_assoc($result);
  }
  else {
    header("Location: ../signInUp.php");
  }

  $sql1 = "SELECT * FROM orders WHERE customer_id = '$id' ORDER BY order_id DESC LIMIT 50";
  $orderRows = $conn->query($sql1);

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
    <link rel="style icon" href="../images/favicon.png">

    <!---- customer css file ------->
    <link rel="stylesheet" href="../css/sign.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/category.css">
    <link rel="stylesheet" type="text/css" href="../adFood.css">
    <link rel="stylesheet" type="text/css" href="../addFood.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" type="text/css" href="payConfirmModel.css">
    <link rel="stylesheet" type="text/css" href="orders.css">

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
            <a class="logo" href="index.php">FCT <span>Canteen</span></a>

            <div class="navbar">
                <a href="index.php">Home</a>
                <a href="orders.php" style="color: var(--dark-orange);">Order List</a>
                <a href="watchlist.php">Watchlist</a>      
                <a href="#" class="popular">Popular Food</a>         
            </div> 

            <div class="search-box">
                <input class="hidden-search" type="search" placeholder="search here">
            </div>

            <div class="icons">
                <a href="cart.php" id="shopping-cart" class="fas fa-shopping-cart"><span id="link_wrapper1"></span></a>
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

    <div class="contentOrders"><br><br>

        <div class="containerOrders">

          <div class="usersSus">

            <?php
              if(mysqli_num_rows($orderRows)>0) {
                while($orderRow = mysqli_fetch_assoc($orderRows)){
            ?>
              
                <button class="accordion" id="<?=$orderRow["order_id"]; ?>">
                  OID: <?php echo $orderRow["order_id"]; ?><?php echo " - "; ?>
                  <?php echo $orderRow["date_time"]; ?><?php echo " - "; ?>Rs.
                  <?php echo $orderRow["total_price"]; ?>.00<?php echo " - "; ?>
                  <?php
                    if (($orderRow["order_status"] == "Cancelled") || ($orderRow["order_status"] == "Canceled by the Canteen")) {
                  ?>
                    <span style="color:#ff3c3c;"><?php echo $orderRow["order_status"]; ?></span>
                  <?php
                    } elseif ($orderRow["order_status"] == "Ready") {
                  ?>
                    <span style="color:#02a00fa6; font-weight: 700;"><?php echo $orderRow["order_status"]; ?></span>
                  <?php
                    } elseif ($orderRow["order_status"] == "Processing") {
                  ?>
                    <span style="color:#00b39b85; font-weight: 700;"><?php echo $orderRow["order_status"]; ?></span>
                  <?php
                    } else {
                  ?>
                    <?php echo $orderRow["order_status"]; ?>
                  <?php
                    }
                  ?>
                </button>
                <div class="panel">

                  <table class="tableUserDetails">

                    <?php
                      $OID = $orderRow["order_id"];
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
                    <tr style="background-color: white;">
                      <td style="padding: 15px 0px 0px 40px;" colspan="4">

                        <?php
                          if ($orderRow["order_status"] == "Pending") {
                        ?>
                          <span class="cancelOrderSpan" onclick="canOrder(<?php echo $orderRow['order_id']; ?>)">Cancel Order</span>
                        <?php
                          }
                        ?>

                        <?php
                          if (($orderRow["order_status"] == "Finished") && ($orderRow["feedback"] == "")) {
                        ?>
                          <span class="cancelOrderSpan" onclick="feedbackModel(<?php echo $orderRow['order_id']; ?>)">Leave Feedback</span>
                        <?php
                          }
                        ?>

                        <span class="cancelOrderSpan">Contact Canteen</span>

                      </td>
                    </tr>
                  </table>

                </div>

            <?php
                }
              } else {
            ?>
            <div style="text-align: center; margin-top: 30px; margin-bottom:30px;">
                <span class="emptyCartText">In the absence of existing orders, let us initiate a graceful commencement of your shopping experience.</span><br>
                <button type="button" class="buttonOL" onclick="lct()"><span>Start Shopping </span></button>
            </div>
            <?php
              }
            ?>

          </div>


        </div>

    </div><br><br><br>


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

    <div id="id03" class="modal3">
  
        <form class="modal3-content4 animate3" action="feedback.php" method="post">
            <div class="imgcontainer3">
            <span onclick="document.getElementById('id03').style.display='none'" class="close3" title="Close Modal">&times;</span>
            </div>
            <div class="containerReq">
                <h1 class="modelh1">Leave Feedbak</h1>
                <input type="hidden" id="req4" name="req4" required>
                <textarea id="subject" name="req5" placeholder="Kindly share your feedback here.." maxlength="200"></textarea>
                <button type="button" class="cnbtn2" onclick="document.getElementById('id03').style.display='none'">Cancel</button>
                <button type="submit" class="sbbtn3" name="submitFeedback">Confirm</button>
            </div>
        </form>
    </div>

    <div id="id04" class="modal3">
  
        <form class="modal3-content3 animate3" action="cancelOrder.php" method="post">
            <div class="imgcontainer3">
            <span onclick="document.getElementById('id04').style.display='none'" class="close3" title="Close Modal">&times;</span>
            </div>
            <div class="containerReq">
                <h1 class="modelh1">Revoke Order</h1>
                <p class="modelp">Confirming this action will result in the cancellation of your order.</p>
                <input type="hidden" id="req1" name="req1" required>
                <input type="hidden" id="req2" name="req2" required>
                <button type="button" class="cnbtn2" onclick="document.getElementById('id04').style.display='none'">Cancel</button>
                <button type="submit" class="sbbtn2" name="canOrder">Confirm</button>
            </div>
        </form>
    </div>


     <!----- cutomer js file ------->
    <script src="../Js/script.js"></script>

    <script>
        function logout() {
            window.location = "http://localhost/files/CanteenFCT/signup_form/logout.php";
        }

        function lct() {
            window.location = "http://localhost/files/CanteenFCT/index/index.php#Location1";
        }
    </script>

    <script>
    function canOrder(str) {
        document.getElementById("req1").value = str;
        tp = document.getElementById("tp").value;
        document.getElementById("req2").value = tp;
        document.getElementById('id04').style.display='block';
    }

    function feedbackModel(str) {
        document.getElementById("req4").value = str;
        document.getElementById('id03').style.display='block';
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

    <script>
        // Get the modal
        var modal1 = document.getElementById('id03');
        var modal2 = document.getElementById('id04');
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
    </script>

</body>
</html>