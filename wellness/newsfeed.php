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
   

   <link rel="stylesheet" type="text/css" href="stylesheets/style.css">

   
   <?php include('server.php') ?>
  

    <center>
   <div class="header">
       <h2>Search for Articles | Topics | Titles </h2><hr>
   </div>
   </center>

    

    <form method="post" action="newsfeed.php">

    <?php include('errors.php'); ?>
    <center>
    <div class="input-group">
        
        <input type="text" placeholder="Search" name="search" size="100%">
        
    </div>

    <div class="input-group">
        <button type="submit" name="searchButton"></button>
    </div>
    </center>
    </form>
    
    <br>
    <br>
    


  
    <!--action on search bars--> 
    <?php
  //This class generates a the cells for the search results in editor.php

  $db = mysqli_connect('localhost', 'root', '', 'wellness');

  if (isset($_POST['searchButton'])){
    $search_value = $_POST['search'];
    
    error_log($search_value);

    $searchQuery = "SELECT * FROM articles WHERE ArticleTitle LIKE '%$search_value%' OR ArticleAuthors LIKE '%$search_value%' OR urls LIKE '%$search_value%' OR ArticleTopic_1 LIKE '%$search_value%' OR ArticleTopic_2 LIKE '%$search_value%' OR ArticleTopic_3 LIKE '%$search_value%' OR ArticleTag_1 LIKE '%$search_value%' OR ArticleTag_2 LIKE '%$search_value%' OR ArticleTag_3 LIKE '%$search_value%' OR ArticleTag_4 LIKE '%$search_value%'";
    $result = mysqli_query($db, $searchQuery);

    //generate cell information from DB
    while ($row = mysqli_fetch_assoc($result)){
      echo '<tr>';
        echo '<br>';
        echo "Article ID: ";
        echo '<td>' . $row['article_ID'] . '</td>';
        echo '<br>';
        echo "Article Title: ";
        echo '<td>' . $row['ArticleTitle'] . '</td>';
        echo '<br>';
        echo "Article Authors: ";
        echo '<td>' . $row['ArticleAuthors'] . '</td>';
        echo '<br>';
        echo "URLS: ";
        echo "<a href='{$row['urls']}' target='_new'> {$row['urls']} </a><br>";
      echo '</tr>';
    }
	echo '<table>';
}
?>
    



       
                

                
  


   <!-- view all the article title | authors | topics | Tags | URL in a table --> 
   
    <!--make a table -->
    <body>
    
    <div class="container">

   <div class="header">
       <h2>Article Newsfeed</h2><hr>
   </div>
   
    <center>
    <table class="table table-bordered" border = "2" bgcolor = "#FFFFFF" >
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

    <!-- great works now -->
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
    </center>


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


  
  
  



</body>
</html>

