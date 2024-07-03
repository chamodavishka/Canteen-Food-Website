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

  if (isset($_POST["submitFeedback"])) {
    $OID = $_POST["req4"];
    $feedback = $_POST["req5"];

    $query = "UPDATE orders SET feedback='$feedback' WHERE order_id='$OID'";
    mysqli_query($conn,$query);

    header("Location: orders.php");
  }

  

?>