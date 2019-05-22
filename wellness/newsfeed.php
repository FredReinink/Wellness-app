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
 
   <!-- add a search feature --> 
   <style> 
    input[type=text] 
    {
        width: 190px;
        box-sizing: border-box;
        border: 4px solid #ccc;
        border-radius: 4px;
        font-size: 18px;
        background-color: white;
        background-position: 10px 10px; 
        padding: 12px 20px 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    input[type=text]:focus 
    {
        width: 100%;
    }
    </style>
   

    <p><b><h2><center>Search for Articles</center></h2></b></p>

    <form>
    <input type="text" name="search" placeholder="Search..">
    </form>







   <!-- view all the article title | authors | topics | Tags | URL in a table --> 





  <p>
  <!-- circle dots -->
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  </p>
  
  



</body>
</html>

