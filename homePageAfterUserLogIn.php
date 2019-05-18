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
      <a href="afterYserLogIn.php">Dashboard</a>
      <a href="wellnessTest.php">Wellness Test</a>
      <a href="challenge.php">Monthly Challenge</a>
      <a href="newsfeed.php">Newsfeed</a>
      <a href="findFriends.php">Find Friends</a>
      <a href="fitnessTrack.php">Fitness Tracking</a>
      <a href="dietTrack.php">Diet Tracking</a>
      <a href="login.php">Sign-out</a>
    </div>
  </div>


  <!-- images are all mine --> 
  <!-- Slide Show -->
  <br>
  <center>
        <div class="mySlides">
          <img id="source" src="img1.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img2.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img3.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img4.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img5.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img6.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img7.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img8.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img9.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img10.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img11.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img12.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img13.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img14.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img15.jpg" width="60%" height="30%">
        </div>

        <div class="mySlides">
          <img id="source" src="img16.jpg" width="60%" height="30%">
        </div>

  </center>
  

  <p>
  <!-- circle dots -->
  <div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  </p>
  

  <!--Welcome Greeting Message --> 
  <center>
  <h2 style="text-shadow:1px 1px 0 #444">Welcome!</h2>
  <br> Add Description Here 
  </center> 
  
 
  


  <!--Javascript for automatic slide show --> 
  <!--Automatic Slideshow - change image every 3 seconds -->
  <script>
      var slideIndex = 0;
      displaySlides();

      function displaySlides() 
      {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        
        for (i = 0; i < slides.length; i++) 
        {
          slides[i].style.display = "none";  
        }
        
        slideIndex++;
        if (slideIndex > slides.length) 
        {
          slideIndex = 1  
        }    
        
        slides[slideIndex-1].style.display = "block";  
        setTimeout(displaySlides, 3000); 
      }
  </script>

</body>
</html>

