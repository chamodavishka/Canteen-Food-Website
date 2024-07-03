<?php
    require 'config.php';
    $q = $_REQUEST["q"];


    if ($q) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["foodId"] == $q) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
?>