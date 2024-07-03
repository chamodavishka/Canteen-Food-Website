<?php
require '../config.php';
$q = $_REQUEST["q"];

$result = mysqli_query($conn, "SELECT * FROM food WHERE food_id='$q'");
$row = mysqli_fetch_assoc($result);

if ($q) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value["foodId"] == $q) {
            if (($_SESSION['cart'][$key]['quantity'])<($row["food_quantity"]))
                $_SESSION['cart'][$key]['quantity'] = ($_SESSION['cart'][$key]['quantity']) + 1;
        }
    }
}
              

?>