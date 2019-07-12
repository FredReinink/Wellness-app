<!DOCTYPE html>


<html>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheets/stylesheet.css">
  
  
  
  <head>
  
    <title> Wellness </title> 
  
  </head> 
  
  

  <body> 
  <!-- add a logo --> 
  <div class = "logo"><a href = "homePageAfterUserLogIn.php"><img src = "images/logo2.png" style="width:10%"></a>
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



  <!--View all the challenges-->
    
    <div class="header">
    <h2><center> Monthly Challenges </center></h2><hr>
   </div>

   <div class="header">

    <?php

  
   $db = mysqli_connect('localhost', 'root', '', 'wellness');

   $user_check_query = "SELECT challenge_name, challenge_description, points_submission FROM listOfChallenges";
   $result = mysqli_query($db, $user_check_query);

   if (!$result)
   {
      echo "<div style=\"text-align:center\"></div>";
      echo "There are no monthly challenges this month. Come visit again.";
      return;
   }
   
   while ($row = $result -> fetch_assoc())
   {
      echo "<div style=\"text-align:center\"></div>";
      echo "<br><b>{$row['challenge_name']}</b>";
      echo "<br>{$row['challenge_description']}";
      echo "<br>Points Awarded: ";
      echo "{$row['points_submission']}";
      echo "<br>";
   }
   
   
   ?>

  </div>
















    <?php include('server.php') ?>
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
  
  <center> 
   <div class="header">
          <h2>Did you complete a challenge? </h2><hr>
   </div>

   
   <form method="post" action="challenge.php" style=>
       <?php include('errors.php'); ?>
  
    <div class="input-group">
         <label>Enter the name of the challenge you completed</label>
         <input type="text" name="challenge_name">
    </div>

    <div class="input-group">
         <label>Upload the supporting document</label>
         <input type="text" name="submission" required>
    </div>
   
   <!-- points get cleared for all user each month-->
   <div class="input-group">
         <button type="submit" class="btn" name="challenge_submission">Submit</button>
       </div>
   
   </center>
   </form> 


   <!-- add this information to the challenge table 
        grant points to the user. This is in server.php class --> 

    




  <!-- circle dots -->
  <br>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>



   <!--View points of leader users-->
   <div class="header">
    <h2><center> Leading Users (Top 5)</center><hr>
   </div>
  
    <?php

   $db = mysqli_connect('localhost', 'root', '', 'wellness');
   $username = $_SESSION['username'];

   $user_check_query = "SELECT username, SUM(points) AS total FROM userPoints GROUP BY username ORDER BY SUM(points) DESC LIMIT 5";

   $result = mysqli_query($db, $user_check_query); 

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "There are no monthly challenges this month. Come visit again.";
      return;
   }
 
    
   while ($row = $result -> fetch_assoc())
   {
      echo "<div style=\"text-align:center\">";
      echo "<br>{$row['username']}";
      echo "<br>{$row['total']}";
   }

    ?>



     <!--User's Total Points -->
   <div class="header">
    <h2><center> Your Total Points</center><hr>
   </div>
  
    <?php

   $db = mysqli_connect('localhost', 'root', '', 'wellness');
   $username = $_SESSION['username'];

   $user_check_query = "SELECT username, SUM(points) AS total FROM userPoints WHERE username = '$username'";

   $result = mysqli_query($db, $user_check_query); 

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "There are no monthly challenges this month. Come visit again.";
      return;
   }
 
    
   while ($row = $result -> fetch_assoc())
   {
      echo "<div style=\"text-align:center\">";
      echo "<br>{$row['username']}";
      echo "<br>{$row['total']}";
   }

    ?>

</body>
</html>

