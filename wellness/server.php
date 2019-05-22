<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'wellness');


//for registering users 
// REGISTER USER
if (isset($_POST['reg_user'])) 
{
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $firstName = mysqli_real_escape_string($db, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($db, $_POST['lastName']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($firstName)) { array_push($errors, "First Name is required"); }
  if (empty($lastName)) { array_push($errors, "Last Name is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
  	$password = md5($password_1);//encrypt (hashing) the password before saving in the database

  	$query = "INSERT INTO users (username, email, password, first_name, last_name) 
  			  VALUES('$username', '$email', '$password', '$firstName', '$lastName')";
  	mysqli_query($db, $query);
   
    // Enter user session 
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: afterUserLogIn.php');
  }
}



//for logging in users 
if (isset($_POST['login_user'])) 
{
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) 
  {
  	array_push($errors, "Username is required");
  }
  
  if (empty($password)) 
  {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) 
  {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
   
  	if (mysqli_num_rows($results) == 1) 
   {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: afterUserLogIn.php');
  	}
     
   else 
   {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}




//adding URLS/Articles 

// for adding new bookmarks and expanding the table 
if (isset($_POST['add_bookmark'])) 
{
        $url = $_POST['urls'];
        $ArticleTitle = $_POST['ArticleTitle'];
        $ArticleAuthors = $_POST['ArticleAuthors'];
        $ArticleTopic_1 = $_POST['ArticleTopic_1'];
        $ArticleTopic_2 = $_POST['ArticleTopic_2'];
        $ArticleTopic_3 = $_POST['ArticleTopic_3'];
        $ArticleTag_1 = $_POST['ArticleTag_1'];
        $ArticleTag_2 = $_POST['ArticleTag_2'];
        $ArticleTag_3 = $_POST['ArticleTag_3'];
        $ArticleTag_4 = $_POST['ArticleTag_4'];

        if (empty($url) || empty($ArticleTitle) || empty($ArticleAuthors)) 
        {
            array_push($errors, "You are required to enter URLS, article title and primary article author names");
        }

		$url = url_sanitize($url);
      
		if(!url_valid($url)) 
      { 
         echo "<div style=\"text-align:center\">";
         echo "Entered URL is not valid. Please enter a valid URL!"; 
         return; 
      }	
		
      if(url_already_exists( $url, $db)) 
      { 
         echo "<div style=\"text-align:center\">";
         echo "This URL already exists in the database!"; 
         return; 
      }	
		
            
      // add url to the system
        $query = "INSERT INTO articles(ArticleTitle, ArticleAuthors, urls, ArticleTopic_1, ArticleTopic_2, ArticleTopic_3, ArticleTag_1, ArticleTag_2, ArticleTag_3, ArticleTag_4  ) VALUES ('$ArticleTitle', '$ArticleAuthors', '$url', '$ArticleTopic_1', '$ArticleTopic_2', '$ArticleTopic_3', '$ArticleTag_1', '$ArticleTag_2', '$ArticleTag_3', '$ArticleTag_4')";
        $result = mysqli_query($db, $query);
        mysqli_num_rows($result);
      
      echo "<div style=\"text-align:center\">";
      echo "Added!";
      return;
      
}


//deleting URLS/articles from the list 
if(isset($_POST['delete_url']))
{
   $url_to_delete = $_POST['url_to_delete'];
   $user_check_query = "DELETE FROM articles WHERE urls='$url_to_delete'";
   $result = mysqli_query($db, $user_check_query);

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "URL you enter does not exist in your database. Please ensure you've entered the correct URL.";
      return;
   }
 
   echo "<div style=\"text-align:center\">";  
   echo "Deleted !";
}

//validating URLS
function url_valid($url) 
{ 
	$handle = @fopen($url, "r"); 
	if ($handle === false) 
		return false; 
	
	fclose($handle); 
	return true; 
}

//sanitizing URLS
function url_sanitize($url) 
{
	if(strlen($url) < 4 || substr( $url, 0, 4) !== "http")
		$url = "https://www.$url";
	return $url;
}

//checking if URLS already exist in data system or not
function url_already_exists( $url, $db)
{
	$query = "SELECT * FROM articles WHERE urls = '$url'";
	$result = mysqli_query($db, $query);
	return mysqli_num_rows($result) == 1;
}







//adding challenges 
// for adding new bookmarks and expanding the table 
if (isset($_POST['add_challenge'])) 
{

        $challenge_name = $_POST['challenge_name'];
        $challenge_description = $_POST['challenge_description'];
        $points_submission = $_POST['points_submission'];
      
    
        //error handling for empty 
        if (empty($challenge_name) || empty($challenge_description) || empty($points_submission)) 
        {
            array_push($errors, "Please ensure all the contents are filled out");
        }

		
            
      // add url to the system
		$query = "INSERT INTO listOfChallenges (challenge_name, challenge_description, points_submission ) VALUES ('$challenge_name', '$challenge_description' , '$points_submission')";
		$result = mysqli_query($db, $query);
		mysqli_num_rows($result);
      
      echo "<div style=\"text-align:center\">";
      echo "Added!";
      return;
      
}






//delete challenge
if(isset($_POST['delete_challenge']))
{
   $challenge_name = $_POST['challenge_name'];
   $user_check_query = "DELETE FROM listOfChallenges WHERE challenge_name='$challenge_name'";
   $result = mysqli_query($db, $user_check_query);

   if (!$result)
   {
      echo "<div style=\"text-align:center\">";
      echo "This challenge does not exist in your database. Please ensure you've entered the correct challenge.";
      return;
   }
 
   echo "<div style=\"text-align:center\">";  
   echo "Deleted !";
}







//add the challenge user has completed in the table
if (isset($_POST['challenge_submission'])) 
{

        $username = $_POST['username'];
        $challenge_name = $_POST['challenge_name'];
        $submission = $_POST['submission'];
        $points_granted = 5; 
      
    
        //error handling for empty 
        if (empty($username) || empty($challenge_name) || empty($submission)) 
        {
            array_push($errors, "Please ensure all the contents are filled out");
        }


        //assume user can participate in the same challenge as many times as they wish 


		
            
        // add challenge submission info to the system
		$query = "INSERT INTO challenges (username, challenge_name, submission, points_granted ) VALUES ('$username', '$challenge_name', '$submission' , '$points_granted')";
		$result = mysqli_query($db, $query);
        mysqli_num_rows($result);
        

        // add challenge submission info to the system
		$query = "INSERT INTO userPoints (username, points ) VALUES ('$username', '$points_granted')";
		$result = mysqli_query($db, $query);
		mysqli_num_rows($result);
      

      echo "<div style=\"text-align:center\">";
      echo "Added!";
      return;
      
}











?>

