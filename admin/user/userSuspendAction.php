<?php
    require '../../config.php';
    require "mail.php";

    $limit = 2;
    $offset = 0;
    
    if (!empty($_SESSION["offset"])){
        $offset = $_SESSION["offset"];
    }

    $sql2 = "SELECT * FROM customer WHERE customer_id NOT IN (SELECT customer_id FROM suspended_customer) ORDER BY customer_id DESC";
    $rowsAmount = $conn->query($sql2);
        
    if (isset($_POST["suspendSubmit"])) {
        $customerId = $_POST["suspendSubmit"];
        $reason = $_POST["reasonSuspend"];
        $notice = $_POST["noticeSuspend"];

        $reason = str_replace("'", "\'",$reason);
        $notice = str_replace("'", "\'",$notice);
        
        date_default_timezone_set("Asia/Colombo");
        $date = date("Y-m-d");

        $query = "INSERT INTO suspended_customer VALUES ('','$reason','$notice','$date','$customerId')";
        mysqli_query($conn,$query);

        $sql = "SELECT * FROM customer WHERE customer_id=$customerId";
        $searchRows = $conn->query($sql);
        $searchRow = mysqli_fetch_assoc($searchRows);
        $email = $searchRow["email"];
        $name = $searchRow["fname"];

        $str1 = "Hello $name,";
        
        $text = 'Your FCT Canteen Account has been suspended<br><br><br>' . $str1 . '<br><br>' . $notice . '<br><br>We appreciate your understanding.<br><br>Thanks,<br><br>FCT Canteen<br>';

        send_mail($email,'User suspension',$text);

        if(($offset != 0) && ((mysqli_num_rows($rowsAmount))==($offset+1))) {
            $offset -=$limit;
            $_SESSION["offset"] = $offset;
        }
    
        header("Location: adUser.php");
    }
?>