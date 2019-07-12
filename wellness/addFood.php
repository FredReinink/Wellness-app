<!DOCTYPE html>

<html>


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



<?php include 'server.php'?>


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
	<div class = "topnav-left">
		 <a href="dietTrack.php">Back</a>
	</div>
  </div>
  
    <br>
	<b><h2><center> Your nutritional information for <?php echo $_SESSION['enteredDate']?> </center></h2></b>
	
	<center>
	<table border="1">
	<tr>
		<th>&nbspTotal Calories&nbsp;</th>
		<th>&nbspGrams of Protein&nbsp;</th>
		<th>&nbspGrams of Fat&nbsp;</th>
		<th>&nbspGrams of Carbs&nbsp;</th>
		<th></th>
	<tr>
	<?php 
	// populates nutritional information table
		echo '<tr>';
		echo '<td>' . $_SESSION['totalCalories'] . '</td>';
		echo '<td>' . $_SESSION['gramsProtein'] . '</td>';
		echo '<td>' . $_SESSION['gramsFat'] . '</td>';
		echo '<td>' . $_SESSION['gramsCarbs'] . '</td>';
		echo '</tr>';
		echo '<table>';
	?>
	</table>
  
    <br>
	<b><h2><center> Add a food item </center></h2></b>
	
	 <form method="post" action = 'addFood.php'>
		<center>
		<div class="input-group">
			<input type="text" style="width: 360px" placeholder="Search.." name="search">
			<button type="submit" style="width: 100px" name="foodSearch">Search</button>
		</div>
		</center>
    </form>
	<br>
  
  <?php
	if (isset($_POST['foodSearch'])){

		$searchValue = $_POST['search'];
		
		$db = mysqli_connect('localhost', 'root', '', 'wellness');
		
		$searchQuery = "SELECT * FROM foodItem WHERE name LIKE '%$searchValue%'";
		$result = mysqli_query($db, $searchQuery);
		
		if (mysqli_num_rows($result) > 0 && $searchValue != ""){
			
			//used to reload the last search
			$_SESSION['persistentSearchValue'] = $searchValue;
			
			
			//generate columns
			echo '	
			<form method = "post">
				<table border="1">
				<tr>
					<th>&nbspName&nbsp;</th>
					<th>&nbspQuantity&nbsp;</th>
					<th>&nbspCalories&nbsp;</th>
					<th>&nbspGrams of Protein&nbsp;</th>
					<th>&nbspGrams of Fat&nbsp;</th>
					<th>&nbspGrams of Carbs&nbsp;</th>
					<th>&nbsp;</th>
				<tr>';
			
			//generate cells
			while ($row = mysqli_fetch_assoc($result)){
				echo '<tr>';
					echo '<td>' . $row['name'] . '</td>';
					echo '<td>' . $row['quantity'] . '</td>';
					echo '<td>' . $row['calories'] . '</td>';
					echo '<td>' . $row['gProtein'] . '</td>';
					echo '<td>' . $row['gFat'] . '</td>';
					echo '<td>' . $row['gCarbs'] . '</td>';
					echo '<td><button type="submit" name= "addFood" value ="' . $row['name'] . '">Add</button></td>';
				echo '</tr>';
			}
			echo '</table></form>';
		} else {
			echo '<center> We don\'t have that food item';
		}
	} else if (isset($_SESSION['persistentSearchValue'])){
			$searchValue = $_SESSION['persistentSearchValue'];
		
			$searchQuery = "SELECT * FROM foodItem WHERE name LIKE '%$searchValue%'";
			$result = mysqli_query($db, $searchQuery);
		
			//generate columns
			echo '	
			<form method = "post">
				<table border="1">
				<tr>
					<th>&nbspName&nbsp;</th>
					<th>&nbspQuantity&nbsp;</th>
					<th>&nbspCalories&nbsp;</th>
					<th>&nbspGrams of Protein&nbsp;</th>
					<th>&nbspGrams of Fat&nbsp;</th>
					<th>&nbspGrams of Carbs&nbsp;</th>
					<th>&nbsp;</th>
				<tr>';
			
			//generate cells
			while ($row = mysqli_fetch_assoc($result)){
				echo '<tr>';
					echo '<td>' . $row['name'] . '</td>';
					echo '<td>' . $row['quantity'] . '</td>';
					echo '<td>' . $row['calories'] . '</td>';
					echo '<td>' . $row['gProtein'] . '</td>';
					echo '<td>' . $row['gFat'] . '</td>';
					echo '<td>' . $row['gCarbs'] . '</td>';
					echo '<td><button type="submit" name= "addFood" value ="' . $row['name'] . '">Add</button></td>';
				echo '</tr>';
			}
			echo '</table></form>';
	}
  ?>
  
  
 </body>
 
       <!-- circle dots -->
  <br>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
</html>