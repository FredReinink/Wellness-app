<!DOCTYPE html>


<html>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">
  
  
  
  <head>
  
    <title> Wellness </title> 

    </head> 



    <body> 
    <!-- add a logo --> 
    <div class = "logo"><a href = "homePage.php"><img src = "logo.png" style="width:20%"></a>
    </div>


    <!-- Navigation -->
    <div class="topnav">
    <div class="topnav-right">
        <a href="homePage.php">Home</a>
        <a href="login.php">User Sign-In</a>
        <a href="adminLogIn.php">Admin Sign-In</a>
    </div>
    </div>

    </body>
  


     <!--Admin Login--> 
   <?php include('serverPageforAdmin.php') ?>
   <head>
     <title>Admin Login</title>
     <link rel="stylesheet" type="text/css" href="style.css">
   </head>
   <body>
     <div class="header">
     	<h2>Login</h2>
     </div>
   	 
     <form method="post" action="adminLogIn.php">
     	<?php include('errors.php'); ?>
     	<div class="input-group">
     		<label>Admin Username: </label>
     		<input type="text" name="adminUser" >
     	</div>
     	<div class="input-group">
     		<label>Admin Password: </label>
     		<input type="password" name="adminPass">
     	</div>
     	<div class="input-group">
     		<button type="submit" class="btn" name="login_user">Login</button>
     	</div>
      
      
   </form>
  
  
  <br>
  <br>
  <br>
  <p>
  <!-- circle dots -->
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  </p>
  
  








    </body>

</html>