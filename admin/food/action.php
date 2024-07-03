<?php
require '../../config.php';

if(empty($_POST["foodVisible"])){
  if(empty($_POST["foodHide"])){
    header("Location: adCategory.php");
  }
}

if (isset($_POST["foodHide"])) {
  $foodId = $_POST["foodHide"];
  $query = "UPDATE food SET food_status='Hidden' WHERE food_id='$foodId'";
  mysqli_query($conn,$query);
  echo "<script>
    let url = 'http://localhost/files/CanteenFCT/admin/food/adFood.php#';
    url += 'Visible';
    window.location= url;
  </script>";
}

if (isset($_POST["foodVisible"])) {
  $foodId = $_POST["foodVisible"];
  $query = "UPDATE food SET food_status='Visible' WHERE food_id='$foodId'";
  mysqli_query($conn,$query);
  echo "<script>
    let url = 'http://localhost/files/CanteenFCT/admin/food/adFood.php#';
    url += 'Hidden';
    window.location= url;
  </script>";
}
?>