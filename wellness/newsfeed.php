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
        width: 1000px;
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
   
   <br>
   <br>
   <br>
   <?php include('server.php') ?>
    <br>
    <p><b><h2><center>Search for Articles | Topics | Titles </center></h2></b></p>

    

    

    <form method="post" action="newsfeed.php">

    <?php include('errors.php'); ?>
    <center>
    <div class="input-group">
        
        <input type="text" placeholder="Search" name="search">
        
    </div>

    <div class="input-group">
        <button type="submit" name="submit1"></button>
    </div>
    </center>
    </form>
    
    <br>
    <br>
    


  
    <!--action on search bars--> 

    



       
                

                
  


   <!-- view all the article title | authors | topics | Tags | URL in a table --> 

    <!-- some CSS libraries from internet-->
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   
    <!--make a table -->
    <body>
    <h2><b><center>Article Newsfeed</center></b></h2>

    <div class="container">
    
    <table class="table table-bordered">
    <thead>
    <tr>
    <th>ArticleID</th>
    <th>Title</th>
    <th>Authors</th>
    <th>URLS</th>

      </tr>
    </thead>
    <tbody>
    <tr>

    <!-- populate information in the table --> 
    <?php
            $db = mysqli_connect('localhost', 'root', '', 'wellness');

            if (!$db)

            {
                die('Could not connect: ' . mysql_error());
            }
   
            $user_check_query = "SELECT article_ID, ArticleTitle, ArticleAuthors, urls FROM articles";
            $result = mysqli_query($db, $user_check_query);
            
            while ($row = $result -> fetch_assoc())
            {
              echo"<td>".$row['article_ID']."</td>";
              echo"<td>".$row['ArticleTitle']."</td>";
              echo"<td>".$row['ArticleAuthors']."</td>";
              // getting clickable links yeyy got ittt
              echo "<td>";
              echo "<a href='{$row['urls']}' target='_new'> {$row['urls']} </a>";
              echo "</td>";
              echo "</tr>";
            }
    ?>
    </table>


            <br><br>
          

            <p>
  <!-- circle dots -->
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  </p>
  
  




<style>
body {font-family: Arial, Helvetica, sans-serif;}

form 
{
  border: solid #f1f1f1;
  font-family: Arial;
}

.container 
{
  padding: 1px;
  
}

input[type=text], input[type=submit] 
{
  width: 100%;
  padding: 5px;
  margin: 2px 0;
  display: inline-block;
  border:  solid #ccc;
  box-sizing: border-box;
}


input[type=submit] 
{
  font-size: 25px;
  background-color: #CEE107;
  color: black;
  border: none;
  
}

input[type=submit]:hover 
{
  opacity: 0.2;
}
</style>
<body>







<form action="/action_page.php">
  <div class="container">
  <h2><center>Well Newsletter | Stay Connected</center></h2>
  </div>


  <div class="container" style="background-color:white">
    <input type="text" placeholder="Name" name="name" required>
    <input type="text" placeholder="Email address" name="mail" required>
  </div>

  <div class="container">
    <input type="submit" value="Subscribe">
  </div>
</form>



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

