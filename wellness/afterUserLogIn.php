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
  <div class = "logo"><a href = "homePageAfterUserLogIn.php"><img src = "logo.png" style="width:20%"></a>
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
	?>

	
	
	<?php 
		ini_set("log_errors", 1);
		ini_set("error_log", "dashboardError.log");

		$db = mysqli_connect('localhost', 'root', '', 'wellness');
		
		
		//Cardio and weight progression charts
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
				  	title: "HeartRate * Minutes",
					valueFormatString: "0.0#"
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
				  title: "weight (lbs)",
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

		cardioChart.render();
		weightChart.render();
		}
		</script>
		  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		</head>
		<body>
		  <div id="weightChart" style="height: 300px; width: 100%;"></div>
		  <div id="cardioChart" style="height: 300px; width: 100%;"></div>
		</body>';
	
	?>











   



  </body>
</html>