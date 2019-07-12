<!DOCTYPE html>


<html>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../stylesheets/stylesheet.css">
  <link rel="stylesheet2" href="../stylesheets/loginstylesheet.css">
  
  
  
  
  <head>
  
    <title> Wellness </title> 

    </head> 



    <body> 
    <!-- add a logo --> 
    <div class = "logo"><a href = "homePage.php"><img src = "../images/logo2.png" style="width:10%"></a>
    </div>


    <!-- Navigation -->
    <div class="topnav">
    <div class="topnav-right">
        <a href="../homePage.php">Home</a>
        <a href="../login.php">User Sign-In</a>
        <a href="adminLogIn.php">Admin Sign-In</a>
    </div>
    </div>

    </body>
  
  
    
    <style>

html {
    height:100%;
  }
  
  body {
    margin:0;
  }
  
  .bg {
    animation:slide 3s ease-in-out infinite alternate;
    background-image: linear-gradient(-60deg, #6c3 50%, #09f 50%);
    bottom:0;
    left:-50%;
    opacity:.5;
    position:fixed;
    right:-50%;
    top:0;
    z-index:-1;
  }
  
  .bg2 {
    animation-direction:alternate-reverse;
    animation-duration:4s;
  }
  
  .bg3 {
    animation-duration:5s;
  }
  
  .content {
    background-color:rgba(255,255,255,.8);
    border-radius:.25em;
    box-shadow:0 0 .25em rgba(0,0,0,.25);
    box-sizing:border-box;
    left:50%;
    padding:10vmin;
    position:fixed;
    text-align:center;
    top:50%;
    transform:translate(-50%, -50%);
  }
  
  h1 {
    font-family:monospace;
  }
  
  @keyframes slide {
    0% {
      transform:translateX(-25%);
    }
    100% {
      transform:translateX(25%);
    }
  }


    </style> 

<div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    



 







     <!--Admin Login--> 
   <?php include('serverPageforAdmin.php') ?>
   <head>
     <title>Admin Login</title>
     <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
   </head>
   <body>
     <div class="header">
     	<h2>Login</h2>
     </div>
   	 
     <form method="post" action="adminLogIn.php">
     	<?php include('../errors.php'); ?>
     	<div class="input-group">
     		<label>Admin Username: </label>
     		<input type="text" name="adminUser" placeholder="Username">
     	</div>
     	<div class="input-group">
     		<label>Admin Password: </label>
     		<input type="password" name="adminPass" placeholder="Password">
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