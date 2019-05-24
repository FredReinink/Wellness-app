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
  <div class = "logo"><a href = "homePageAfterUserLogIn.php"><img src = "logo.png" style="width:20%"></a>
  </div>

  
  <!-- Navigation -->
  <div class="topnav">
    <div class="topnav-right">
      <a href="homePageAfterUserLogIn.php">Home</a>
      <a href="afterUserLogIn.php">Dashboard</a>
      <a href="wellnessTest.php">Wellness Test</a>
      <a href="challenge.php">Monthly Challenge</a>
      <a href="newsfeed.php">Newsfeed</a>
      <a href="fitnessTrack.php">Fitness Tracking</a>
      <a href="dietTrack.php">Diet Tracking</a>
      <a href="login.php">Sign-Out</a>
    </div>
  </div>
  
    <!-- circle dots -->
  <br>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  
  
  <?php include('server.php') ?>
  <form method="post" action="fitnessTrack.php">

  	<?php include('errors.php'); ?>
		<center>
		<br> 
		<div class="input-group">
			 <label>Enter the date you want to track</label>
			 <input type="date" name="date">
		</div>
		<br> 
		<div class="input-group">
			 <label>How many hours did you exercise that day?</label>
			 <input type="text" name="exercise" max = 24>
		</div>
		<br> 
		<div class="input-group">
			 <label>How many hours did you sleep that day?</label>
			 <input type="text" name="sleep" max = 24>
		</div>
		<br>
		<div class="input-group">
			<button type="submit" class="btn" name="submit_fitness_info">Submit</button>
		</div>
  </form>
  
</body>
</html>