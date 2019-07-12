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

	<?php 
		include 'server.php';
		include 'errors.php';
		
		ini_set("log_errors", 1);
		ini_set("error_log", "dashboardError.log");

		$db = mysqli_connect('localhost', 'root', '', 'wellness');
		
		
		//Charts
		echo '	
		  <script type="text/javascript">
		  window.onload = function () {

			var cardioChart = new CanvasJS.Chart("cardioChart",
			{

			  title:{
				text: "Your Cardio Progression"
			  },
			  axisX:{  
			  },

			  axisY: {
				  	includeZero: false,
					valueFormatString: " ",
					title: "Volume (duration x bpm)",
			  },
			  
			  data: [
			  {        
				type: "line",
				lineThickness: 2,
				dataPoints: [';
				
					$username = $_SESSION['username'];
					$cardioQuery = "SELECT * FROM cardioTracker WHERE username = '$username'";
					$cardioResult = mysqli_query($db, $cardioQuery);
					
					while ($row = mysqli_fetch_assoc($cardioResult)){
						$dateArray = explode("-", $row['cardio_date']);
						$dateString = implode($dateArray);
						
						$cardioMeasure = (int) $row['cardio_minutes'] * (int) $row['cardio_heartrate'];
						
						echo '{ x: new Date(' . substr($dateString,0,4). ',' . substr($dateString,4,2) . ',' . substr($dateString,6,2) . '), y: ' . $cardioMeasure . '},';
					}
			
			echo ']
			  }    
			  ]
			});

			
			var weightChart = new CanvasJS.Chart("weightChart",
			{

			  title:{
				text: "Your Weight Progression"
			  },
			  axisX:{  
			  },

			  axisY: {
				  includeZero: false,
				  title: "weight (kgs)",
				  valueFormatString: "0.0#"
			  },
			  
			  data: [
			  {        
				type: "line",
				lineThickness: 2,
				dataPoints: [';
				
					$username = $_SESSION['username'];
					$weightQuery = "SELECT * FROM dietTracker WHERE username = '$username'";
					$weightResult = mysqli_query($db, $weightQuery);
					
					while ($row = mysqli_fetch_assoc($weightResult)){
						$dateArray = explode("-", $row['diet_date']);
						$dateString = implode($dateArray);
						echo '{ x: new Date(' . substr($dateString,0,4). ',' . substr($dateString,4,2) . ',' . substr($dateString,6,2) . '), y: ' . $row['weight'] . '},';
					}
			
			echo ']
			  }    
			  ]
			});
			
			
			var weightTrainingChart = new CanvasJS.Chart("weightTrainingChart", {
				title: {
					text: "Strength Training Progression"
				},
				axisX: {
				},
				axisY: {
					includeZero: false,
					valueFormatString: " ",
					title: "Volume (weight x reps)",
				},
				toolTip: {
					shared: true
				},
				legend: {
					cursor: "pointer",
					verticalAlign: "top",
					horizontalAlign: "center",
					dockInsidePlotArea: true,
					itemclick: toogleDataSeries
				},';
				
					$num_exercises = getNumExercises($username);
				
					echo 'data: [';	
				
					if ($num_exercises == 0){
						echo '{		
						type:"line",
						axisYType: "primary",
						name: "null",
						showInLegend: true,
						markerSize: 0,
						dataPoints: [';
						
						echo ']
						}]';
					}
					
					//add a line for each exercise
					for ($i = 1; $i <= $num_exercises; $i++){
						$exerciseNameString = "user_exercise" . $i . "_name";
						$exerciseStringWeight = "user_exercise" . $i . "_weight";
						$exerciseStringReps = "user_exercise" . $i . "_reps";
						
						$exercise_name_query = "SELECT $exerciseNameString FROM followedExercises WHERE username = '$username'";
						$exercise_name_result = mysqli_query($db, $exercise_name_query);
						$exerciseName = mysqli_fetch_assoc($exercise_name_result)[$exerciseNameString];

						echo '{		
						type:"line",
						axisYType: "primary",
						name: "' . $exerciseName . '",
						showInLegend: true,
						markerSize: 0,
						dataPoints: [';
							
						$username = $_SESSION['username'];
						$weightLiftingQuery = "SELECT * FROM weightLiftingTracker WHERE username = '$username' AND $exerciseNameString = '$exerciseName'";
						$weightLiftingResult = mysqli_query($db, $weightLiftingQuery);
						
						//add data points for each line
						while ($row = mysqli_fetch_assoc($weightLiftingResult)){
							$dateArray = explode("-", $row['weights_date']);
							$dateString = implode($dateArray);
							
							$exerciseWeight = (int) $row[$exerciseStringWeight];
							$exerciseReps = (int) $row[$exerciseStringReps];
							$exerciseVolume = $exerciseWeight * $exerciseReps;
							
							echo '{ x: new Date(' . substr($dateString,0,4). ',' . substr($dateString,4,2) . ',' . substr($dateString,6,2) . '), y: ' . $exerciseVolume . '},';	
						}
						if ($i != $num_exercises){
							echo ']
								},';
						} else {
							echo ']
								}]';
						}
					}
				
		  echo '});
		  
		  
		  
		  	var dietChart = new CanvasJS.Chart("dietChart",
			{
			  animationEnabled: true,
			  title:{
				text: "Your Diet Breakdown"
			  },
			  data: [
			  {        
				type: "pie",
				startAngle: 240,
				yValueFormatString: "##0.00\"%\"",
				indexLabel: "{label} {y}",
				dataPoints: [';
				
					$username = $_SESSION['username'];
					$dietQuery = "SELECT * FROM dietTracker WHERE username = '$username'";
					$dietResult = mysqli_query($db, $dietQuery);
					
					$totalProtein = 0;
					$totalCarbs = 0;
					$totalFat = 0;
					
					while ($row = mysqli_fetch_assoc($dietResult)){
						$totalProtein += (int)$row['gProteinConsumed'];
						$totalCarbs += (int)$row['gCarbsConsumed'];
						$totalFat += (int)$row['gFatConsumed'];
					}
					
					if ($totalProtein == 0 && $totalFat == 0 && $totalCarbs ==0){
						echo "\r\n{y: 0, label: \"Protein\"},";
						echo "\r\n{y: 0, label: \"Carbs\"},";
						echo "\r\n{y: 0, label: \"Fat\"}";
					} else {
						$percentProtein = ($totalProtein / ($totalProtein + $totalCarbs + $totalFat)) * 100;
						$percentFat = ($totalFat / ($totalProtein + $totalCarbs + $totalFat)) * 100;
						$percentCarbs = ($totalCarbs / ($totalProtein + $totalCarbs + $totalFat)) * 100;
						
						echo "\r\n{y: $percentProtein, label: \"Protein\"},";
						echo "\r\n{y: $percentCarbs, label: \"Carbs\"},";
						echo "\r\n{y: $percentFat, label: \"Fat\"}";
					}
			
			echo ']
			  }    
			  ]
			});
					
			weightChart.render();
			cardioChart.render();
			weightTrainingChart.render();
			dietChart.render();
			caloriesChart.render();
			function toogleDataSeries(e){
				if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else{
				e.dataSeries.visible = true;
			}
				weightChart.render();
				cardioChart.render();
				weightTrainingChart.render();
				dietChart.render();
				caloriesChart.render();
			}
		
		}
		</script>
		  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		</head>
		<body>
		  <div id="weightChart" style="height: 300px; width: 100%;"></div>
		  <div id="cardioChart" style="height: 300px; width: 100%;"></div>
		  <div id="weightTrainingChart" style="height: 300px; width: 100%;"></div>
		  <div id="dietChart" style="height: 300px; width: 100%;"></div>
		</body>';
	?>

  </body>
</html>