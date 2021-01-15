<?php include('control.php'); ?>

<!DOCTYPE html>
<html>
<head>

   <title>Project2020</title>
   <link rel="stylesheet" type="text/css" href="file.css">
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   
</head>
<body style="background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('images/img.png');background-size: cover;background-position: center; height: 150vh;">
   <div class="header">
     <h2>Sign up!</h2>
   <div>
   
   <form method="post" action="register.php">
   
       <?php include('errors.php'); ?>
	   <div class="input-team">
	      <label><strong>Username</strong></label>
		  <input type="text" name="username" placeholder="example123" >
      </div>
	  <div class="input-team">
	      <label><strong>Email</strong></label>
		  <input type="text" name="email" placeholder="example@.com">
      </div>
	  <div class="input-team">
	      <label><strong>Password</strong></label>
		  <input type="password" name="pass1" placeholder="********">
	  </div>
      <div class="input-team">
	      <label><strong>Confirm Password</strong></label>
		  <input type="password" name="pass2" placeholder="********">
	  </div>
	
	   <div class="g-recaptcha" data-sitekey="6LfPgvgUAAAAAEQSE6x_tZV3J4uOzX133aInA88f"></div>
   
	  <div class="input-team">
	    <button type="submite" name="register" class="btn">Register</button>
	  </div>
	
       
	  <p><strong> Είσαι ήδη χρήστης;</strong><a href="login.php">sign in</a></p>
	</form>
	
	<footer id="footer" >
     <div id="leftfooter">&copy;<strong> Ioanna Papadopoulou</strong></div>
    </footer>
</body>
</html>