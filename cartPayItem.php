<?php
require 'config.php';

$items = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $items = $items + $value["quantity"];
    }
?>
    <span style="float: right;" id="totalPrice" class="totalPrice"><?php echo $items; ?></span>
<?php
} else {
?>
    <span style="float: right;" id="total" class="totalPrice">0</span>
<?php
}
?>