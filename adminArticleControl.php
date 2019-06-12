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
    <div class = "logo"><img src = "logo2.png" style="width:10%"></a>
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
   
  
   <!-- button to add content -->
   <center>
   <div class="header">
       <h2>Add New Article</h2>
   </div>
     
    <!--need to add URL here --> 
   <form method="post" action="adminArticleControl.php">
    
    <?php include('errors.php'); ?>
    
       
    <br>
    <br> <!--enter URL that needs to be added -->
   
    <br><div class="input-group">
         <label>Enter Article Title: </label>
         <input type="text" name="ArticleTitle" size="20"> 
    </div>

    <br><div class="input-group">
         <label>Enter Primary Author Name: </label>
         <input type="text" name="ArticleAuthors">
    </div>

    <br><div class="input-group">
         <label>(optional) Enter Topic 1: </label>
         <input type="text" name="ArticleTopic_1">
    </div>

    <br><div class="input-group">
         <label>(optional) Enter Topic 2: </label>
         <input type="text" name="ArticleTopic_2">
    </div>

    <br><div class="input-group">
         <label>(optional) Enter Topic 3: </label>
         <input type="text" name="ArticleTopic_3">
    </div>

    <br><div class="input-group">
         <label>(optional) Enter Tag 1: </label>
         <input type="text" name="ArticleTag_1">
    </div>

    <br><div class="input-group">
         <label>(optional) Enter Tag 2: </label>
         <input type="text" name="ArticleTag_2">
    </div>

    <br><div class="input-group">
         <label>(optional) Enter Tag 3: </label>
         <input type="text" name="ArticleTag_3">
    </div>

    <br><div class="input-group">
         <label>(optional) Enter Tag 4: </label>
         <input type="text" name="ArticleTag_4">
    </div>

    <br><div class="input-group">
         <label>Enter URL: </label>
         <input type="text" name="urls">
    </div>

    <br><!--press add button to take action-->
       <div class="input-group">
         <button type="submit" class="btn" name="add_bookmark">Add</button>
       </div>
   </form>
   <p>
   
   

       






    
    <!--Removing Content-->
   <!--Delete URL--> 
   <center> 
   <div class="header2">
          <h2>Enter URL You Want to Delete </h2>
   </div>
   <br>


   <form method="post" action="adminArticleControl.php">
       <?php include('errors.php'); ?>
   <br>
   
    <br> 
    <div class="input-group">
         <label>Enter URL your want to delete. Recommend to view the URL list and copy and paste the link below. </label>
         <input type="text" name="url_to_delete">
       </div>
   
   <div class="input-group">
         <button type="submit" class="btn" name="delete_url">Delete</button>
       </div>
   
   </center>
   </form> 
   
    



   <!--show all the article titles + their in the database -->

    <br>
    <b><h2>Articles in the Database </h2></b>
    <br>

    <?php

   $db = mysqli_connect('localhost', 'root', '', 'wellness');

   $user_check_query = "SELECT ArticleTitle, urls  FROM articles";
   $result = mysqli_query($db, $user_check_query);

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "You do not have any articles bookmarked currently. Please add them.";
      return;
   }
 
   {
      echo "<div style=\"text-align:center\">";
      echo "Article Title and URLS are listed below: ";
   }
  
   echo "<br>";
   while ($row = $result -> fetch_assoc())
   {
      echo "<div style=\"text-align:center\">";
      echo "<br>{$row['ArticleTitle']}   |   ";
      echo "<a href='{$row['urls']}' target='_new'> {$row['urls']} </a><br>";
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