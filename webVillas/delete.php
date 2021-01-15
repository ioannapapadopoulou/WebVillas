<?php
 error_reporting(E_ALL);
 
 require('connect.php');
 try{
	  
	$sql = 'DELETE FROM businesses WHERE businessID= :businessID';
  $statement = $pdoObject->prepare($sql);
  $myResult= $statement->execute([
    ':businessID'=>$_GET['id']
    ]);
  $statement->closeCursor();
  $pdoObject = null;
  if ($myResult==true) {
    header('Location: index.php?msg=Επιτυχής Διαγραφή!');
    exit();
  } else {
    header('Location: index.php?msg=Η διαγραφή δεν πραγματοποιήθηκε!');
    exit();
   }
  } catch (PDOException $e) {
    header('Location: index.php?msg=PDO Exception: '.$e->getMessage());
    exit();
  }
?>