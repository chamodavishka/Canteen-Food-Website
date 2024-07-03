<?php
  require '../config.php';

  if(!empty($_SESSION["id"])){
    $id2 = $_SESSION["id"];
    $result2 = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id = '$id2'");
    $row2 = mysqli_fetch_assoc($result2);
  }

  $totalAmount = 0;

  if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
      $totalAmount = $totalAmount + ($value["fprice"] * $value["quantity"]);
    }
  }
?>

<h2 class="text1">Checkout</h2><hr>

<?php
  if (empty($_SESSION['cart'])) {
?>
  <div style="text-align: center; margin-top: 15px;">
    <span class="emptyCartText">Your cart, at this moment, awaits the commencement of a delightful shopping journey. Shall we begin?</span><br>
    <button type="button" class="btnStartShopping" onclick="lct()">Start Shopping</button>
  </div>
<?php
  } elseif (($row2["wallet"]) >= $totalAmount) {
?>
<div class="row">
    <div class="col-total">
        <label for="totalPrice" class="total">Account balance</label>
    </div>
    <div class="col-total">
        <div><span style="float: right;" id="totalPrice" class="totalPrice">Rs. <?php echo $row2["wallet"]; ?>.00</span></div> 
    </div>
</div>
<div class="row">
    <div class="col-total">
        <label for="amountDeposit" class="total">Order Total</label>
    </div>
    <div class="col-total">
        <div><span style="float: right;" id="totalPrice" class="totalPrice">Rs. <span><?php echo $totalAmount; ?></span>.00</span></div> 
    </div>
</div>

<button type="submit" class="cartbtn2" name="del_cate"><span>Confirm and pay </span></button>
<?php
  } else {
?>
<div style="width:13%; float: left;"><img src="images/alert.png" style="width:60px; margin-top:40px;"></div>
<div class="divsftext">The available account balance is inadequate..</div>
<?php
  }
?>