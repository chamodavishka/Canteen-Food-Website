<?php
  require '../config.php';
  if(!empty($_SESSION["id"])){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---- title ------>
    <title>Sign up | FCT eCanteen</title>

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
 
    <script>
    function abc(x) {
        if(x==0){
            document.getElementById("L1").type = "text";
            document.getElementById("L2").type = "hidden";
        }else{
            document.getElementById("L1").type = "hidden";
            document.getElementById("L2").type = "text";
        }
    }
</script>
</head>
<body>
    

    <!-------- login form start ----------->
    <div class="login-container signupForm" style="background: linear-gradient(120deg, #ffff, #ccc);">
        <a class="logo" href="../signInUp.php">FCT <span>Canteen</span></a>
        <div class="container">
            <div class="forms">
                <!-- Registration Form -->
                <div class="form signup container-signup" style="height:auto;">
                    <span class="title title2">Sign Up</span>

                    <form action="signinupAction.php" method="post" enctype="multipart/form-data">
                        <div class="field">
                            <div class="input-field">
                                <input type="text" name="first_name" placeholder="firstname" required>
                                <i class="uil uil-user"></i>
                            </div>
                               
                            <div class="input-field">
                                <input type="text" name="last_name" placeholder="lastname" required>
                                <i class="uil uil-user"></i>
                            </div>
                        </div> 
                        <div class="input-field">
                            <input type="email" name="email" placeholder="email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" class="password" placeholder="password" required id="P1" onchange="checkPasswordAgain(this.value)" 
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            <i class="uil uil-lock icon"></i>
                        </div>     
                        <div class="input-field">
                            <input type="password" name="repeat_password" class="password" placeholder="repeat password" required id="P2" onchange="checkPassword(this.value)" 
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                            <i class="uil uil-lock icon"></i>
                            <i class="showCheckPw"><span style="color:red; font-size:10px;" id="demo"></i>
                            <i class="uil uil-eye-slash showHidePw"></span></i>
                            
                        </div>
                        <div style="display:flex;">   
                            <div class="input-field" style="border-bottom: 2px solid #ccc;">   
                                <input type="file" name="profilePic" accept="image/*" id="profilePic" 
                                    style="display: none; visibility: none;" onchange="imageName(this.value)" required>            
                                <label style="visibility: visible;" for="profilePic" class="radiohv">
                                    <i class="uil uil-image-plus"><span style="font-size:12px; font-style: normal; padding-left: 11px; color:#777;" id="img1">
                                    <span style="font-size:16px; font-style: normal; color:#777;">Image</span></span></i>
                                </label>

                            </div>
                            
                        </div>
                        <div class="radioCheck">
                            <div class="input-content">
                                <input type="radio" name="radio" id="one" class="radio" onclick="abc(0)" checked><span>Student</span>
                                <input type="radio" name="radio" id="two" class="radio" onclick="abc(1)"><span>Others</span>
                            </div>
                            <div class="input-content">
                                <input class="textBox" id="L1" type="text" placeholder="CT/20XX/XXX" pattern="[A-Z]{2}/[0-9]{4}/[0-9]{3}" name="student_no" required>
                                <input class="textBox" id="L2" type="hidden" placeholder="NIC" name="others_no" required>   
                            </div>
                        </div>  
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="termCon" required>
                                <label for="termCon" class="text">terms and conditions</label>
                            </div>
                        </div>
                        <div class="input-field button" style="margin-top:15px;">
                            <button type="submit" name="submitup" class="input">Sign Up</button>
                        </div>                                
                    </form>
                    <div class="login-signup" style="margin-bottom:25px; margin-top:20px;">
                        <span class="text">Already a member?
                            <a href="./signin.php" class="text login-link">Login Now</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----- customer css file ------->
     <script src="./signup.js"></script>
     <script>
        function imageName(value){
            if(value){
                let newName=value.replace(/^.*\\/,"");
                document.getElementById("img1").innerHTML = newName;
            }
        }

        function checkPassword(value){
    	    let x = document.getElementById('P1').value;
            if(x != value){
        	    document.getElementById('demo').innerHTML = "*Not Match";
            }else{
                document.getElementById('demo').innerHTML = "";
            }
        }

        function checkPasswordAgain(value){
    	    let y = document.getElementById('P2').value;
            if(y != ""){
        	    if(y != value){
        	        document.getElementById('demo').innerHTML = "*Not Match";
                }else{
                    document.getElementById('demo').innerHTML = "";
                }
            }else{
                document.getElementById('demo').innerHTML = "";
            }
        }
     </script>

</body>
</html>