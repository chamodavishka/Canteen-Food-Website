<?php
    require '../../config.php';

    $sql = "SELECT COUNT(order_id) AS amount FROM orders WHERE order_status = 'Pending' ORDER BY order_id DESC";
    $searchRows = $conn->query($sql);

    $amount = 0;
    if(mysqli_num_rows($searchRows)>0) {
        while($searchRow = mysqli_fetch_assoc($searchRows)){
            $amount = $searchRow['amount'];
        }
    }
?>
    <span><?php echo "$amount"; ?></span>