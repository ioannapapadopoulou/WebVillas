<?php 
error_reporting(E_ALL);
require('control.php');
require('function.php');
if ( isset($_GET['mode'], $_GET['id'] ) && $_GET['mode']=='update'  ) {
  $mode='update';   // ΠΕΡΙΠΤΩΣΗ UPDATE
}elseif ( isset($_GET['mode'] ) &&  $_GET['mode']=='insert' ) {
    $mode='insert';   // ΠΕΡΙΠΤΩΣΗ INSERT
} else {
    header('Location: index.php?msg=Μη προβλεπόμενη κλήση σε σελίδα!');
    exit();
 }
  
 if ( $mode=='insert' ) {
	   $titlos='Εισαγωγή';
     $businessID='';
	   $title='';
	   $phone='';
	   $adress='';
	   $nomoi=-1;
  }
  if ( $mode=='update' ) {
    $titlos='Μεταβολή';
    $businessID= $_GET['id'];  

    try {
	    $sql = "SELECT * FROM businesses WHERE businessID=:businessID";
      $statement = $pdoObject -> prepare($sql);
      $statement->execute([
        ':businessID'=>$businessID ]);
      if ($record = $statement -> fetch()) { 
        $record_exists=true;
		    $businessID=$record['businessID'];
		    $title=$record['title'];
		    $phone=$record['phone'];
		    $adress=$record['adress'];
		    $nomoi=$record['nomoi'];
    } else $record_exists=false; 
     $statement->closeCursor();
     $pdoObject = null;
    } catch (PDOException $e) {
        header('Location: index.php?msg=Connection failed:'.$e->getMessage());
        exit();
    }
	 if (!$record_exists) {
      header('Location: index.php?msg=Record does not exist.');
      exit();
    }
  }
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
<html>
<head>
  <title>Project2020</title>
  <link href="<?php echo getCSS(); ?>" rel="stylesheet" type="text/css" />
</head>
<body style="background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('images/img.png');background-size: cover;background-position: center; height: 150vh;">
<?php
/*for upload photo..*/
include('connect.php');
if(isset($_POST['submit'])){
  $folder ="uploads/"; 
  $image = $_FILES['image']['name'];
  $description= $_POST['description'];
  $path = $folder . $image ; 
  $target_file=$folder.basename($_FILES["image"]["name"]);
  $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
  $allowed=array('jpg'); //τυπος εικόνας
  $filename=$_FILES['image']['name']; 
  $max_size_photo= 500; //KB-Μεγευος εικονας
  $ext=pathinfo($filename, PATHINFO_EXTENSION);
  if(!in_array($ext,$allowed,$max_size_photo) ){
      echo "Επιτρέπονται μονο jpg εικόνες";
  }else{
    try{
    move_uploaded_file( $_FILES['image'] ['tmp_name'], $path); 
    $sth=$pdoObject->prepare("INSERT  INTO filestore(filename,description) VALUES (:image,:description)"); 
    $sth->bindParam(':image',$image);
    $sth->bindParam(':description',$description);
    $sth->execute();  
  }catch (PDOException $e) {
    header('Location: index.php?msg=Connection failed:'.$e->getMessage());
    exit();
  }
 } 
}
?>
   <div class="header">
     <h2> <?php echo $titlos; ?></h2>
   <div>
  <div id="container" >

   <form method="post" action="dualform.php" enctype="multipart/form-data" >
   <?php
     
     if ($_GET['mode'] == 'update') { ?>

       <p>Κωδικός: <input name="businessID" value="<?php echo $businessID; ?>" readonly="readonly" /></p>

   <?php
     
    } ?>
	 <p><Strong>Όνομα:</strong>
	 <input type="text" name="title" value="<?php echo $title; ?>"> </p>
	 
    <p><Strong>Τηλέφωνο:</strong>
	 <input type="text" name="phone" value="<?php echo $phone; ?>"> </p>
	 
	 <p><Strong>Διεύθυνση:</strong>
	 <input type="text" name="adress" value="<?php echo $adress; ?>"> </p>
	 
   <p><strong>Νομός:</strong>
      <select name="nomoi">
        <?php load_options('county', $nomoi) ?>
    </p>
    <input type="file" name="image" />
    <textarea name="description" cols="40" rows="4" placeholder="Περιέγραψε αυτήν την εικόνα..."></textarea>
    <input type="submit" value="Υποβολή" name="submit">
  </form>
	 <p class="right"><a href="index.php">Αρχική Σελίδα</a></p>
	
	 <footer id="footer">
      <div id="leftfooter">&copy;<strong>Ioanna Papadopoulou</strong></div>
    </footer>
</div>
</body>
</html>