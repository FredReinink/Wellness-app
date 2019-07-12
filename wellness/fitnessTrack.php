<!DOCTYPE html>


<html>

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


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheets/stylesheet.css">
  
  
  <head>
  
    <title> Wellness </title> 
  
  </head> 
  
  

  <body> 
  <!-- add a logo --> 
  <div class = "logo"><a href = "homePageAfterUserLogIn.php"><img src = "logo2.png" style="width:10%"></a>
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
			 <input type="number" name="cardio_minutes" maxlength = "3" style="width: 80px;">
		</div>
		<div class="input-group">
			 <label>What was your heartrate during your cardio? (bpm)</label>
			 <input type="number" name="cardio_heartrate" maxlength = "3" style="width: 80px;">
		</div>
		
		<?php
			include 'exerciseGenerator.php';
		?>
		
		<div class="input-group">
			<button type="submit" class="btn" style="width: 80px" name="submit_fitness_info">Submit</button>
		</div>
  </form>
  

  
</body>

      <!-- circle dots -->
  <br>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
</html>