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
 
  




  <style> 
    body {
	width: 100wh;
	height: 90vh;
	color: #000000;
	background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 15s ease infinite;
}

@-webkit-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@-moz-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

h1,
h6 {
	font-family: 'Open Sans';
	font-weight: 300;
	text-align: center;
	position: absolute;
	top: 45%;
	right: 0;
	left: 0;
}
</style>






























<!-- for ref 
https://www.w3schools.com/howto/howto_js_form_steps.asp
https://my.clevelandclinic.org/health/diagnostics/17402-pulse--heart-rate/test-details
https://www.webmd.com/diet/body-bmi-calculator
-->


<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
    
  }

  body 
  {
    background-color: #f1f1f1;
  }

#regForm 
{
  background-color: #bfb7c9;
  margin: 80px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 
{
  text-align: center;  
}

input 
{
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid 
{
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab 
{
  display: none;
}

button {
  background-color: #5e005b;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover 
{
  opacity: 0.8;
}

#prevBtn 
{
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step 
{
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active
 {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish
 {
  background-color: #5e005b;
}
</style>




















<body>
<?php include('server.php') ?>

<form id="regForm" action="wellnessTest.php" method= "post">
  
  <?php include('errors.php'); ?>

 
  <!-- One "tab" for each step in the form: -->
  <div class="tab"><b>WELLNESS TEST | General</b>
    <p><input placeholder="Weight (kg)..." oninput="this.className = ''" name="weight"></p>
    <p><input placeholder="Height (cm)..." oninput="this.className = ''" name="height"></p>
    <p><input placeholder="Sex (Enter F/M)..." oninput="this.className = ''" name="sex"></p>
    <p><input placeholder="Age..." oninput="this.className = ''" name="age"></p>
  </div>


  <div class="tab"><b>WELLNESS TEST | Heart Rate</b>
    <p><input placeholder="Resting pulse..." oninput="this.className = ''" name="rest_pulse"></p>
    <p><input placeholder="Max heart rate..." oninput="this.className = ''" name="Max_heart_rate"></p>
  </div>


  <div class="tab"><b>WELLNESS TEST | Activity </b>
    <br><b>Choose from following activity level: </b>
    <br>1 - Not active: A desk job and little or no regular exercise
    <br>2 - Lightly active: 1-3 days/week of light exercise
    <br>3 - Moderately active: 3-5 days/week of moderate exercise
    <br>4 - Very active: 6-7 days/week of strenuous exercise
    <br>5 - Extremely active: A physically demanding job, and daily strenuous exercise
    <br>
    <br><b>Choose from following weight goal:</b>
    <br>1 - Lose
    <br>2 - Stay the same
    <br>3 - Gain
    <p><input placeholder="Activity Level..." oninput="this.className = ''" name="Activity_level"></p>
    <p><input placeholder="Weight Goal" oninput="this.className = ''" name="Weight_goal"></p>
  </div>
  

  <center>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>

      <br>
      <br><b>Upon completing the test, select the date and submit. </b>
      <p><input placeholder = "date enter..." type= "date" name="date" required></p>

      <button type="submit" class="btn" name = "submitData" >Submit</button>
    </div>
  </div>
  </center>



  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>














<!-- some JavaScript --> 
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n)
 {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) 
  {
    document.getElementById("prevBtn").style.display = "none";
  } 
  
  else 
  {
    document.getElementById("prevBtn").style.display = "inline";
  }

  if (n == (x.length - 1)) 
  {
    document.getElementById("nextBtn").style.display = "none";
  } 
  
  else
  {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) 
{
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");

  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) 
  {
    // ... the form gets submitted:
    //document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() 
{
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) 
  {
    // If a field is empty...
    if (y[i].value == "") 
    {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) 
  {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}


function fixStepIndicator(n) 
{
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++)
  {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

</script>


</body>
</html>

