<?php
    require '../../config.php';

    $sql = "SELECT * FROM orders WHERE order_status = 'Pending' ORDER BY order_id DESC";
    $searchRows = $conn->query($sql);

    if(mysqli_num_rows($searchRows)>0) {
        while($searchRow = mysqli_fetch_assoc($searchRows)){
            $OID = $searchRow["order_id"];
            $resultStId = mysqli_query($conn, "SELECT reg_no, customer_id FROM customer WHERE customer_id = ANY (SELECT customer_id FROM orders WHERE order_id = '$OID')");
            $rowStId = mysqli_fetch_assoc($resultStId);
            $stRegNo = $rowStId['reg_no'];
            $stId = $rowStId['customer_id'];

    ?>
    <table class="suspUser">
            <tr>
                <td style="background-color:#ddd; color:#777;" colspan="4">
                    OID: <?php echo $searchRow["order_id"]; ?><?php echo " - "; ?>
                    <?php echo $stRegNo; ?><?php echo " - "; ?>Rs.
                    <?php echo $searchRow["total_price"]; ?>.00<?php echo " - "; ?>
                    <?php echo $searchRow["date_time"]; ?>
                </td>
            </tr>
            <?php
                
                $sql2 = "SELECT * FROM ordered_foods WHERE order_id = '$OID' ORDER BY order_food_id DESC";
                $orderFoodRows = $conn->query($sql2);
                while($orderFoodRow = mysqli_fetch_assoc($orderFoodRows)){
                    $fId = $orderFoodRow["food_id"];
                    $sql3 = "SELECT * FROM food WHERE food_id = '$fId'";
                    $foodRows = $conn->query($sql3);
                    $fname = "";
                    $fTPrice = 0;
                    while($foodRow = mysqli_fetch_assoc($foodRows)){
                        $fname = $foodRow["food_name"];
                        $fPrice = $foodRow["food_price"];
                        $fTPrice = $fPrice * ($orderFoodRow["quantity"]);
                    }
            ?>
                <tr>
                    <td style="width: 230px;"><span class="spanRecode">Dish: </span><?php echo $fname; ?></td>
                    <td style="width: 100px;"><span class="spanRecode">Qty: </span><?php echo $orderFoodRow["quantity"]; ?></td>
                    <td><span class="spanRecode">Reqs: </span><?php echo $orderFoodRow["comment"]; ?></td>
                </tr>

        <?php
                }
        ?>
        <input type="hidden" id="tp" value="<?php echo $searchRow["total_price"]; ?>">
        <input type="hidden" id="stid" value="<?php echo $stId; ?>">
                <tr>
                    <td style="background-color:white;" colspan="4">
                    <span class="cancelOrderSpan" onclick="conOrder(<?php echo $OID; ?>)">Contact Customer</span>
                    <span class="cancelOrderSpan" onclick="canOrder(<?php echo $OID; ?>)">Cancel Order</span>
                    <span class="cancelOrderSpan" onclick="reaOrder(<?php echo $OID; ?>)">Mark as Ready</span>
                    <span class="cancelOrderSpan" onclick="proOrder(<?php echo $OID; ?>)">Mark as Processing</span></td>
                </tr>
        <?php
            }
        ?>
        </table>
    <?php
        } else { 
    ?>
        <h3 class="header3">Regrettably, there are no new orders available for display at this time.</h3>
        <br><br><br>
    <?php
        }
    ?>


