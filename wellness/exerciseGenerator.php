<?php
//this class creates input fields in fitnessTrack for each exercise the user has added

//initialize error log
ini_set("log_errors", 1);
ini_set("error_log", "exerciseGeneratorError.log");
	
$db = mysqli_connect('localhost', 'root', '', 'wellness');
$username = $_SESSION['username'];

//Query to get the number of exercises the user currently tracks
$num_exercises_query = "SELECT num_exercises FROM followedExercises WHERE username = '$username'";
$num_exercises = mysqli_query($db, $num_exercises_query);
$num_exercises_as_array = mysqli_fetch_assoc($num_exercises);

//Query to get the names of the exercises the user currently tracks
$exerciseQuery = "SELECT user_exercise1_name, user_exercise2_name,user_exercise3_name,user_exercise4_name,user_exercise5_name,user_exercise6_name,user_exercise7_name,user_exercise8_name,user_exercise9_name,user_exercise10_name,user_exercise11_name,user_exercise12_name,user_exercise13_name,user_exercise14_name,user_exercise15_name FROM followedExercises WHERE username = '$username'";
$exercises = mysqli_query($db, $exerciseQuery);
$exercises_as_array = mysqli_fetch_assoc($exercises);

for ($i = 1; $i <= (int)$num_exercises_as_array['num_exercises']; $i++){
	$exerciseStringName = "user_exercise" . $i . "_name";
	$exerciseStringWeight = "user_exercise" . $i . "_weight";
	$exerciseStringReps = "user_exercise" . $i . "_reps";
	echo '
	<div class="input-group">
		 <label>'. $exercises_as_array[$exerciseStringName] .' Weight</label>
		 <input type="text" name="' . $exerciseStringWeight . '">
	</div>';
	echo '
	<div class="input-group">
		 <label>'. $exercises_as_array[$exerciseStringName] .' Reps</label>
		 <input type="text" name="' . $exerciseStringReps . '">
	</div>';
}
?>