<?php
require 'config.php';

$items = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $items = $items + $value["quantity"];
    }
?>
    <span style="float: right;" id="total" class="cartItemsSpan"><?php echo $items; ?></span>
<?php
}
?>