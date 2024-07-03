<?php
    require '../../config.php';

    $sql = "SELECT COUNT(food_id) AS amount FROM food";
    $searchRows = $conn->query($sql);

    $amount = 0;
    if(mysqli_num_rows($searchRows)>0) {
        while($searchRow = mysqli_fetch_assoc($searchRows)){
            $amount = $searchRow['amount'];
        }
    }
?>
    <span><?php echo "$amount"; ?></span>