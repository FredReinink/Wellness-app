<!DOCTYPE html>

<html>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">


  <style>
       .w3-sidebar a {font-family: "Roboto", sans-serif}
        body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>

  
  
  
  <head>
  
    <title> Wellness </title> 
  
  </head> 
  
  

  <body> 
  <!-- add a logo --> 
  <div class = "logo"><a href = "homePage.php"><img src = "logo.png" style="width:20%"></a>
  </div>
  
  <!-- Navigation -->
  <div class="topnav">
    <div class="topnav-right">
      <a href="homePage.php">Home</a>
      <a href="login.php">User Sign-In</a>
      <a href="adminLogIn.php">Admin Sign-In</a>
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


  <!--Welcome Greeting Message --> 
  <center>
  <h2 style="text-shadow:1px 1px 0 #444">WELL, Committed to Improving Your Health</h2>
  </center>

  

  <!--Sign-in Button--> 
  <button class="block"  onclick="location.href='login.php'">Sign-In</button>


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


<!-- Footer -->
<footer class="w3-padding-64 w3-light-grey w3-small w3-center" id="footer">
    <div class="w3-row-padding">
      <div class="w3-col s6">
        <h2><b>Contact Us</b></h2>
        Questions? Go ahead.
        <form action="/action_page.php" target="_blank">
          <p><input class="w3-input w3-border" type="text" placeholder="Name" name="Name" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Subject" name="Subject" required></p>
          <p><input class="w3-input w3-border" type="text" placeholder="Message" name="Message" required></p>
          <button type="submit" class="w3-button w3-block w3-black">Send</button>
        </form>
      </div>
    
    
    <div class="w3-col s6 w3-center">
    <div class="w3-container w3-lobster">
    <center> <br><br><br><br><br> <h2> Move and bring <b>Wellness</b> into your lifestyle everywhere and anytime. Keep track of your improvements and get support from experts. Enter into <b>mywellness!</b> </h2> 
    <br><br><p class="w3-xlarge"><b>Stay Healthy, Stay Fit, Stay WELL!</b></p></center>
    </div>

    </div>

       
  </footer>

  <div class="w3-black w3-center w3-padding-24">Powered by Well</div>

  <!-- End page content -->
</div>


</body>
</html>

