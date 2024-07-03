<?php
  require '../config.php';
  $cateResult = "SELECT * FROM category";
  $cateRows = $conn->query($cateResult);

  $showcaseResult = "SELECT * FROM showcase";
  $showcases = $conn->query($showcaseResult);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="refill.css">
</head>
<body>

<button onclick="document.getElementById('id01').style.display='block'"class="refillbtn" style="width:auto;">Refill - Food Quantity</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      
    <h2 style="text-align: center; margin: 24px 0 12px 0; position: relative; color:#555;">Refill - Food Quantity</h2>
    <hr>

  <div class="row">
    <div class="col-25">
      <label for="foodCategory">Category</label>
    </div>
    <div class="col-75">
      <select id="foodCategory" name="foodCategory">
      <?php
        while($cateRowR = mysqli_fetch_assoc($cateRows)){
      ?>
        <option value="<?php echo $cateRowR["cate_id"]; ?>"><?php echo $cateRowR["cate_name"]; ?></option>
      <?php
        }
      ?> 
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="foodShowcase">Showcase</label>
    </div>
    <div class="col-75">
      <select id="foodShowcase" name="foodShowcase">
        <option value="NULL">No Showcase</option>
        <?php
          while($showcaseR = mysqli_fetch_assoc($showcases)){
        ?>
          <option value="<?php echo $showcaseR["showcase_id"]; ?>"><?php echo $showcaseR["showcase_name"]; ?></option>
        <?php
          }
        ?> 
      </select>
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Submit" name="submit_food">
    <button type="button" class="cnbutton" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
  </div>

    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>