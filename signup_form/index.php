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
?>

<!DOCTYPE html>
<html>
    <body>
        <h1>Welcome <?php echo $row["fname"]; ?></h1>
        <a href="logout.php">Logout</a>
    </body>
</html>