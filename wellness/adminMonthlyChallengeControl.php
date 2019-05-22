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
    <div class = "logo"><img src = "logo.png" style="width:20%"></a>
    </div>


    <!-- Navigation -->
    <div class="topnav">
    <div class="topnav-right">
        <a href="adminLogIn.php">Admin Sign-Out</a>
        <a href="adminArticleControl.php">Article Control</a>
        <a href="adminMonthlyChallengeControl.php">Monthly Challenge Control</a>
    </div>
    </div>

    </body>
  

    <?php include('server.php') ?>

    <!--Adding Content--> 
    <!-- button to add content -->
   <center>
   <div class="header">
       <h2>Add Monthly Challenges</h2>
   </div>
     
    <!--need to add URL here --> 
   <form method="post" action="adminMonthlyChallengeControl.php">
        <?php include('errors.php'); ?>
    
       
    <br>
    <br> <!--enter info about challenge -->
   
    <br><div class="input-group">
         <label>Enter Challenge Name: </label>
         <input type="text" name="challenge_name">
    </div>

    <br><div class="input-group">
         <label>Enter Challenge Description: </label>
         <input type="text" name="challenge_description">
    </div>

    <br><div class="input-group">
         <label> How many points will user get to complete the task? </label>
         <input type="int" name="points_submission">
    </div>

    <br><!--press add button to take action-->
       <div class="input-group">
         <button type="submit" class="btn" name="add_challenge">Add</button>
       </div>
   </form>
   <p>
   
   

       






    
    <!--Removing Content-->
   <!--Delete URL--> 
   <center> 
   <div class="header2">
          <h2>Delete Challenges </h2>
   </div>
   <br>


   <form method="post" action="adminMonthlyChallengeControl.php">
       <?php include('errors.php'); ?>
   <br>
   
    <br> 
    <div class="input-group">
         <label>Enter name of the challenge you want to delete. </label>
         <input type="text" name="challenge_name">
       </div>
   
   <div class="input-group">
         <button type="submit" class="btn" name="delete_challenge">Delete</button>
       </div>
   
   </center>
   </form> 
   

  <!--show all the challenges in the database -->

  <br>
    <b><h2>Challenges in the Database </h2></b>
    <br>

    <?php

   $db = mysqli_connect('localhost', 'root', '', 'wellness');

   $user_check_query = "SELECT challenge_name, points_submission FROM listOfChallenges";
   $result = mysqli_query($db, $user_check_query);

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "You do not have any challenges in the database. Please add them.";
      return;
   }
 
   {
      echo "<div style=\"text-align:center\">";
      echo "Challenges are listed below (challenge name | points awarded) ";
   }
  
   while ($row = $result -> fetch_assoc())
   {
      echo "<div style=\"text-align:center\">";
      echo "<br>{$row['challenge_name']}   |   ";
      echo "{$row['points_submission']}<br>";
   }
   
   
   ?>



  
  
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