<?php include('control.php'); ?>
<!DOCTYPE html>
<html>
<head>
   <title>Project2020</title>
   <link rel="stylesheet" type="text/css" href="file.css">
</head>
<body style="background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('images/img.png');background-size: cover;background-position: center; height: 150vh;">
   <div class="header">
     <h2>Sign in!</h2>
   <div>
   <form method="post" action="login.php">
    <?php include('errors.php'); ?>
	  <div class="input-team">
	    <label><strong>Username</strong></label>
		<input type="text" name="username">
      </div>
	  <div class="input-team">
	    <label><strong>Password</strong></label>
		<input type="password" name="password3">
	  </div>
	  <div class="input-team">
	    <button type="submite" name="login" class="btn">Sign in</button>
	  </div>
	  <p><strong>Δεν έχεις κάνει εγγραφή;</strong> <a href="register.php">sign up</a></p>
	</form>
	<footer id="footer" >
     <div id="leftfooter">&copy;<strong> Ioanna Papadopoulou</strong></div>
    </footer>
</body>
</html>