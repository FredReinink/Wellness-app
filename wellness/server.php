<?php

session_start();

//initialize error log
ini_set("log_errors", 1);
ini_set("error_log", "serverError.log");

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
  $userExistsQuery = mysqli_prepare($db, "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
  mysqli_stmt_bind_param($userExistsQuery,"ss", $username, $email);
  mysqli_stmt_execute($userExistsQuery);
  $result = $userExistsQuery->get_result();
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

	$newUserQuery = mysqli_prepare($db, "INSERT INTO users (username, email, password, first_name, last_name) VALUES (?,?,?,?,?)");
	mysqli_stmt_bind_param($newUserQuery,"sssss", $username, $email, $password, $firstName, $lastName);
	mysqli_stmt_execute($newUserQuery);
	
	//initialize followedExercises
	$initFollowedExercisesQuery = mysqli_prepare($db,"INSERT INTO followedExercises (username) VALUES (?)");
	mysqli_stmt_bind_param($initFollowedExercisesQuery,"s", $username);
	mysqli_stmt_execute($initFollowedExercisesQuery);
   
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
  	$loginQuery = mysqli_prepare($db, "SELECT * FROM users WHERE username= ? AND password= ?");
	mysqli_stmt_bind_param($loginQuery,"ss", $username, $password);
	$success = mysqli_stmt_execute($loginQuery);

   
  	if ($success) 
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


//emailForm

if(isset($_POST['emailForm']))
{
    $fromEmail = mysqli_real_escape_string($db, $_POST['Email']);
    $name = mysqli_real_escape_string($db, $_POST['Name']);
    $subject = mysqli_real_escape_string($db, $_POST['Subject']);
    $message = mysqli_real_escape_string($db, $_POST['Message']);

    // send query
    $feedbackQuery = mysqli_prepare($db, "INSERT INTO feedBack(name, fromEmail, subject, message) VALUES (?, ?, ?, ?)");
	mysqli_stmt_bind_param($feedbackQuery,"ssss", $name, $fromEmail, $subject, $message);
	$success = mysqli_stmt_execute($feedbackQuery);
    
	if ($success){
		echo "Thank you! We'll contact you soon.";
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
        $addArticleQuery = mysqli_prepare($db, "INSERT INTO articles(ArticleTitle, ArticleAuthors, urls, ArticleTopic_1, ArticleTopic_2, ArticleTopic_3, ArticleTag_1, ArticleTag_2, ArticleTag_3, ArticleTag_4  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($addArticleQuery,"ssssssssss", $ArticleTitle, $ArticleAuthors, $url ,$ArticleTopic_1, $ArticleTopic_2, $ArticleTopic_3, $ArticleTag_1, $ArticleTag_2, $ArticleTag_3, $ArticleTag_4);
		mysqli_stmt_execute($addArticleQuery);
      
      echo "<div style=\"text-align:center\">";
      echo "Added!";
      return;
      
}


//deleting URLS/articles from the list 
if(isset($_POST['delete_url']))
{
    //$url = mysqli_real_escape_string($db, $_POST['url_to_delete']);
    $url = $_POST['delete_url'];

   
    $deleteArticleQuery = mysqli_prepare($db, "DELETE FROM articles WHERE urls= ?");
  	mysqli_stmt_bind_param($deleteArticleQuery,"s", $url);
    $success = mysqli_stmt_execute($deleteArticleQuery);

	echo "<div style=\"text-align:center\">";  
    if ($success) {
    echo "Deleted !";
    //redirect
    header("Location: Admin/adminArticleControl.php");

    } else {
       echo "URL you entered does not exist in the database. Please ensure you've entered the correct URL.";
       //redirect
       header("Location: Admin/adminArticleControl.php");

	}
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

//sanitizing dates
function date_sanitize($date)
{
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
	
    $challenge_name = mysqli_real_escape_string($db, $_POST['challenge_name']);
    $challenge_description = mysqli_real_escape_string($db, $_POST['challenge_description']);
    $points_submission = mysqli_real_escape_string($db, $_POST['points_submission']);
      
    
    //error handling for empty 
    if (empty($challenge_name) || empty($challenge_description) || empty($points_submission)) 
    {
        array_push($errors, "Please ensure all the contents are filled out");
    }

    // add url to the system
	$addChallengeQuery = mysqli_prepare($db, "INSERT INTO listOfChallenges (challenge_name, challenge_description, points_submission ) VALUES (?,?,?)");
	mysqli_stmt_bind_param($addChallengeQuery,"sss", $challenge_name, $challenge_description , $points_submission);
	$success = mysqli_stmt_execute($addChallengeQuery);
    
	echo "<div style=\"text-align:center\">";
	if ($success){
		echo "Added!";
	} else {
		echo "SQL Error. Your challenge was not added.";
	}
}

//delete challenge
if(isset($_POST['delete_challenge']))
{
	
   $challenge_name = $_POST['delete_challenge'];
   
   $deleteChallengeQuery = mysqli_prepare($db, "DELETE FROM listOfChallenges WHERE challenge_name = ?");
   mysqli_stmt_bind_param($deleteChallengeQuery, "s", $challenge_name);
   $success = mysqli_stmt_execute($deleteChallengeQuery);

   echo "<div style=\"text-align:center\">";
   if ($success){
    echo "Deleted !";
    //redirect
    header("Location: Admin/adminMonthlyChallengeControl.php");

   } else {
      echo "This challenge does not exist in the database. Please ensure you've entered the correct challenge.";
      header("Location: Admin/adminMonthlyChallengeControl.php");
   }
}


//submit fitness tracking information
if (isset($_POST['submit_fitness_info']))
{	
	$date = mysqli_real_escape_string($db, $_POST['date']);
	
	$cardio_minutes = mysqli_real_escape_string($db, $_POST['cardio_minutes']);
	$cardio_heartrate = mysqli_real_escape_string($db, $_POST['cardio_heartrate']);
	
	$username = $_SESSION['username'];
	
	if ($cardio_minutes != 0 && $cardio_heartrate != 0){
		
	//update cardioTracker
		$updateCardioQuery = mysqli_prepare($db, "INSERT INTO cardioTracker (username, cardio_date, cardio_minutes, cardio_heartrate) 
				  VALUES(?,?,?,?)");
		mysqli_stmt_bind_param($updateCardioQuery, "ssii", $username, $date, $cardio_minutes, $cardio_heartrate);
		$success = mysqli_stmt_execute($updateCardioQuery);
	}
	
	//update weightLiftingTracker
	$updateWeightLiftingQuery = mysqli_prepare($db,"INSERT INTO weightLiftingTracker (username, weights_date) VALUES(?,?)");
	mysqli_stmt_bind_param($updateWeightLiftingQuery, "ss", $username, $date);
	$success = mysqli_stmt_execute($updateWeightLiftingQuery);
	
	if ($success) {
		echo "<div style=\"text-align:center\">";
		echo 'Added!';
	}
	
	$num_exercises = getNumExercises($username);
	
	//updates individual exercise info
	for ($i = 1; $i <= $num_exercises; $i++){
		$exerciseNameString = "user_exercise" . $i . "_name";
		$exerciseWeightString = "user_exercise" . $i . "_weight";
		$exerciseRepsString = "user_exercise" . $i . "_reps";
		
		if (isset($_POST[$exerciseWeightString])){
			$exerciseNameQuery = mysqli_prepare($db, "SELECT $exerciseNameString FROM followedExercises WHERE username = ?");
			mysqli_stmt_bind_param($exerciseNameQuery, "s", $username);
			mysqli_stmt_execute($exerciseNameQuery);
			$exerciseNameResult = $exerciseNameQuery->get_result();
			$exerciseName = mysqli_fetch_assoc($exerciseNameResult)[$exerciseNameString];
		
			$exerciseWeight = $_POST[$exerciseWeightString];
			$exerciseReps = $_POST[$exerciseRepsString];
			
			if ($exerciseWeight != 0 && $exerciseReps != 0){
				$exerciseUpdateQuery = mysqli_prepare($db, "UPDATE weightLiftingTracker SET $exerciseNameString = ?, $exerciseWeightString = ?, $exerciseRepsString = ? WHERE username = ? AND weights_date = ?");
				mysqli_stmt_bind_param($exerciseUpdateQuery, "siiss", $exerciseName, $exerciseWeight, $exerciseReps, $username, $date);
				mysqli_stmt_execute($exerciseUpdateQuery);
			}
		}
	}
}

//add exercise to followedExercises
if (isset($_POST['add_exercise']))
{
	$username = $_SESSION['username'];
	$exerciseName = mysqli_real_escape_string($db, $_POST['addExercise']);
	
	$num_exercises = getNumExercises($username);
  
    if ($num_exercises > 15) {
      array_push($errors, "You are already tracking the maximum number of exercises");
    }
	
	$num_exercises_plus_one = $num_exercises + 1;
	$num_ex_as_string = (string)($num_exercises_plus_one);
	
	//format a query string to correspond to the field names in the DB. Ex: "user_exercise7_name"
	$queryString = "user_exercise" . $num_ex_as_string . "_name";
	
	$addExerciseQuery = mysqli_prepare($db, "UPDATE followedExercises SET $queryString = ? WHERE username = ?");
	mysqli_stmt_bind_param($addExerciseQuery, "ss", $exerciseName, $username);
	$success = mysqli_stmt_execute($addExerciseQuery);

	if ($success){
		echo "<div style=\"text-align:center\">";
		echo 'Added!';
	}
}

//handles the "add" button for a food item in addFood.php
if (isset($_POST['addFood'])){
	$foodName = mysqli_real_escape_string($db, $_POST['addFood']);
	$username = $_SESSION['username'];
	$dietDate = $_SESSION['enteredDate'];
	
	$selectFoodQuery = mysqli_prepare($db, "SELECT * FROM foodItem WHERE name = ?");
	mysqli_stmt_bind_param($selectFoodQuery, "s", $foodName);
    mysqli_stmt_execute($selectFoodQuery);
	$foodResult = $selectFoodQuery->get_result();
	$food = mysqli_fetch_assoc($foodResult);
	

	$_SESSION['totalCalories'] += $food['calories']; 
	$_SESSION['gramsProtein'] += $food['gProtein']; 
	$_SESSION['gramsFat'] += $food['gFat']; 
	$_SESSION['gramsCarbs'] += $food['gCarbs'];
	
	$totalCalories = $_SESSION['totalCalories'];
	$gramsProtein = $_SESSION['gramsProtein'];
	$gramsFat = $_SESSION['gramsFat'];
	$gramsCarbs = $_SESSION['gramsCarbs'];
	
	$updateDietQuery = mysqli_prepare($db, "UPDATE dietTracker SET calories_consumed = ?, gProteinConsumed = ?, gCarbsConsumed = ?, gFatConsumed = ? WHERE username = ? AND diet_date = ?");
	mysqli_stmt_bind_param($updateDietQuery, "iiiiss", $totalCalories, $gramsProtein, $gramsCarbs, $gramsFat, $username, $dietDate);
	mysqli_stmt_execute($updateDietQuery);
	
	header('location: addFood.php');	
}

//submit diet tracking information
if (isset($_POST['submit_diet_info']))
{
	if (isset($_SESSION['persistentSearchValue'])){
		unset($_SESSION['persistentSearchValue']);
	}
	
	$username = $_SESSION['username'];
	
	$date = mysqli_real_escape_string($db, $_POST['date']);
	$weight = mysqli_real_escape_string($db, $_POST['weight']);
	
	//initialize variables for addFood.php
	$_SESSION['enteredDate'] = $date;
	$_SESSION['totalCalories'] = 0;
	$_SESSION['gramsProtein'] = 0;
	$_SESSION['gramsFat'] = 0;
	$_SESSION['gramsCarbs'] = 0;
	
	//Prepared statements are not necessary here as the weight field is restricted to integers by HTML
  	$query = "INSERT INTO dietTracker (username, diet_date, weight) VALUES('$username', '$date', '$weight')";
  	$result = mysqli_query($db, $query);
	
	//if the user has already tracked that date, update with new weight value
	if (!$result){
		$query = "UPDATE dietTracker SET weight = '$weight' WHERE username = '$username' AND diet_date = '$date'";
		$result = mysqli_query($db, $query);
	}
}


//add the challenge user has completed in the table
if (isset($_POST['challenge_submission'])) 
{
        $username = $_SESSION['username'];
        $challenge_name = mysqli_real_escape_string($db, $_POST['challenge_name']);
        $submission = mysqli_real_escape_string($db, $_POST['submission']);


        //check with 
        $update = "SELECT points_submission FROM listofchallenges WHERE challenge_name = '$challenge_name'";
			  $result = mysqli_query($db,$update);
        while ($row = mysqli_fetch_assoc($result))
        {
            $points_granted = $row['points_submission'];
        }

        //error handling for empty 
        if (empty($username) || empty($challenge_name) || empty($submission)) 
        {
            array_push($errors, "Please ensure all the contents are filled out or you have entered incorrect challenge name ");
        }


        //assume user can participate in the same challenge as many times as they wish 


        // add challenge submission info to the system
        $query = "INSERT INTO challenges (username, challenge_name, submission, points_granted ) VALUES ('$username', '$challenge_name', '$submission' , '$points_granted')";
        mysqli_query($db, $query);
       


        // add challenge submission info to the system
        $query = "INSERT INTO userPoints (username, points ) VALUES ('$username', '$points_granted')";
        mysqli_query($db, $query);
      

        echo "<div style=\"text-align:center\">";
        echo "Added!";
        return;
      
}




// wellnessTest
if(isset($_POST['submitData']))
{
  $username = mysqli_real_escape_string($db, $_SESSION['username']);
  $weight = mysqli_real_escape_string($db, $_POST['weight']);
  $height = mysqli_real_escape_string($db, $_POST['height']);
  $height = $height / 100; 
  $sex = mysqli_real_escape_string($db, $_POST['sex']);
  $age = mysqli_real_escape_string($db, $_POST['age']);
  $rest_pulse = mysqli_real_escape_string($db, $_POST['rest_pulse']);
  $Max_heart_rate = mysqli_real_escape_string($db, $_POST['Max_heart_rate']);
  $Activity_level = mysqli_real_escape_string($db, $_POST['Activity_level']);
  $Weight_goal = mysqli_real_escape_string($db, $_POST['Weight_goal']);
  $date = mysqli_real_escape_string($db, $_POST['date']);

  $BMI = calculateBMI($weight, $height); 

  heartRate ($age, $rest_pulse, $Max_heart_rate); 
  $BMR = calcBMR($sex, $weight, $height, $age);
  recommendDailyCaloryInput($BMR, $Activity_level, $Weight_goal);

  //store info on the database Table userWellnessTest
  $storeWellnessTestQuery = mysqli_prepare($db, "INSERT INTO userWellnessTest (username, Age, Height_cm, Weight_kg, BMI_calculated, Test_Date, Sex, ActivityLevel, WeightGoal, restingPulse, MaxHeartRate) VALUES (?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  mysqli_stmt_bind_param($storeWellnessTestQuery, "sisssssssss", $username, $age , $height, $weight, $BMI, $date, $sex, $Activity_level, $Weight_goal, $rest_pulse, $Max_heart_rate);
  mysqli_execute($storeWellnessTestQuery);

  echo "<div style=\"text-align:center\">";
  echo "Thanks!"; 
}




// https://www.thecalculatorsite.com/articles/health/bmi-formula-for-bmi-calculations.php
//function to calculate BMI
function calculateBMI($weight, $height)
{
  $BMI = $weight / ($height * $height);


 
 //echo "<h1><center><b>ASSESSMENT RESULTS </b></center></h1>";

 echo "<p>
 <div style=\"text-align:center\">
   <span class=\"dot\"></span>
   <span class=\"dot\"></span>
   <span class=\"dot\"></span>
 </div>
 </p>";


  echo "<div style=\"text-align:center\">";
  echo "<b>BMI: </b>"; 
  echo number_format($BMI, 1);
  echo "<br>";

  
  if ($BMI >= 40)
  {
    echo "Very Severaly Obese";
  }

  else if ($BMI < 40 && $BMI >= 35)
  {
    echo "Severely Obese";
  }

  else if ($BMI < 35 && $BMI >= 30)
  {
    echo "Moderately Obese";
   
  }

  else if ($BMI < 30 && $BMI >= 25)
  {
    echo "Oveweight";
    // oveweight 
  }

  else if ($BMI < 25 && $BMI >= 18.5)
  {
    echo "Normal (healthy weight)";
    // normal (healthy weight) 
  }

   else if ($BMI < 18.5 && $BMI >= 16)
  {
    echo "Underweight";
    // underweight 
  }

  else if ($BMI < 16 && $BMI >= 15)
  {
    echo "Severely Underweight";
    // severely underweight 
  }

  else if ($BMI < 15)
  {
    echo "Severely Underweight";
    // very severely underweight
  }

  else
  {
    echo "Error in value entered. Please take the test again. Thanks!";
  }

  return $BMI; 
}





// function to calculate target heart rate 
//reference: https://my.clevelandclinic.org/health/diagnostics/17402-pulse--heart-rate/test-details
function heartRate ($age, $rest_pulse, $Max_heart_rate)
{
  echo "<div style=\"text-align:center\">";
  echo "<br>";
  echo "<b>Your current Max Heart Rate: </b>";
  echo $Max_heart_rate;

  echo "<br>";
  echo "<b>Allowable Max Heart Rate: </b> ";
  $maxHeartRate_ShouldBe = 220 - $age; 
  echo $maxHeartRate_ShouldBe;

  echo "<br>";
  

  if ($age  > 70)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 90 – 123</b>";
  }

  else if ($age <=70 && $age>65)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 93 – 132</b>";
  }

  else if ($age <=65 && $age>60)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 96 – 136</b>";
  }

  else if ($age <=60 && $age>55)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 99 – 140</b>";
  }

  else if ($age <=55 && $age>50)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 102 – 145</b>";
  }

  else if ($age <=50 && $age>45)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 105 – 149</b>";
  }

  else if ($age <=45 && $age>40)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 108 – 153</b>";
  }

  else if ($age <=40 && $age>35)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 111 – 157</b>";
  }

  else if ($age <=35 && $age>30)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 114 – 162</b>";
  }

  else if ($age <=30 && $age>25)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 117 – 166</b>";
  }

  else if ($age <=25 && $age>20)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 120 – 170</b>";
  }

  else if ($age <= 20)
  {
    echo "<b>Ideal Target Heart Rate (HR) Zone (60-85%): 100 - 120</b>";
  }

  else
  {
    echo "<b>Ideal Error in value entered. Please take the test again. Thanks!</b>";
  }

}


