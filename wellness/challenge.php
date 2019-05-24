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
 






  <!--View all the challenges-->

  <br>
    <b><h2><center> Monthly Challenges </center></h2></b>
    <br>

    <?php

   $db = mysqli_connect('localhost', 'root', '', 'wellness');

   $user_check_query = "SELECT challenge_name, challenge_description, points_submission FROM listOfChallenges";
   $result = mysqli_query($db, $user_check_query);

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "There are no monthly challenges this month. Come visit again.";
      return;
   }
 
   {
      echo "<div style=\"text-align:center\">";
      echo "Monthly challenges are listed below. ";
   }
  
   echo "<br>";
   while ($row = $result -> fetch_assoc())
   {
      echo "<div style=\"text-align:center\">";
      echo "<br><b>{$row['challenge_name']}</b>";
      echo "<br>{$row['challenge_description']}";
      echo "<br>{$row['points_submission']}";
      echo "<br>";
   }
   
   
   ?>

  <!-- circle dots -->
  <br>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>

    <?php include('server.php') ?>
  
  <center> 
   <div class="header2">
          <h2>Did you complete a challenge? </h2>
   </div>
   
   <form method="post" action="challenge.php">
       <?php include('errors.php'); ?>
   <br>
   
    <br> 
    <div class="input-group">
         <label>Enter the name of the challenge you completed</label>
         <input type="text" name="challenge_name">
    </div>

    <div class="input-group">
         <label>Upload the supporting document</label>
         <input type="text" name="submission">
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
    <br>
    <b><h2><center> Leading Users </center></h2></b>
  
    <?php

   $db = mysqli_connect('localhost', 'root', '', 'wellness');

   $user_check_query = "SELECT username, SUM(points) FROM userPoints GROUP BY username LIMIT 5";
   $result = mysqli_query($db, $user_check_query); 

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "There are no monthly challenges this month. Come visit again.";
      return;
   }
 
   {
      echo "<div style=\"text-align:center\">";
      echo "<b>Top 5 users:</b> ";
   }
  
   while ($row = $result -> fetch_assoc())
   {
      echo "<div style=\"text-align:center\">";
      echo "<br>{$row['username']}";
   }

    ?>

</body>
</html>

