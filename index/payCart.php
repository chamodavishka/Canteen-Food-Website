<?php
require '../config.php';

$id = $_SESSION["id"];

date_default_timezone_set("Asia/Colombo");
$dateTime = date("Y-m-d H:i:s");

$total = 0;

foreach ($_SESSION['cart'] as $key => $value) {
    $total = $total + ($value["fprice"] * $value["quantity"]);
}

$result1 = mysqli_query($conn, "SELECT wallet FROM customer WHERE customer_id='$id'");
$row1 = mysqli_fetch_assoc($result1);

$wallet = ($row1['wallet']) - $total;

$query1 = "UPDATE customer SET wallet='$wallet' WHERE customer_id='$id'";
mysqli_query($conn,$query1);

$query = "INSERT INTO orders VALUES ('','$id','$total ','$dateTime','Pending','')";
mysqli_query($conn,$query);

$result = mysqli_query($conn, "SELECT order_id FROM orders WHERE customer_id='$id' ORDER BY order_id DESC LIMIT 1");
$row = mysqli_fetch_assoc($result);

$order_id = $row['order_id'];

foreach ($_SESSION['cart'] as $key => $value) {
    $requests = $value["requests"];
    $food_id = $value['foodId'];
    $quantity = $value['quantity'];

    if ($requests == "") {
        $requests = "No Requests";
    }

    $result2 = mysqli_query($conn, "SELECT food_quantity FROM food WHERE food_id = '$food_id'");
    $row2 = mysqli_fetch_assoc($result2);

    $currentFoodQuantity = $row2['food_quantity'];
    $newFoodQuantity = $currentFoodQuantity - $quantity;

    $query3 = "UPDATE food SET food_quantity='$newFoodQuantity' WHERE food_id='$food_id'";
    mysqli_query($conn,$query3);

    $query2 = "INSERT INTO ordered_foods VALUES ('','$order_id','$food_id','$quantity','$requests')";
    mysqli_query($conn,$query2);
}

unset($_SESSION['cart']);

header("Location: orders.php");
?>