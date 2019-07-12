<?php
session_start();

// initializing variables
$username = "";
$unitID= "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'wellness');





//for registering users 
//for logging in users 
if (isset($_POST['login_user'])) 
{
   
  $username = mysqli_real_escape_string($db, $_POST['adminUser']);
  $password = mysqli_real_escape_string($db, $_POST['adminPass']);

  if (empty($username)) 
  {
  	array_push($errors, "Admin Username is Required");
  }
  
  if (empty($password)) 
  {
  	array_push($errors, "Admin Password is Required");
  }

  if (count($errors) == 0) 
  {
  
   	$password = md5($password);
    
    // hardcoding admin username and password 
   	if ($username == "admin101" && $password = "admin101") 
      {
   	     header('location: adminArticleControl.php');
      }
      
    else 
      {
         array_push($errors, "Wrong username/password combination");
      }
  }
  
}

 
      


?>

