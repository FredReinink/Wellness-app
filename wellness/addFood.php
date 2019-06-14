<!DOCTYPE html>


<html>
<?php include 'server.php'?>


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
  

  
    <!-- circle dots -->
  <br>
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
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
	<br>
	
	 <form method="post" action = 'addFood.php'>
		<center>
		<div class="input-group">
			<input type="text" placeholder="Search.." name="search">
		</div>
		<div class="input-group">
			<button type="submit" name="foodSearch">Search</button>
		</div>
		</center>
    </form>
  
  <?php
	if (isset($_POST['foodSearch'])){
		


		$search_value = $_POST['search'];
  
		$db = mysqli_connect('localhost', 'root', '', 'wellness');
		
		$searchQuery = "SELECT * FROM foodItem WHERE name LIKE '%$search_value%'";
		$result = mysqli_query($db, $searchQuery);
		
		if (mysqli_num_rows($result) > 0){
			
			//generate columns
			echo '	
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
					echo '<td><button type="submit" formaction = \'addFood.php\' name= "add" value =' . $search_value . '">Add</button></td>';
				echo '</tr>';
			}
			echo '</table>';
		} else {
			echo '<center> We don\'t have that food item';
		}
	}
  ?>
  
  
 </body>
</html>