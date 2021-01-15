<?php include('control.php'); 
/*αν ο χρήστης δεν εχει κανει συνδεση στην σελιδα δεν θα εχει προσβαση!*/
   if(empty($_SESSION['username'])) {
	   header('location: login.php');
   }
 ?>
<?php 
  error_reporting(E_ALL);
  include('function.php');
?>
<?php 
require('connect.php');
   $sql="SELECT title,adress,phone FROM businesses ORDER BY businessID DESC LIMIT 6";
   $statement= $pdoObject->prepare($sql);
   $statement->execute();
   $villas= $statement->fetchAll();
?>
<?php
  function getCSS() {
    if (!isset($_COOKIE['css'])  )
      $css='file.css';
    else
      $css= $_COOKIE['css'];
    return $css;
  }
?>

<!DOCTYPE html> 
<html lang="en" dir="ltr">
<head>
  <title>Home-page</title>
 <script src="https://kit.fontawesome.com/a076d05399.js"></script>
 <link href="<?php echo getCSS(); ?>" rel="stylesheet" type="text/css" />
</head>
<body >
 <div class="per">
    <?php if(isset($_SESSION['success'])): ?>
	   <div class="er">
	    <h3>
		  <?php 
		   echo $_SESSION['success'];
			 unset($_SESSION['success']);
		  ?>
	    </h3>
    </div>
    </div>
    <?php endif ?>
    <div id="container01" style="text-align:right;">
    <h5 class="center"><i class="fas fa-cookie-bite"></i>Επιλογή Cookie!</h5>
    <p class="center">
     <a href="store_css.php?style=1"><i class="fas fa-check-square"></i>Επιλογή 1</a> - 
     <a href="store_css.php?style=2"><i class="fas fa-check-square"></i>Επιλογή 2</a> -
     <a href="clear_cookie.php">Καθαρισμός Cookie</a>
    </p>
    </div>
    <input type="checkbox" id="check">
    <label for="check">
       <i class="fas fa-bars" id="btn"></i>
       <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>Μενού</header>
      <ul>
        <li><a href="index.php"><i class="fas fa-home"></i>Καταχωρημένες Villas</a></li>
        <li><a href="pageform.php?mode=insert"><i class="fas fa-link"></i>Προσθήκη νέας Villas</a></li>
        <li><a href="#"><i class="fas fa-calendar-week"></i>Ημερολόγιο</a></li>
        <li><a href="#"><i class="fas fa-phone-square"></i>Τηλέφωνο επικοινωνίας</a></li>
        <li><a href="#"><i class="fas fa-question-circle"></i>Ερωτήσεις</a></li>
        <li><a href="sample.html?logout"><i class="fas fa-sign-out-alt"></i>Αποσύνδεση</a></li>
      </ul>
    </div>
    <?php foreach($villas as $row): ?>
    <section>
   <div class="wrap">
    <div class="card">
      <img src="images/card.jpg" alt="villa" style="width: 100%">
      <div class="container">
       <h5 class="card-title"><?= $row["title"] ?></p>
       <p class="card-adress"><i class="fas fa-map-marker-alt"></i>Διεύθυνση:<?= $row["adress"] ?></p>
       <p class="card-phone"><i class="fas fa-phone-square"></i>Τηλέφωνο Επικοινωνίας:<?= $row["phone"] ?></p>
       <a href="pageform.php?mode=update"><class="badge badge-success">Edit</a>
       <a href="delete.php?id='.$record['businessID'].'"onclick="return verify();"><class="badge badge-danger">Delete</a>
      </div>
    </div>
   </div>
    </section>
   <?php endforeach; ?>
  <section>
   <footer id="footer" >
     <div id="leftfooter">&copy;<strong> Ioanna Papadopoulou</strong></div>
    </footer>
   </section>
</body>
</html>
