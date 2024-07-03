<?php
  require '../config.php';

  if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT wallet FROM customer WHERE customer_id = '$id'");
    $row = mysqli_fetch_assoc($result);
  }
  else {
    header("Location: ../signInUp.php");
  }

  if (isset($_POST["canOrder"])) {
    $order_id = $_POST["req1"];
    $tPrice = $_POST["req2"];

    $currentWallet = $row['wallet'];
    $newCurrentWallet = $currentWallet + $tPrice;

    $query1 = "UPDATE orders SET Order_status='Cancelled' WHERE order_id='$order_id'";
    mysqli_query($conn,$query1);

    $query2 = "UPDATE customer SET wallet='$newCurrentWallet' WHERE customer_id='$id'";
    mysqli_query($conn,$query2);

    header("Location: orders.php");
  }
?>