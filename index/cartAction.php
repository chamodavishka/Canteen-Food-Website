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

  if (isset($_POST["submitBuyNow"])) {
    $foodId = $_POST["submitBuyNow"];
    $requests = $_POST["requests"];
    $quantity = $_POST["quantity"];
    $fprice = $_POST["fprice"];
    $tPrice = $quantity * $fprice;

    date_default_timezone_set("Asia/Colombo");
    $dateTime = date("Y-m-d H:i:s");

    $result1 = mysqli_query($conn, "SELECT wallet FROM customer WHERE customer_id='$id'");
    $row1 = mysqli_fetch_assoc($result1);

    $wallet = ($row1['wallet']) - $tPrice;

    $query1 = "UPDATE customer SET wallet='$wallet' WHERE customer_id='$id'";
    mysqli_query($conn,$query1);

    $query = "INSERT INTO orders VALUES ('','$id','$tPrice ','$dateTime','Pending','')";
    mysqli_query($conn,$query);

    $result = mysqli_query($conn, "SELECT order_id FROM orders WHERE customer_id='$id' ORDER BY order_id DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);

    $order_id = $row['order_id'];

    if ($requests == "") {
        $requests = "No Requests";
    }

    $result2 = mysqli_query($conn, "SELECT food_quantity FROM food WHERE food_id = '$foodId'");
    $row2 = mysqli_fetch_assoc($result2);

    $currentFoodQuantity = $row2['food_quantity'];
    $newFoodQuantity = $currentFoodQuantity - $quantity;

    $query3 = "UPDATE food SET food_quantity='$newFoodQuantity' WHERE food_id='$foodId'";
    mysqli_query($conn,$query3);

    $query2 = "INSERT INTO ordered_foods VALUES ('','$order_id','$foodId','$quantity','$requests')";
    mysqli_query($conn,$query2);

    header("Location: orders.php");
  }


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
    header("Location: cart.php");
  }

  if (isset($_POST["addWatchlist"])) {
    $foodId = $_POST["addWatchlist"];

    $query4 = "INSERT INTO watchlist VALUES ('','$id','$foodId')";
    mysqli_query($conn,$query4);

    header("Location: watchlist.php");
  }

  if (isset($_POST["removeWatchlist"])) {
    $foodId = $_POST["removeWatchlist"];

    $query5 = "DELETE FROM watchlist WHERE food_id='$foodId'";
    mysqli_query($conn,$query5);

    header("Location: food.php?foodId=$foodId");

  }
?>