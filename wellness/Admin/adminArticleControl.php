<!DOCTYPE html>


<html>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../stylesheets/stylesheet.css">
 



  
  
  <head>
  
    <title> Wellness </title> 

    </head> 



    <body> 
    <!-- add a logo --> 
    <div class = "logo"><img src = "../images/logo2.png" style="width:10%"></a>
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



    
  <?php include('../server.php') ?>
   
  
   <!-- button to add content -->
   <center>
   <div class="header">
       <h2>Add New Article</h2><hr>
   </div>
     
    <!--need to add URL here --> 
   <form method="post" action="Admin/adminArticleControl.php">
    
    <?php include('../errors.php'); ?>
    <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
       
    
    <!--enter URL that needs to be added -->
   
    <br><div class="input-group">
         <label>Enter Article Title: *</label>
         <input type="text" name="ArticleTitle" size="20"> 
    </div>

    <br><div class="input-group">
         <label>Enter Primary Author Name: *</label>
         <input type="text" name="ArticleAuthors">
    </div>

    <br><div class="input-group">
         <label> (Optional) Enter Topic 1: </label>
         <input type="text" name="ArticleTopic_1">
    </div>

    <br><div class="input-group">
         <label> (Optional) Enter Topic 2: </label>
         <input type="text" name="ArticleTopic_2">
    </div>

    <br><div class="input-group">
         <label> (Optional) Enter Topic 3: </label>
         <input type="text" name="ArticleTopic_3">
    </div>

    <br><div class="input-group">
         <label> (Optional)Enter Tag 1: </label>
         <input type="text" name="ArticleTag_1">
    </div>

    <br><div class="input-group">
         <label> (Optional) Enter Tag 2: </label>
         <input type="text" name="ArticleTag_2">
    </div>

    <br><div class="input-group">
         <label> (Optional) Enter Tag 3: </label>
         <input type="text" name="ArticleTag_3">
    </div>

    <br><div class="input-group">
         <label> (Optional) Enter Tag 4: </label>
         <input type="text" name="ArticleTag_4">
    </div>

    <br><div class="input-group">
         <label>Enter URL: * </label>
         <input type="text" name="urls">
    </div>

    <br><!--press add button to take action-->
       <div class="input-group">
         <button type="submit" class="btn" name="add_bookmark">Add</button>
       </div>
   </form>
   <p>
   
   




      




    <br>
    <br>

  <!-- circle dots -->
  <br>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>



     <br>
     <br>





   <!--show all the article titles + their in the database -->
    <!--make a table -->

  


    <div class="container">

    <br>
    <div class="header">
          <h2>Articles in the Database </h2><hr>
   </div>
   
   <table class="table table-bordered" border="1" bgcolor="#FFFFFF">
    <thead>
    <tr>
    <th>Title</th>
    <th>URL</th>
    <th>Author</th>
    <th>URL</th>
    <th>Delete</th>
 
     </tr>
    </thead>
    <tbody>
    <tr>


    <?php

   $db = mysqli_connect('localhost', 'root', '', 'wellness');

   $user_check_query = "SELECT *  FROM articles";
   $result = mysqli_query($db, $user_check_query);

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "You do not have any articles bookmarked currently. Please add them.";
      return;
   }
 
   echo "<br>";
   while ($row = $result -> fetch_assoc())
   {
    
    echo '<tr>';
    echo '<td>' . $row['article_ID'] . '</td>';
    echo '<td>' . $row['ArticleTitle'] . '</td>';
    echo '<td>' . $row['ArticleAuthors'] . '</td>';
    // getting clickable links yeyy got ittt
    echo "<td>";
    echo "<a href='{$row['urls']}' target='_new'> {$row['urls']} </a>";
    echo "</td>";
   

    
    //The value of the button is set to be the same as the submission ID
    echo "<form action='../server.php' method='post'>";
    echo '<td><button type="submit" formaction="../server.php" name = "delete_url" value =' . $row['urls'] . '>Delete</button></td>';
    echo "</form>";
    echo '</tr>';

   }
   
   
   ?>
    </table>

  
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