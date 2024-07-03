<?php
    require '../../config.php';
    $q = $_REQUEST["q"];

    if ($q) {

        $sql = "SELECT * FROM customer WHERE customer_id NOT IN (SELECT customer_id FROM suspended_customer) && reg_no LIKE '$q%' OR CONCAT (fname,' ',lname) LIKE '%$q%' LIMIT 20";
        $searchRows = $conn->query($sql);

        if(mysqli_num_rows($searchRows)>0) {
        ?>
        <table class="cateItem">
                <tr id = "Visible">
                    <th style="border-top: none;" colspan="6">SEARCH - USER DETAILS</th>
                </tr>
                <tr style="background-color:#ddd;">
                    <td><span class="spanRecode2">Image</span></td>
                    <td><span class="spanRecode2">Name & Email</span></td>
                    <td><span class="spanRecode2">User Id</span></td>
                    <td><span class="spanRecode2">Wallet</span></td>
                    <td><span class="spanRecode2">RegDate</span></td>
                    <td style="text-align:right;"><span class="spanRecode2" style="padding-right:30px;">Action</span></td>
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
                <td><span class="spanRecode">Rs. <?php echo $searchRow["wallet"]; ?></span></td>
                <td><span class="spanRecode"><?php echo $searchRow["reg_date"]; ?></span></td>

                <td><button type="button" class="deleteCateButton" name="suspendSubmit" value="<?=$searchRow["customer_id"]; ?>" onclick="getUserId(this.value)">Suspend</button></td>
            </tr>
        <?php
            }
        ?>
        </table>

<?php     
    } else {

        $limit = 2;
        $offset = 0;
        if (!empty($_SESSION["offset"])){
            $offset = $_SESSION["offset"];
        }

        $sql = "SELECT * FROM customer WHERE customer_id NOT IN (SELECT customer_id FROM suspended_customer) ORDER BY customer_id DESC LIMIT $offset,$limit";
        $searchRows = $conn->query($sql);

        $sql2 = "SELECT * FROM customer ORDER BY customer_id DESC";
        $rowsAmount = $conn->query($sql2);

        if(mysqli_num_rows($searchRows)>0) {
        ?>
        <table class="cateItem">
                <tr id = "Visible">
                    <th style="border-top: none;" colspan="6">USER DETAILS</th>
                </tr>
                <tr style="background-color:#ddd;">
                    <td><span class="spanRecode2">Image</span></td>
                    <td><span class="spanRecode2">Name & Email</span></td>
                    <td><span class="spanRecode2">User Id</span></td>
                    <td><span class="spanRecode2">Wallet</span></td>
                    <td><span class="spanRecode2">RegDate</span></td>
                    <td style="text-align:right;"><span class="spanRecode2" style="padding-right:30px;">Action</span></td>
                </tr>
        <?php
            }
            while($searchRow = mysqli_fetch_assoc($searchRows)){
        ?>
            <tr>
                <td><image style="border-radius: 50px;" class="zoomUser" src="../../signup_form/profilePic/<?php echo $searchRow["profile_pic"]; ?>" width="50px" height="50px"></td>
                <td><span class="spanRecode"><?php echo $searchRow["fname"]; ?><?php echo " "; ?><?php echo $searchRow["lname"]; ?>
                <br><?php echo $searchRow["email"]; ?></span></td>
                <td><span class="spanRecode"><?php echo $searchRow["reg_no"]; ?></span></td>
                <td><span class="spanRecode">Rs. <?php echo $searchRow["wallet"]; ?></span></td>
                <td><span class="spanRecode"><?php echo $searchRow["reg_date"]; ?></span></td>

                <td><button type="button" class="deleteCateButton" name="suspendSubmit" value="<?=$searchRow["customer_id"]; ?>" onclick="getUserId(this.value)">Suspend</button></td>
            </tr>
        <?php
            }
        ?>
        </table>

        <table class="pageSwap">
            <?php
                if(((mysqli_num_rows($rowsAmount))>($offset+$limit)) && ($offset == 0)) {
            ?>

                <tr>
                    <th class="next" style="border-top: none;"><button style="float:none;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="nextSubmit">Next</button></th>
                </tr>

            <?php
                }
            ?>
            <?php
                if(($offset != 0) && ((mysqli_num_rows($rowsAmount))>($offset+$limit)) && ($offset < ($limit*2))) {
            ?>

                <tr>
                    <th class="next" style="border-top: none;"><button style="float:right;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="backSubmit">Back</button></th>
                    <th class="next" style="border-top: none;"><button style="float:left;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="nextSubmit">Next</button></th>
                </tr>

            <?php
                }
            ?>

            <?php
                if(($offset != 0) && ((mysqli_num_rows($rowsAmount))>($offset+$limit)) && ($offset>$limit)) {
            ?>

                <tr>
                    <th class="next" style="border-top: none;"><button style="float:none;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="backSubmit">Back</button></th>
                    <th class="next" style="border-top: none;"><button style="float:none;" type="submit" class="hideCateButton" name="homeSubmit">Home</button></th>
                    <th class="next" style="border-top: none;"><button style="float:none;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="nextSubmit">Next</button></th>
                </tr>

            <?php
                }
            ?>

            <?php
                if(($offset != 0) && ((mysqli_num_rows($rowsAmount))<=($offset+$limit))) {
            ?>

                <tr>
                    <th class="next" style="border-top: none;"><button style="float:right;" type="submit" value="<?=$offset; ?>" class="hideCateButton" name="backSubmit">Back</button></th>
                    <th class="next" style="border-top: none;"><button style="float:left;" type="submit" class="hideCateButton" name="homeSubmit">Home</button></th>
                </tr>

            <?php
                }
            ?>
        </table>

<?php 
    }
?>