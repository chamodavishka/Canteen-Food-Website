<?php
require '../config.php';
if (!empty($_SESSION['cart'])) {
?>
    <table class="cateItem">
        <tr>
            <th>Image</th>
            <th style="min-width: 200px; text-align: left;">Name</th>
            <th style="min-width: 130px; text-align: left;">Quantity</th>
            <th>Price(LKR)</th>
            <th style="min-width: 300px; text-align: left;">Requests</th>
            <th>Action</th>
        </tr>
                
<?php
    foreach ($_SESSION['cart'] as $key => $value) {
        $requests = $value["requests"];

        if ($requests == "") {
            $requests = "No Requests";
        }
?>

        <tr>
            <td><image src="../admin/food/foodPic/<?php echo $value["fpic"]; ?>" width="100px" height="100px"></td>
            <td><span class="foodName2"><?php echo $value["fname"]; ?></span></td>
            <td>
                <div style="margin-left: -7px;" class="col-27-1" onclick="subtract(<?=$value['foodId']; ?>)">-</div> 
                <div class="col-27">
                    <?php echo $value["quantity"]; ?>
                </div>
                <div class="col-27-1" onclick="add(<?=$value['foodId']; ?>)">+</div> 
            </td>
            <td><span style="float: right;" class="price"><?php echo ($value["fprice"] * $value["quantity"]); ?>.00</span></td>
            <td><div><?php echo $requests; ?></div></td>
            <td><button type="button" class="cartbtn1" name="removeCartItem" value="<?php echo $value["foodId"]; ?>" onclick="remove(this.value)">Remove</button></td>
        </tr>

<?php
    }
?>
    </table>
<?php
}
?>