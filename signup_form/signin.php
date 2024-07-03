<?php
require '../config.php';

if(!empty($_SESSION["id"])){
    header("Location: index.php");
}

$email="";
if(!empty($_SESSION["email"])){
    $email=$_SESSION["email"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---- title ------>
    <title>Sign in | FCT eCanteen</title>

    <!---- customer css file ------>
    <link rel="stylesheet" href="./signup.css">
    <link rel="style icon" href="../images/favicon.png">

    <!-------- font awesome cdn link --------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <!------------ Iconscout CSS -------------->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
 
    <!--------- boxicons cdn link ---------->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
 

</head>
<body>
    

    <!-------- login form start ----------->
    <div class="login-container signForm">
        <a class="logo" href="../signInUp.php">FCT <span>Canteen</span></a>
        <div class="container">    
            <div class="forms">
                <div class="form login">
                    <span class="title">Sign In</span>

                    <form action="signinupAction.php" method="post">
                        <div class="input-field">
                            <input type="email" name="lEmail" class="password" value="<?php echo $email; ?>" placeholder="Enter your email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="lPassword" class="password" placeholder="Enter your password" required>
                            <i class="uil uil-lock icon"></i>
                        </div>

                        <div class="checkbox-text">
                            <!--<div class="checkbox-content">
                            </div>-->
                            
                            <a href="http://localhost/files/CanteenFCT/admin/forgot/forgot.php" class="text">Forgotten password?</a>
                        </div>

                        <div class="input-field button" style="margin-top: 3rem;">
                            <button type="submit" name="submitin" class="input">Sign In</button>
                        </div>
                    </form>

                    <div class="login-signup" style="margin-top: 3rem;">
                        <span class="text">Not a member?
                            <a href="./signup.php" class="text signup-link">Signup Now</a>
                        </span>
                    </div>
                </div>
                  
            </div>
        </div>
    </div>

    <!----- customer css file ------->
    <script src="./signin.js"></script>

</body>
</html>