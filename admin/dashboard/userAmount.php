<?php
    require '../../config.php';

    $sql = "SELECT COUNT(customer_id) AS amount FROM customer WHERE customer_id NOT IN (SELECT customer_id FROM suspended_customer)";
    $searchRows = $conn->query($sql);

    $amount = 0;
    if(mysqli_num_rows($searchRows)>0) {
        while($searchRow = mysqli_fetch_assoc($searchRows)){
            $amount = $searchRow['amount'];
        }
    }
?>
    <span><?php echo "$amount"; ?></span>