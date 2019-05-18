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
  


    <?php include('server.php') ?>

    <head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <!--Form for users to login -->
    <body>
    <div class="header">
        <h2>Login</h2>
    </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>

    <!--if user hasn't registered yet-->
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>


      
  <br>
  <br>
  <p>
  <!-- circle dots -->
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  </p>
  <br>
  

    </body>

</html>