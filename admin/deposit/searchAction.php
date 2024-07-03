<?php
require '../../config.php';

$q = $_REQUEST["q"];

$sql = "SELECT * FROM customer WHERE reg_no LIKE '$q%' OR CONCAT (fname,' ',lname) LIKE '%$q%' LIMIT 20";
$searchRows = $conn->query($sql);

?>
    
        

<?php
    if(mysqli_num_rows($searchRows)>0) {
?>
<table class="cateItem">
    <tr id = "Visible">
        <th style="border-top: none;" colspan="4">USER DETAILS</th>
    </tr>
    <tr style="background-color:#ddd;">
        <td><span class="spanRecode2">Image</span></td>
        <td><span class="spanRecode2">Name & Email</span></td>
        <td><span class="spanRecode2" style="padding-left:13px;">User Id</span></td>
        <td style="text-align:right;"><span class="spanRecode2" style="padding-right:93px;">Action</span></td>
    </tr>
  <?php
     } else {
        ?>
        <br><h3 class="header3">No results to show with <span style="font-weight: bold;"><?php echo "$q"; ?></span></h3><br>
  <?php
    }
      while($searchRow = mysqli_fetch_assoc($searchRows)){
  ?>
    <tr>
        <td><image style="border-radius: 50px;" class="zoomUser" src="../../signup_form/profilePic/<?php echo $searchRow["profile_pic"]; ?>" width="50px" height="50px"></td>
        <td><span class="spanRecode"><?php echo $searchRow["fname"]; ?><?php echo " "; ?><?php echo $searchRow["lname"]; ?>
        <br><?php echo $searchRow["email"]; ?></span></td>
        <td><span class="spanRecode"><?php echo $searchRow["reg_no"]; ?></span></td>

        <td>
            <button type="submit" class="buttonCancel" name="excludeSubmit" value="<?=$searchRow["customer_id"]; ?>">Exclude</button>
            <button type="submit" class="buttonUpdate" name="includeSubmit" value="<?=$searchRow["customer_id"]; ?>">Include</button>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
    