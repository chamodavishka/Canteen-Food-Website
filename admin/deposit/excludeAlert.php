<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" type="text/css" href="action.css">
      <script>
        function myFunction() {
          window.location='adDeposit.php';
        }
      </script>
  </head>
  <body>
  <div id="id01" style="display:none;" class="modal">
    
    <form class="modal-content animate" action="" method="post" enctype="multipart/form-data">
      <!--model text-->
      <div class="container">
        <span onclick="myFunction()" class="close" title="Close Modal">&times;</span>
        <br><br><img src="images/alert.png" style="width:70px; margin-left:200px;"><br><br>
        <h1 class="textcenter"><span id="demo1"></span></h1>
        <p class="textcenter"><span id="demo2"></span></p>
        <hr>
        
        <div class="clearfix">
          <button type="button" onclick="myFunction()" class="signupbtn" name="submitup"><span id="demo3"></span></button>
        </div>
      </div>
    </form>
  </div>
<!--link js file-->
  <script src="action.js"></script>
  
  </body>
</html>

<?php
  echo "<script> 
    document.getElementById('id01').style.display = 'block';
    document.getElementById('demo1').innerHTML = 'ERROR!';
    document.getElementById('demo2').innerHTML = 'Wallet Balance not Sufficient.';
    document.getElementById('demo3').innerHTML = 'Try Again';

  </script>";
?>

