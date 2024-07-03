<?php 
require '../../config.php';
$error = array();

require "mail.php";

	$mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
			case 'enter_email':
				// code...
				$email = $_POST['email'];
				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Please enter a valid email";
				}elseif(!valid_email($conn, $email)){
					$error[] = "That email was not found";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($conn, $email);
					header("Location: forgot.php?mode=enter_code");
					die;
				}
				break;

			case 'enter_code':
				// code...
				$code = $_POST['code'];
				$result = is_code_correct($conn, $code);

				if($result == "the code is correct"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgot.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;

			case 'enter_password':
				// code...
				$password = $_POST['password'];
				$password2 = $_POST['password2'];

				if($password !== $password2){
					$error[] = "Passwords do not match";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forgot.php");
					die;
				}else{
					
					save_password($conn, $password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					echo "<script>
						let url = 'http://localhost/files/CanteenFCT/signup_form/signin.php';
						window.location= url;
					</script>";
					die;
				}
				break;
			
			default:
				// code...
				break;
		}
	}

	function send_email($conn, $email){

		$expire = time() + (60 * 5);
		$code = rand(100000,999999);
		$email = addslashes($email);

		$query = "INSERT INTO forgot_code (email,code,expire) VALUE ('$email','$code','$expire')";
		mysqli_query($conn,$query);

		//send email here
		send_mail($email,'Password reset',"Your code is " . $code);
	}
	
	function save_password($conn, $password){

		$password = password_hash($password, PASSWORD_DEFAULT);
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "UPDATE customer SET password = '$password' where email = '$email' limit 1";
		mysqli_query($conn,$query);

	}
	
	function valid_email($conn, $email){

		$email = addslashes($email);

		$query = "SELECT * FROM customer WHERE email = '$email' LIMIT 1";		
		$result = mysqli_query($conn,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				return true;
 			}
		}

		return false;

	}

	function is_code_correct($conn, $code){

		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "SELECT * FROM forgot_code WHERE code = '$code' && email = '$email' ORDER BY id DESC LIMIT 1";
		$result = mysqli_query($conn,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if($row['expire'] > $expire){

					return "the code is correct";
				}else{
					return "the code is expired";
				}
			}else{
				return "the code is incorrect";
			}
		}

		return "the code is incorrect";
	}

	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---- title ------>
    <title>FCT eCanteen</title>

    <!---- customer css file ------>
    <link rel="stylesheet" href="../../signup_form/signup.css">
    <link rel="style icon" href="../images/favicon.png">

    <!-------- font awesome cdn link --------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <!------------ Iconscout CSS -------------->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
 
    <!--------- boxicons cdn link ---------->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<style>
		/* Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
	</style>
</head>
<body>

		<?php 

			switch ($mode) {
				case 'enter_email':

					?>
					<div class="login-container signForm">
					  <a style="text-decoration: none;" class="logo" href="../../signInUp.php">FCT <span>Canteen</span></a>
					  <div class="container">    
						<div class="forms">
		 				  <div style="height:auto;" class="form login">
							<span class="title">Forgot Password</span>

							<form method="post" action="forgot.php?mode=enter_email"> 
								
								<?php
								if($error){ ?>	
								<div style="margin-left:10px; margin-right:-5px;" class="alert alert-warning alert-dismissible fade in">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php 
										foreach ($error as $err) {
											// code...
											echo $err;
										}
									?>
								</div>
								<?php
								}
								?>

								<div class="input-field">
                            		<input type="email" name="email" class="password" placeholder="Enter your email" required>
                            		<i class="uil uil-envelope icon"></i>
                        		</div>

								<div class="checkbox-text">
                            		<a href="http://localhost/files/CanteenFCT/signup_form/signin.php" class="text">Remembered password?</a>
                        		</div>

								<div class="input-field button" style="margin-top: 3rem;">
                            		<button type="submit" name="submitin" class="input">Next</button>
                        		</div><br>

							</form>

						  </div>
						</div>
        			  </div>
    				</div>

					<?php				
					break;

				case 'enter_code':
					// code...
					?>
					<div class="login-container signForm">
					  <a style="text-decoration: none;" class="logo" href="../../signInUp.php">FCT <span>Canteen</span></a>
					  <div class="container">    
						<div class="forms">
		 				  <div style="height:auto;" class="form login">
							<span class="title">Forgot Password</span>

							<form method="post" action="forgot.php?mode=enter_code"> 

								<?php
								if($error){ ?>	
								<div style="margin-left:10px; margin-right:-5px;" class="alert alert-warning alert-dismissible fade in">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php 
										foreach ($error as $err) {
											// code...
											echo $err;
										}
									?>
								</div>
								<?php
								}
								?>

								<div class="input-field">
                            		<input type="number" name="code" class="password" placeholder="Enter the emailed code" required>
                            		<i class="uil uil-lock-open-alt"></i>
                        		</div>

								<div class="checkbox-text">
                            		<a href="http://localhost/files/CanteenFCT/signup_form/signin.php" class="text">Remembered password?</a>
                        		</div>

								<div class="input-field button" style="margin-top: 3rem;">
                            		<button type="submit" name="submitin" class="input">Next</button>
                        		</div>

								<div class="login-signup" style="margin-top: 3rem;">
									<span class="text">Seeking a clean slate?
										<a href="forgot.php" class="text signup-link">Start Over</a>
									</span>
								</div><br>

							</form>
						  </div>
						</div>
        			  </div>
    				</div>
					<?php
					break;

				case 'enter_password':
					// code...
					?>
					<div class="login-container signForm">
					  <a style="text-decoration: none;" class="logo" href="../../signInUp.php">FCT <span>Canteen</span></a>
					  <div class="container">    
						<div class="forms">
		 				  <div style="height:auto;" class="form login">
							<span class="title">Forgot Password</span>

							<form method="post" action="forgot.php?mode=enter_password"> 

								<?php
								if($error){ ?>	
								<div style="margin-left:10px; margin-right:-5px;" class="alert alert-warning alert-dismissible fade in">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php 
										foreach ($error as $err) {
											// code...
											echo $err;
										}
									?>
								</div>
								<?php
								}
								?>

								<div class="input-field">
                            		<input type="password" name="password" class="password" placeholder="New Password" required
										pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                		title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            		<i class="uil uil-lock icon"></i>
                        		</div>
								<div class="input-field">
                            		<input type="password" name="password2" class="password" placeholder="Retype New Password" required>
                            		<i class="uil uil-lock icon"></i>
                        		</div>

								<div class="checkbox-text">
                            		<a href="http://localhost/files/CanteenFCT/signup_form/signin.php" class="text">Remembered password?</a>
                        		</div>

								<div class="input-field button" style="margin-top: 3rem;">
                            		<button type="submit" name="submitin" class="input">Confirm</button>
                        		</div>

								<div class="login-signup" style="margin-top: 3rem;">
									<span class="text">Seeking a clean slate?
										<a href="forgot.php" class="text signup-link">Start Over</a>
									</span>
								</div><br>

							</form>
						  </div>
						</div>
        			  </div>
    				</div>
					<?php
					break;
				
				default:
					// code...
					break;
			}

		?>


</body>
</html>