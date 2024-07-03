<?php
require '../../config.php';

$limit = 2;

// Default users page swap
if (isset($_POST["nextSubmit"])) {
    $offset = $_POST["nextSubmit"];
    $offset +=$limit;
    $_SESSION["offset"] = $offset;
    header("Location: adUser.php");
}

if (isset($_POST["backSubmit"])) {
    $offset = $_POST["backSubmit"];
    $offset -=$limit;
    $_SESSION["offset"] = $offset;
    header("Location: adUser.php");
}

if (isset($_POST["homeSubmit"])) {
    $offset = 0;
    $_SESSION["offset"] = $offset;
    header("Location: adUser.php");
}
?>