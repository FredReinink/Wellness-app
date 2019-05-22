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
        <a href="login.php">Sign-In</a>
    </div>
    </div>

  </body>




    <?php include('server.php') ?>

    <head>
        <title>Registration system PHP and MySQL</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>


<body>

  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
    
    <div class="input-group">
  	  <label>firstName</label>
  	  <input type="text" name="firstName">
  	</div>

    <div class="input-group">
  	  <label>lastName</label>
  	  <input type="text" name="lastName">
  	</div>
      
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>

  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>

  	<div class="input-group">
  	  <label>Confirm Password</label>
  	  <input type="password" name="password_2">
  	</div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign In</a>
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