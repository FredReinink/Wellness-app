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
	
	//initialize followedExercises
	$query = "INSERT INTO followedExercises (username, num_exercises) VALUES ('$username', '0')";
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




//emailForm

if(isset($_POST['emailForm']))
{


    $fromEmail = mysqli_real_escape_string($db, $_POST['Email']);
    $name = mysqli_real_escape_string($db, $_POST['Name']);
    $subject = mysqli_real_escape_string($db, $_POST['Subject']);
    $message = $_POST['Message'];

    // send query
    $message = mysqli_real_escape_string($db, $_POST['Message']);
    $query = "INSERT INTO feedBack(name, fromEmail, subject, message) VALUES ('$name', '$fromEmail', '$subject', '$message')";
    $result = mysqli_query($db, $query);
    
  
    echo "Thank you! We'll contact you soon.";
  
    
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
        //mysqli_num_rows($result);
      
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
		//mysqli_num_rows($result);
      
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


//submit fitness tracking information
if (isset($_POST['submit_fitness_info']))
{	
	$date = $_POST['date'];
	
	$exercise_hours = $_POST['exercise'];
	$sleep_hours = $_POST['sleep'];
	$cardio_minutes = $_POST['cardio_minutes'];
	$cardio_heartrate = $_POST['cardio_heartrate'];
	
	$username = $_SESSION['username'];
	
	//update fitnessTracker
	$query = "INSERT INTO fitnessTracker (username, fitness_date, exercise_hours, sleep_hours) 
  			  VALUES('$username', '$date', '$exercise_hours', '$sleep_hours')";
  	$result = mysqli_query($db, $query);
	
	if (!$result){
		array_push($errors, "You have already added data for this date");
	} else {
		//update cardioTracker
		$query = "INSERT INTO cardioTracker (username, cardio_date, cardio_minutes, cardio_heartrate) 
				  VALUES('$username', '$date', '$cardio_minutes', '$cardio_heartrate')";
		$result = mysqli_query($db, $query);
		

		//update weightLiftingTracker
		$query = "INSERT INTO weightLiftingTracker (username, weights_date) 
		VALUES('$username', '$date')";
		$result = mysqli_query($db, $query);
		
		//Query to get the number of exercises the user currently tracks
		$num_exercises_query = "SELECT num_exercises FROM followedExercises WHERE username = '$username'";
		$num_exercises = mysqli_query($db, $num_exercises_query);
		$num_exercises_as_array = mysqli_fetch_assoc($num_exercises);
		
		//updates individual exercise info
		for ($i = 1; $i <= (int)$num_exercises_as_array['num_exercises']; $i++){
			$exerciseNameString = "user_exercise" . $i . "_name";
			$exerciseWeightString = "user_exercise" . $i . "_weight";
			$exerciseRepsString = "user_exercise" . $i . "_reps";
			
			if (isset($_POST[$exerciseWeightString])){
				$exercise_name_query = "SELECT $exerciseNameString FROM followedExercises WHERE username = '$username'";
				$exercise_name_result = mysqli_query($db, $exercise_name_query);
				$exerciseName = mysqli_fetch_assoc($exercise_name_result)[$exerciseNameString];
			
				$exerciseWeight = $_POST[$exerciseWeightString];
				$exerciseReps = $_POST[$exerciseRepsString];
				
				$exerciseUpdateQuery = "UPDATE weightLiftingTracker SET $exerciseNameString = '$exerciseName', $exerciseWeightString = '$exerciseWeight', $exerciseRepsString = '$exerciseReps' WHERE username = '$username' AND weights_date = '$date'";
				$exerciseUpdate = mysqli_query($db, $exerciseUpdateQuery);
			}
		}
	}
}

//add exercise to followedExercises
if (isset($_POST['add_exercise']))
{
	$username = $_SESSION['username'];
	$exercise_name = $_POST['addExercise'];
	
	$query = "SELECT num_exercises FROM followedExercises WHERE username = '$username'";
	$result = mysqli_query($db, $query);

	$fields = mysqli_fetch_assoc($result);
	
	$num_exercises = (int) $fields['num_exercises'];
  
    if ($num_exercises > 15) {
      array_push($errors, "You are already tracking the maximum number of exercises");
    }
	
	$num_exercises_plus_one = $num_exercises + 1;
	$num_ex_as_string = (string)($num_exercises_plus_one);
	
	//format a query string to correspond to the field names in the DB. Ex: "user_exercise7_name"
	$queryString = "user_exercise".$num_ex_as_string."_name";
	
	$query = "UPDATE followedExercises SET $queryString = '$exercise_name', num_exercises = '$num_exercises_plus_one' WHERE username = '$username'";
	$result = mysqli_query($db, $query);

	if (!$result){
		var_dump(mysqli_error($db));
	}
}

//submit diet tracking information
if (isset($_POST['submit_diet_info']))
{
	$date = $_POST['date'];
	
	$calories = $_POST['calories'];
	$weight = $_POST['weight'];
	
	$username = $_SESSION['username'];
	
  	$query = "INSERT INTO dietTracker (username, diet_date, calories_consumed, weight) 
  			  VALUES('$username', '$date', '$calories', '$weight')";
  	$result = mysqli_query($db, $query);
	
	if (!$result){
		var_dump(mysqli_error($db));
	}
}



//add the challenge user has completed in the table
if (isset($_POST['challenge_submission'])) 
{

        $username = $_SESSION['username'];
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
        

        // add challenge submission info to the system
		$query = "INSERT INTO userPoints (username, points ) VALUES ('$username', '$points_granted')";
		$result = mysqli_query($db, $query);
      

      echo "<div style=\"text-align:center\">";
      echo "Added!";
      return;
      
}




if(isset($_POST['submit1']))
{
  

      $search_value=$_POST['search'];
     // $user_check_query = "SELECT * FROM articles WHERE article_ID OR ArticleTitle OR ArticleAuthors OR urls OR Article_Topic1 OR Article_Topic2 OR Article_Topic3 OR Article_Tag1 OR Article_Tag2 OR Article_Tag3OR Article_Tag4 LIKE '%$search_value%'";
    $user_check_query = "SELECT ArticleTitle, urls FROM articles WHERE ArticleAuthors = '$search_value'";
 
     $result = mysqli_query($db, $user_check_query);

	 
          if ($result==null)
          {
            echo "No articles on this topic exists in our directory currently. Please visit again later.";
          }

          else
          {
            echo "Your search results are: <br>";
            while (($row = $result -> fetch_assoc()))
            {
              echo "<div style=\"text-align:center\">";
              echo "{$row['ArticleTitle']}   |   ";
              echo "<a href='{$row['urls']}' target='_new'> {$row['urls']} </a><br>";

            }

          }
            
          return;

}








// wellnessTest
if(isset($_POST['submitData']))
{
  $username = $_SESSION['username'];
  $weight = $_POST['weight'];
  $height = $_POST['height'];
  $height = $height / 100; 
  $sex = $_POST['sex'];
  $age = $_POST['age'];
  $rest_pulse = $_POST['rest_pulse'];
  $Max_heart_rate = $_POST['Max_heart_rate'];
  $Activity_level = $_POST['Activity_level'];
  $Weight_goal = $_POST['Weight_goal'];
  $date = $_POST['date'];

  $BMI = calculateBMI($weight, $height); 

  heartRate ($age, $rest_pulse, $Max_heart_rate); 
  $BMR = calcBMR($sex, $weight, $height, $age);
  recommendDailyCaloryInput($BMR, $Activity_level, $Weight_goal);






  //store info on the database Table userWellnessTest

  $user_check_query = "INSERT INTO userWellnessTest (username, Age, Height_cm, Weight_kg, BMI_calculated, Sex, ActivityLevel, WeightGoal, restingPulse, MaxHeartRate)
   VALUES ('$username', '$age' , '$height', '$weight', '$BMI', '$sex', '$Activity_level', '$Weight_goal', '$rest_pulse', '$Max_heart_rate') ";
 
  $result = mysqli_query($db, $user_check_query);

      echo "<div style=\"text-align:center\">";
      echo "Thanks!"; 
  
      return;
      

}




// https://www.thecalculatorsite.com/articles/health/bmi-formula-for-bmi-calculations.php
//function to calculate BMI
function calculateBMI($weight, $height)
{
  $BMI = $weight / ($height * $height);


 
 echo "<h1><center><b>ASSESSMENT RESULTS </b></center></h1>";

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


?>

