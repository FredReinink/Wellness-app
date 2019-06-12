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
 


  <style> 
    body {
	width: 100wh;
	height: 90vh;
	color: #000000;
	background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 15s ease infinite;
}

@-webkit-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@-moz-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

h1,
h6 {
	font-family: 'Open Sans';
	font-weight: 300;
	text-align: center;
	position: absolute;
	top: 45%;
	right: 0;
	left: 0;
}
</style>



























   <style>
   
   <!-- add a search feature --> 
   <style> 
    input[type=text] 
    {
        width: 1000px;
        font-size: 20px;
        background-color: white;
        background-position: 10px 10px; 
        
  
    }

    input[type=text]:focus 
    {
       border: none; 
        width: 100%;
    }
    </style>
   <!--
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
        
        <input type="text" placeholder="Search" name="search" size="100%">
        
    </div>

    <div class="input-group">
        <button type="submit" name="submit1"></button>
    </div>
    </center>
    </form>
    
    <br>
    <br>
    


  
    <!--action on search bars--> 

    
-->


       
                

                
  


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






<!--
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

-->

  <p>
  <!-- circle dots -->
  <!--
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>-->
  </p>
  
  



</body>
</html>

