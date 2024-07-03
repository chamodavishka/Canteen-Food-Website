<?php
  require 'config.php';
  $cateResult = "SELECT * FROM category WHERE cate_status='Visible'";
  $cateRows = $conn->query($cateResult);
?>
<div class="ourCat">
    <?php
        while($cateRow = mysqli_fetch_assoc($cateRows)){
    ?>   
            <div class="col-1" onclick="window.location='cateFood.php';">
                <div class="images">
                    <img src="admin/category/categoryPic/<?php echo $cateRow["cate_pic"]; ?>" alt="">
                </div>
                <div class="cat-content">
                    <h3><?php echo $cateRow["cate_name"]; ?></h3>                 
                </div>
            </div>
    <?php
        }
    ?>                
</div>
