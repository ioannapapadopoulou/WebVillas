<?php
 
  function echo_msg() {
    if (isset($_GET['msg']))
      echo '<p style="color:red; text-align:center;">'.$_GET['msg'].'</p>';
  }
  
  function load_options($table,$selected) {
	  if($selected == -1)
		  $extra_attribute='selected="selected"';
    else $extra_attribute='';
	  echo '<option value="-1" '.$extra_attribute.'>--επέλεξε--</option>';
	  
	  try{
		  require('connect.php');
		  $sql = "SELECT * FROM $table";
      $statement = $pdoObject->prepare($sql);
      $statement->execute([
        ':title'=>$title,
        ':businessID'=>$businessID,
        ':phone'=>$phone,
        ':adress'=>$adress,
        ':nomoi' => $nomoi,
        ':names' =>$names
      ]);  
        
     while ( $record = $statement->fetch() ) {
        if ($record[0]==$selected)      
          $extra_attribute='selected="selected"';
        else $extra_attribute='';
        echo '<option value="'.$record[0].'" '.$extra_attribute.'>'.$record[1].'</option>';
	}
	$statement->closeCursor();
  $pdoObject=null;
} catch (PDOException $e) {   //block για exception handling
      header('Location: index.php?msg=Πρόβλημα στις Κατηγορίες: '. $e->getMessage());
      exit();
  } 
}
  
  
 
  
?>