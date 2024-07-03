<?php
require 'config.php';
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $requests = $value["requests"];

        if ($requests == "") {
            $requests = "No Requests";
        }
?>
        <div class="container">

            <form action="" method="post" autocomplete="off">
                
                <div class="row" style="margin-left:2%;">
                    <div class="col-75">
                        <span class="foodName"><?php echo $value["fname"]; ?></span>
                    </div>
                </div>

                <div class="row" style="margin-left:2%;">
                    <div class="col-25">
                        <image src="admin/food/foodPic/<?php echo $value["fpic"]; ?>" width="150px" height="150px">
                    </div>
                    <div class="col-26">
                        <div style="margin-top: 0px;" class="col-25">
                            <label for="quantity">Qty </label>
                        </div>
                        <div style="margin-left: -7px;" class="col-27-1" onclick="subtract(<?=$value['foodId']; ?>)">-</div> 
                        <div class="col-27">
                            <?php echo $value["quantity"]; ?>
                        </div>
                        <div class="col-27-1" onclick="add(<?=$value['foodId']; ?>)">+</div> 
                    </div>
                    <div class="col-right">
                        <span style="float: right;" class="price">Rs. <span><?php echo ($value["fprice"] * $value["quantity"]); ?></span>.00</span>
                    </div>

                    <div class="row">
                        <div class="col-28">
                            <div class="col-30">
                                <label for="req">Req </label>
                            </div>
                            <div class="col-29">
                                <div style="border:2px solid #ddd;border-radius: 4px; padding:5px; height: 76px;   overflow: hidden;" id="req"><?php echo $requests; ?></div>
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-left:2%;">
                    <div class="col-32">
                    <button type="button" class="cartbtn1" name="removeCartItem" value="<?php echo $value["foodId"]; ?>" onclick="remove(this.value)">Remove</button>
                    </div>
                </div>


                <br>
            </form><br>
        </div>
<?php
    }
}
?>