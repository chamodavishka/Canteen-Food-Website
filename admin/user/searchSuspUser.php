<?php
    require '../../config.php';
    $q = $_REQUEST["q"];

    if ($q) {

        $sql = "SELECT * FROM suspended_customer INNER JOIN customer ON suspended_customer.customer_id = customer.customer_id WHERE reg_no LIKE '$q%' OR CONCAT (fname,' ',lname) LIKE '%$q%' LIMIT 20";
        $searchRows = $conn->query($sql);

        if(mysqli_num_rows($searchRows)>0) {
            while($searchRow = mysqli_fetch_assoc($searchRows)){
        ?>
        <table class="suspUser">
                <tr>
                    <th style="border-top: none; background-color:#ddd; color:#777;" colspan="6">
                        <?php echo $searchRow["reg_no"]; ?><?php echo " - "; ?>
                        <?php echo $searchRow["fname"]; ?><?php echo " "; ?><?php echo $searchRow["lname"]; ?><?php echo " - "; ?>
                        <?php echo $searchRow["email"]; ?>
                    </th>
                </tr>

                <tr>
                    <td style="width: 23%;">Wallet: <span class="spanRecode">Rs. <?php echo $searchRow["wallet"]; ?></span></td>
                    <td>RegDate: <span class="spanRecode"><?php echo $searchRow["reg_date"]; ?></span></td>
                    <td>SuspDate: <span class="spanRecode"><?php echo $searchRow["sus_date"]; ?></span></td>
                </tr>
                <tr>
                    <td rowspan="2"><image style="border-radius: 50px;" style="border-radius: 50px;" class="zoomUserSusp2" src="../../signup_form/profilePic/<?php echo $searchRow["profile_pic"]; ?>" width="70px" height="70px"></td>
                    <td colspan="2">Reason to Suspend: <span class="spanRecode"><?php echo $searchRow["reason"]; ?></span></td>
                </tr>
                <tr>
                    <form action="restoreSusp.php" method="post">
                        <td style="padding: 0px 35px 10px 40px;" colspan="2"><button type="submit" style="margin-right:0px;" class="buttonUpdate" name="restoreSubmit" value="<?=$searchRow["suspend_id"]; ?>">Restore</button>
                        <button type="button" class="buttonCancel" name="deleteSubmit" value="<?=$searchRow["suspend_id"]; ?>">Delete</button>
                        </td>
                    </form>
                </tr>
            <?php
                }
            ?>
            </table>
        <?php
            } else { 
        ?>
                <br><h3 class="header3">No results to show with <span style="font-weight: bold;"><?php echo "$q"; ?></span></h3>
        <?php
            }
        ?><br><br>
    <?php
        }
    ?>

