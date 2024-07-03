<?php
  require '../../config.php';

  $cateResult = "SELECT * FROM category";
  $cateRows = $conn->query($cateResult);

  if (isset($_POST["submit_refill"])) {
    $categoryId = $_POST["foodCategory"];
    $filter = $_POST["foodFilter"];

    if(($categoryId)=='all'){
        $foodResult = "SELECT * FROM food";
        $foodRows = $conn->query($foodResult);
    }else{
        $foodResult = "SELECT * FROM food WHERE cate_id='$categoryId'";
        $foodRows = $conn->query($foodResult);
    }

    if(($filter)=='all'){
        while($foodRow = mysqli_fetch_assoc($foodRows)){
            $refillQuantity=$foodRow["refill"];
            $foodId=$foodRow["food_id"];
            $query = "UPDATE food SET food_quantity='$refillQuantity' WHERE food_id='$foodId' AND refill>0";
            mysqli_query($conn,$query);
        }
    }else{
        while($foodRow = mysqli_fetch_assoc($foodRows)){
            $refillQuantity=$foodRow["refill"];
            $foodId=$foodRow["food_id"];
            $query = "UPDATE food SET food_quantity='$refillQuantity' WHERE food_id='$foodId' AND refill>0 AND food_quantity=0";
            mysqli_query($conn,$query);
        }
    }
    header("Location: adCategory.php");
    
  }
?>