<?php
    require '../../config.php';

    $q = $_REQUEST["q"];

    $sql1 = "SELECT A.deposit_id, A.amount, A.new_amount, A.time, B.reg_no, A.deposit_status FROM deposit A, customer B 
            WHERE A.customer_id=B.customer_id AND (B.reg_no LIKE '$q%' OR A.deposit_id LIKE '$q%') ORDER BY A.deposit_id DESC LIMIT 100";
    $searchRows = $conn->query($sql1);

    $sql2 = "SELECT A.deposit_id, A.amount, A.new_amount, A.time, B.reg_no, A.deposit_status FROM deposit A, customer B 
            WHERE A.customer_id=B.customer_id ORDER BY A.deposit_id DESC LIMIT 100";
    $defaultRows = $conn->query($sql2);

    if ($q) {

        if(mysqli_num_rows($searchRows)>0) {
?>
        <table class="cateItem2">
            <tr><th style="border-top: none;" colspan="5">DETAILS</th></tr>
            <tr style="background-color:#ddd;">
                <td><span class="spanRecode2">Deposit Id</span></td>
                <td><span class="spanRecode2">Amount</span></td>
                <td><span class="spanRecode2">Wallet Balance</span></td>
                <td><span class="spanRecode2">Date & Time</span></td>
                <td><span class="spanRecode2">User Id</span></td>
            </tr>
    <?php
        } else {
            ?>
            <br><h3 class="header3">No results to show with <span style="font-weight: bold;"><?php echo "$q"; ?></span></h3><br><hr style="margin-bottom:18px;">
    <?php
        }
        while($searchRow = mysqli_fetch_assoc($searchRows)){
    ?>
            <tr>
                <td><span class="spanRecode"><?=$searchRow["deposit_id"]; ?></span></td>
                <?php
                    if(($searchRow["deposit_status"]) == 'Include') {
                ?>
                    <td><span class="spanRecode3">Rs. <?=$searchRow["amount"]; ?> (CR)</span></td>
                <?php
                    } else {
                ?>
                    <td><span class="spanRecode4">Rs. <?=$searchRow["amount"]; ?> (DR)</span></td>
                <?php 
                    }
                ?>
                <td><span class="spanRecode">Rs. <?=$searchRow["new_amount"]; ?></span></td>
                <td><span class="spanRecode"><?=$searchRow["time"]; ?></span></td>
                <td><span class="spanRecode"><?=$searchRow["reg_no"]; ?></span></td>
            </tr>
<?php
    }
?>
</table>
<?php
} else {

    if(mysqli_num_rows($defaultRows)>0) {
?>
        <table class="cateItem2">
            <tr><th style="border-top: none;" colspan="5">DETAILS - LATEST RECORDS</th></tr>
            <tr style="background-color:#ddd;">
                <td><span class="spanRecode2">Deposit Id</span></td>
                <td><span class="spanRecode2">Amount</span></td>
                <td><span class="spanRecode2">Wallet Balance</span></td>
                <td><span class="spanRecode2">Date & Time</span></td>
                <td><span class="spanRecode2">User Id</span></td>
            </tr>
    <?php
        }
        while($defaultRow = mysqli_fetch_assoc($defaultRows)){
    ?>
            <tr>
                <td><span class="spanRecode"><?=$defaultRow["deposit_id"]; ?></span></td>
                <?php
                    if(($defaultRow["deposit_status"]) == 'Include') {
                ?>
                    <td><span class="spanRecode3">Rs. <?=$defaultRow["amount"]; ?> (CR)</span></td>
                <?php
                    } else {
                ?>
                    <td><span class="spanRecode4">Rs. <?=$defaultRow["amount"]; ?> (DR)</span></td>
                <?php 
                    }
                ?>
                <td>Rs. <span class="spanRecode"><?=$defaultRow["new_amount"]; ?></span></td>
                <td><span class="spanRecode"><?=$defaultRow["time"]; ?></span></td>
                <td><span class="spanRecode"><?=$defaultRow["reg_no"]; ?></span></td>
            </tr>
<?php
    }
?>
</table>
<?php
}
?>