<?php
error_reporting(E_ALL);

  
if(isset($_POST['businessID']))
	$mode='update';
else $mode='insert';
  
if ($mode=='update') { 
    //αν δεν έχει οριστεί κάτι από τα ακόλουθα έχουμε πρόβλημα
  if ( !isset($_POST['businessID'], $_POST['title'], $_POST['phone'],$_POST['adress'],$_POST['nomoi'] )) { 
    header('Location: index.php?msg=ERROR: missing data (trying update)');
    exit(); 
    }  
  }  
//Σε περίπτωση εισαγωγής
if($mode=='insert'){
	  if ( !isset($_POST['title'], $_POST['adress'],$_POST['phone'],$_POST['nomoi'] )) { 
      header('Location: index.php?msg=ERROR: missing data (trying insert)');
      exit();
    }  
  }
  if ($_POST['nomoi']=='-1') {     
    header('Location: index.php?msg=ERROR: invalid categoryID (-1)');
    exit();
  }
  
  $title = trim($_POST['title']);
  if ( $title =='' ) {
    header('Location: index.php?msg=ERROR: invalid businessTitle (empty string)');
    exit();
  }
  //telos elegxwn
  $myResult=false;
  
  require('connect.php');
  try{    
		if($mode=='insert'){
			$sql='INSERT INTO businesses (businessID,title,adress,phone,nomoi)
			      VALUES (:businessID,:title,:adress,:phone,:nomoi)';
			$statement=$pdoObject->prepare($sql);
			$myResult=$statement->execute ([ 
      ':businessID'=>$_POST['businessID'],
			':title'=>$_POST['title'],
			':adress'=>$_POST['adress'],
			':phone'=>$_POST['phone'],
      ':nomoi'=>$_POST['nomoi']
    ]);
  }
		
		//update
		if($mode=='update') {
			
			$sql='UPDATE businesses
			      SET  title=:title,adress=:adress,phone=:phone
				    WHERE businessID=:businessID';
			$statement=$pdoObject->prepare($sql);
			$myResult=$statement->execute ([
        ':businessID'=>$_POST['businessID'],
			  ':title'=>$_POST['title'],
			  ':adress'=>$_POST['adress'],
			  ':phone'=>$_POST['phone'],
        ':nomoi'=>$_POST['nomoi']
        ]);
		}
		$statement->closeCursor();
    $pdoObject = null;
} catch (PDOException $e) {
       header('Location: index.php?msg=PDO Exception: '.$e->getMessage());
       exit();
}
if ( !$myResult ) { 
    header('Location: index.php?msg=ERROR: failed to execute sql query');
    exit();
}else{  
    header('Location: index.php?msg=ALL well done!');
    exit();
  }
  
													  
?>
