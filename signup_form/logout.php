<?php
require '../config.php';
unset($_SESSION['id']);
unset($_SESSION['cart']);
header("Location: ../signInUp.php");