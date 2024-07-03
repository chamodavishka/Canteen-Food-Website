<!-- php for sign up-->
<?php
  require '../config.php';

  if (isset($_POST["submitup"])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $reg_no = $_POST["student_no"];
    $others_no = $_POST["others_no"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];
    $profilePic = $_FILES["profilePic"]["name"];

    $target_dir = "profilePic/";
    $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);

    date_default_timezone_set("Asia/Colombo");
    $date = date("Y-m-d");

    $duplicate = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$email'");
    if(mysqli_num_rows($duplicate) > 0) {
      echo "<script> alert('Email has Already Taken'); </script>";
    }
    else {
      if($password == $repeat_password) {
        $newPassword=password_hash($password, PASSWORD_DEFAULT);
        if($reg_no == ""){
          $reg_no = $others_no;
        }
        $query = "INSERT INTO customer VALUES('','$first_name','$last_name','$email','$reg_no','$newPassword','$profilePic',0,'$date')";
        mysqli_query($conn,$query);

        move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file);
          
        echo "<script> alert('Registration is Successful'); </script>";
        
      }
      else {
        echo "<script> alert('Password does Not Match'); </script>";

      }
    }
  }

  if (isset($_POST["submitin"])) {
    $userEmail = $_POST["lEmail"];
    $userPassword = $_POST["lPassword"];
    $result = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$userEmail'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0) {
      $result2 = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$userEmail' AND customer_id = ANY (SELECT customer_id FROM suspended_customer)");
      $row2 = mysqli_fetch_assoc($result2);
      if(mysqli_num_rows($result2)>0) {echo "<script> alert('Suspended User'); </script>";} 
      elseif (password_verify($userPassword, $row["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["customer_id"];
        $_SESSION["email"] = $row["email"];
        header("Location: ../index/index.php");
      }
      else {
        echo "<script> alert('Wrong Password'); </script>";
        
      }
    }
    else {
      echo "<script> alert('User Not Registered'); </script>";
      
    }
  }
?>