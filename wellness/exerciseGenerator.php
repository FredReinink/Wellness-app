<?php
//this class creates input fields in fitnessTrack for each exercise the user has added

//initialize error log
ini_set("log_errors", 1);
ini_set("error_log", "exerciseGeneratorError.log");
	
$db = mysqli_connect('localhost', 'root', '', 'wellness');
$username = $_SESSION['username'];

$num_exercises = getNumExercises($username);

//Query to get the names of the exercises the user currently tracks
$exerciseQuery = "SELECT user_exercise1_name, user_exercise2_name,user_exercise3_name,user_exercise4_name,user_exercise5_name,user_exercise6_name,user_exercise7_name,user_exercise8_name,user_exercise9_name,user_exercise10_name,user_exercise11_name,user_exercise12_name,user_exercise13_name,user_exercise14_name,user_exercise15_name FROM followedExercises WHERE username = '$username'";
$exercises = mysqli_query($db, $exerciseQuery);
$exercises_as_array = mysqli_fetch_assoc($exercises);

if ($num_exercises > 0){
	echo '<br><b>Enter strength training information</b>';
}

for ($i = 1; $i <= $num_exercises; $i++){
	$exerciseStringName = "user_exercise" . $i . "_name";
	$exerciseStringWeight = "user_exercise" . $i . "_weight";
	$exerciseStringReps = "user_exercise" . $i . "_reps";
	echo '<br>
	<div class="input-group">
		 <label>'. $exercises_as_array[$exerciseStringName] .' Weight (kg)</label>
		 <input type="number" maxlength = "3" style="width: 80px;" name="' . $exerciseStringWeight . '">
	</div>';
	echo '
	<div class="input-group">
		 <label>'. $exercises_as_array[$exerciseStringName] .' Reps</label>
		 <input type="number" maxlength = "3" style="width: 80px;" name="' . $exerciseStringReps . '">
	</div>';
}
?>