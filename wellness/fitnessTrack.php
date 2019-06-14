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
  
   <?php 
		include('server.php');
		include('errors.php');   
	?>
  
  <form method="post">
	<center>
	<button type="submit" style="width: 240px" formaction="addExercise.php">Add Strength Training Exercise</button>
  </form>
  

  <form method="post" action="fitnessTrack.php">
		<center>
		<br> 
		<div class="input-group">
			 <label>Enter the date you want to track</label>
			 <input type="date" name="date" required>
		</div>
		<br>
		<b>Enter cardio information</b>
		<div class="input-group">
			 <label>How many minutes of cardio did you do?</label>
			 <input type="text" name="cardio_minutes" maxlength = "3" style="width: 80px;">
		</div>
		<div class="input-group">
			 <label>What was your heartrate during your cardio?</label>
			 <input type="text" name="cardio_heartrate" maxlength = "3" style="width: 80px;">
		</div>
		
		<?php
			include 'exerciseGenerator.php';
		?>
		
		<div class="input-group">
			<button type="submit" class="btn" style="width: 80px" name="submit_fitness_info">Submit</button>
		</div>
  </form>
  
</body>
</html>