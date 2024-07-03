<?php
require 'config.php';

$total = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $total = $total + ($value["fprice"] * $value["quantity"]);
    }
?>
    <span style="float: right;" id="totalPrice" class="totalPrice">Rs. <span><?php echo $total; ?></span>.00</span>
<?php
} else {
?>
    <span style="float: right;" id="total" class="totalPrice">0</span>
<?php
}
?>