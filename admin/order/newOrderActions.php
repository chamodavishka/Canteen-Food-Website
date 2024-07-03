<?php
  require '../../config.php';

  if (isset($_POST["canOrder"])) {
    $order_id = $_POST["req1"];
    $tPrice = $_POST["req2"];
    $id = $_POST["req3"];
    $result = mysqli_query($conn, "SELECT wallet FROM customer WHERE customer_id = '$id'");
    $row = mysqli_fetch_assoc($result);

    $currentWallet = $row['wallet'];
    $newCurrentWallet = $currentWallet + $tPrice;

    $query1 = "UPDATE orders SET Order_status='Canceled by the Canteen' WHERE order_id='$order_id'";
    mysqli_query($conn,$query1);

    $query2 = "UPDATE customer SET wallet='$newCurrentWallet' WHERE customer_id='$id'";
    mysqli_query($conn,$query2);

    header("Location: adOrder.php");
  }

  if (isset($_POST["proOrder"])) {
    $order_id = $_POST["req4"];

    $query1 = "UPDATE orders SET Order_status='Processing' WHERE order_id='$order_id'";
    mysqli_query($conn,$query1);

    header("Location: adOrder.php");
  }

  if (isset($_POST["reaOrder"])) {
    $order_id = $_POST["req5"];

    $query1 = "UPDATE orders SET Order_status='Ready' WHERE order_id='$order_id'";
    mysqli_query($conn,$query1);

    header("Location: adOrder.php");
  }

  if (isset($_POST["reaOrderP"])) {
    $order_id = $_POST["req5"];

    $query1 = "UPDATE orders SET Order_status='Ready' WHERE order_id='$order_id'";
    mysqli_query($conn,$query1);

    header("Location: tabProcess.php");
  }

  if (isset($_POST["finOrder"])) {
    $order_id = $_POST["req5"];

    $query1 = "UPDATE orders SET Order_status='Finished' WHERE order_id='$order_id'";
    mysqli_query($conn,$query1);

    header("Location: tabReady.php");
  }
?>