function calcBMR($sex, $weight, $height, $age)
{
  //Use original harris-benedict equation to calculate Men BMR
  if ($sex == 'M' || $sex == 'm' || $sex == 'MALE' || $sex == 'male')
  {
      echo "<div style=\"text-align:center\">";

      $BMR = 66.4720 + (13.7516 * $weight) + (5.0033 * $height) - (6.7550 * $age);
      echo "<br> Your BMR = ";
      echo number_format($BMR, 1);
      
  }

  else if ($sex == 'F' || $sex == 'f' || $sex == 'FEMALE' || $sex == 'female')
  {
      $BMR = 655.0955 + (9.5634 * $weight) + (1.8496 * $height) - (4.6756 * $age);
      echo "<br> Your BMR = ";
      echo number_format($BMR, 1);
      
  }

  else
  {
    echo "<br> Error in value entered. Results will be incorrect. Please take the test again. Thanks!";
    $BMR = 0; 
    
  }

  return $BMR;

}



function recommendDailyCaloryInput($BMR, $Activity_level, $Weight_goal)
{

  echo "<div style=\"text-align:center\">";

  //Recommend calory intake for: maintain weight weight_goal 2 with various levels of activities. 
  //Data comes from: https://bmi-calories.com/calorie-intake-calculator.html

  if ($Weight_goal == 2)
  {

      if ($Activity_level = 1)
      {
        $DailKilocaloriesNeeded = $BMR * 1.2;  

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo number_format($DailKilocaloriesNeeded, 0);
        

      
      }
    
      else if ($Activity_level = 2)
      {
        $DailKilocaloriesNeeded = $BMR * 1.375; 
        
        echo "<b><br>Your recommended daily calory intake: </b>";
        echo number_format($DailKilocaloriesNeeded, 0);
      }
    
      else if ($Activity_level = 3)
      {
        $DailKilocaloriesNeeded = $BMR * 1.55;  

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo number_format($DailKilocaloriesNeeded, 0);
      }
    
      else if ($Activity_level = 4)
      {
        $DailKilocaloriesNeeded = $BMR * 1.725;  

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo number_format($DailKilocaloriesNeeded, 0);
      }
    
      else if ( $Activity_level = 5)
      {
        $DailKilocaloriesNeeded = $BMR * 1.9;  

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo $number_format($DailKilocaloriesNeeded, 0);
      }

      else
      {
        echo "Error in value entered. Results will be incorrect. Please take the test again. Thanks!";
        $DailKilocaloriesNeeded = 0; 
      }

  }
  






  //Recommend calory intake for: lose weight weight_goal 1 with various levels of activities. 
  //Data comes from: https://bmi-calories.com/calorie-intake-calculator.html

  //Case 1: To lose 2.5 kg/month --> or lose 0.0833 kg/day
  //Case 2: To lose 5 kg/month --> or lose 0.1667 kg/day
  //Case 3: To lose 7 kg/month --> or lose 0.233 kg/day

  /*1 kilocalory = 1 eating Calory 
  Based on assumption need 3000 calory lose to 1 lb. 
  Thus, 2.2 lb = 1 kg = 6600 calories to lose 1 kg
  for 0.0833 kg loss = 6600 * 0.0833 = 549.78;
  for 0.1667 kg loss = 6600 * 0.1667 = 1100.22;
  for 0.2333 kg loss = 6600 * 0.2333 = 1539.78;
  */


  else if ($Weight_goal == 1)
  {
        
      if ($Activity_level = 1)
      {
        $DailKilocaloriesNeeded = $BMR * 1.2;  
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded - 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded - 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded - 1539.78;

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To lose 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To lose 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To lose 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);

      }
    
      else if ($Activity_level = 2)
      {
        $DailKilocaloriesNeeded = $BMR * 1.375; 
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded - 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded - 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded - 1539.78; 

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To lose 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To lose 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To lose 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }
    
      else if ($Activity_level = 3)
      {
        $DailKilocaloriesNeeded = $BMR * 1.55;
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded - 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded - 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded - 1539.78;  

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To lose 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To lose 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To lose 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }
    
      else if ($Activity_level = 4)
      {
        $DailKilocaloriesNeeded = $BMR * 1.725;  
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded - 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded - 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded - 1539.78;

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To lose 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To lose 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To lose 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }
    
      else if ( $Activity_level = 5)
      {
        $DailKilocaloriesNeeded = $BMR * 1.9;
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded - 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded - 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded - 1539.78;

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To lose 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To lose 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To lose 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }

      else
      {
        echo "Error in value entered. Results will be incorrect. Please take the test again. Thanks!";
        $DailKilocaloriesNeeded = 0; 
      }

  }




  
  
  

  //Recommend calory intake for: gain weight weight_goal 3 with various levels of activities. 

  //Case 1: To gain 2.5 kg/month --> or gain 0.0833 kg/day
  //Case 2: To gain 5 kg/month --> or gain 0.1667 kg/day
  //Case 3: To gain 7 kg/month --> or gain 0.233 kg/day

  /*1 kilocalory = 1 eating Calory 
  Based on assumption need 3000 calory lose to 1 lb. 
  Thus, 2.2 lb = 1 kg = 6600 calories to lose 1 kg
  for 0.0833 kg gain = 6600 * 0.0833 = 549.78;
  for 0.1667 kg gain = 6600 * 0.1667 = 1100.22;
  for 0.2333 kg gain = 6600 * 0.2333 = 1539.78;
  */


  else if ($Weight_goal == 3)
  {
        
      if ($Activity_level = 1)
      {
        $DailKilocaloriesNeeded = $BMR * 1.2;  
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded + 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded + 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded + 1539.78;

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To gain 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To gain 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To gain 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }
    
      else if ($Activity_level = 2)
      {
        $DailKilocaloriesNeeded = $BMR * 1.375; 
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded + 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded + 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded + 1539.78;

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To gain 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To gain 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To gain 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }
    
      else if ($Activity_level = 3)
      {
        $DailKilocaloriesNeeded = $BMR * 1.55;
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded + 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded + 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded + 1539.78;  

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To gain 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To gain 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To gain 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }
    
      else if ($Activity_level = 4)
      {
        $DailKilocaloriesNeeded = $BMR * 1.725;  
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded + 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded + 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded + 1539.78;

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To gain 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To gain 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To gain 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }
    
      else if ( $Activity_level = 5)
      {
        $DailKilocaloriesNeeded = $BMR * 1.9;
        //case 1
        $DailyCalCase1 = $DailKilocaloriesNeeded + 549.78;
        //case 2
        $DailyCalCase2 = $DailKilocaloriesNeeded + 1100.22;
        //case 3
        $DailyCalCase3 = $DailKilocaloriesNeeded + 1539.78; 

        echo "<b><br>Your recommended daily calory intake: </b>";
        echo "<br><b>Case 1:</b> To gain 2.5 kg/month - ";
        echo number_format($DailyCalCase1, 0);
        echo "<br><b>Case 2:</b> To gain 5 kg/month - ";
        echo number_format($DailyCalCase2, 0);
        echo "<br><b>Case 3:</b> To gain 7 kg/month - ";
        echo number_format($DailyCalCase3, 0);
      }

      else
      {
        echo "Error in value entered. Results will be incorrect. Please take the test again. Thanks!";
        $DailKilocaloriesNeeded = 0; 
      }

  }


  else
  {
    echo "<b>Error in values entered. Please take the test again.</b>";
  }

}

