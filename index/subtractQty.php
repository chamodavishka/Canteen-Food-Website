<?php
require '../config.php';


$q = $_REQUEST["q"];


if ($q) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value["foodId"] == $q) {
            if (($_SESSION['cart'][$key]['quantity'])>1)
                $_SESSION['cart'][$key]['quantity'] = ($_SESSION['cart'][$key]['quantity']) - 1;
        }
    }
}
              

?>