function getNumExercises($user){
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'wellness');
	
  	$query = "SELECT * FROM followedExercises where username = '$user'";
  	$result = mysqli_query($db, $query);
	
	while ($row = mysqli_fetch_assoc($result)){
		
		if (!isset($row['user_exercise1_name'])){
			return 0;
		} if (!isset($row['user_exercise2_name'])){
			return 1;
		} if (!isset($row['user_exercise3_name'])){
			return 2;
		} if (!isset($row['user_exercise4_name'])){
			return 3;
		} if (!isset($row['user_exercise5_name'])){
			return 4;
		} if (!isset($row['user_exercise6_name'])){
			return 5;
		} if (!isset($row['user_exercise7_name'])){
			return 6;
		} if (!isset($row['user_exercise8_name'])){
			return 7;
		} if (!isset($row['user_exercise9_name'])){
			return 8;
		} if (!isset($row['user_exercise10_name'])){
			return 9;
		} if (!isset($row['user_exercise11_name'])){
			return 10;
		} if (!isset($row['user_exercise12_name'])){
			return 11;
		} if (!isset($row['user_exercise13_name'])){
			return 12;
		} if (!isset($row['user_exercise14_name'])){
			return 13;
		} if (!isset($row['user_exercise15_name'])){
			return 14;
		}
	}
}

?>

