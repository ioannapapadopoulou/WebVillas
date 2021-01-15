<?php 
session_start();
 
  
include('connect.php'); 

$errors= array();      
   //Eλεγχοι/Εαν καποιος εχει κλικαρει το κουμπι sign up
if(isset($_POST['register'])) {

	$username= $_POST['username'];
	$email= $_POST['email'];   
	$pass1= $_POST['pass1'];
	$pass2= $_POST['pass2'];
	   //Ελεχος για το αν εχουν συμπληρωθει ολα τα κενα!!
	if (empty($username)){
		   array_push($errors,"Απαιτείται το username!"); //''προσθετουμε'' error στον errors array 
	} 
	else{
		try{
			$query="SELECT username FROM users WHERE username = :username";
			$statement = $pdoObject->prepare($query);
			$statement->execute([
				':username' => $username
		   ]);
		   
		   if($statement->rowCount() > 0) {
			array_push($errors,"Το username υπάρχει ήδη!");
		   }
		} catch (PDOException $e) {
     
			echo 'PDO Exception: '.$e->getMessage();
			
		 }
	}
	   
	if (empty($email)){
		array_push($errors,"Απαιτείται το email!");
	}
	else{
		try{
			$query2="SELECT emailUser FROM users WHERE emailUser = :email";
			$control = $pdoObject->prepare($query2);
			$control->execute([
			':emailUser' => $email
		   ]);
		  
		   if($control->rowCount() > 0) {
			array_push($errors,"Το email υπάρχει ήδη!");
		   }

		} catch (PDOException $e) {
     
			echo 'PDO Exception: '.$e->getMessage();
			
		  }
	} 

	if (empty($pass1)){
		array_push($errors,"Απαιτείται το password!");
	 }
	if ($pass1 != $pass2) {
		array_push($errors,"Τα 2 passwords δεν ταιριαζουν!");
      }
	
	if(!preg_match("/_[a-zA-z0-9]/",$pass1) && strlen($pass1)<8){
		array_push($errors,"Απαιτείται το μήκος του κωδικού να ειναι τουλάχιστον 8 και να περιέχονται κεφαλαια ή πεζα ή αριθμοι!");
	  
	}
	 //reCAPTCHA box!!!!
	 $secretKey="6LfPgvgUAAAAAGkH-p7zsIl-TyGLFo35T2LDDmnu";
	 $responseKey= $_POST['g-recaptcha-response'];
	 $userIP= $_SERVER['REMOTE_ADDR'];
	 $url= "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
	  
	 $response = file_get_contents($url);
	 $response =  json_decode($response);
	  
	 if($response->success) {
		 
		  header('location: login.php');
	 }
	 else {
		array_push($errors,"Please check the reCAPTCHA box!");
	 }
	  
	try{
	      //Εαν ολα πηγαν καλα!
	     if (count($errors) == 0) {
		   $hashed="454545154yftfytg".$pass1."ygygbftf";
		   $password3= hash('sha512', $hashed);
		   $sql= "INSERT INTO users (username, emailUser, password) VALUES ( :username, :email, :password3)";
		   $statement=$pdoObject->prepare($sql);
		   $statement->execute([
			':username' => $username,
			':email' => $email,
			':password3' => $password3,
		   ]);
		   
		   if($statement->rowCount()==1){
		     $_SESSION['username']= $username;
		     $_SESSION['success']= "Είσαι συνδεδεμένος!";
			 header('location: login.php');
		   }else{
			 array_push($errors, "Δεν υπάρχει χρήστης με αυτό το όνομα!");
		   }
		 		  
        }	  
   } catch (PDOException $e) {
	  echo 'PDO Exception: '.$e->getMessage();
	
  }
}
   
   //Validation log in
if (isset($_POST['login'])) {
	$username= $_POST['username'];   
	$password3= $_POST['password3'];
	   
	if (empty($username)){
	    array_push($errors,"Απαιτείται το username!");  
	}
	   
	if (empty($password3)){
		array_push($errors,"Απαιτείται το password!");
	}
	try{

	  if(count($errors) == 0){
		   $hashed="454545154yftfytg".$password3."ygygbftf";
		   $password3= hash('sha512', $hashed);
		   $query3="SELECT * FROM users WHERE username= :username AND password= :password3";
		   $result=$pdoObject->prepare($query3);
		   $result->execute([
			':username' => $username,
			':password3' => $password3
		   ]);
		   if($result->rowCount() ==1){
			   //log user in
		       $_SESSION['username']= $username;
		       header('location: index.php');
		    }else{
			   array_push($errors, "Δεν υπάρχει χρήστης με αυτό το όνομα!");
			   
		}
			   
	   }
	}catch (PDOException $e) {
     
		echo 'PDO Exception: '.$e->getMessage();
		
	  }
	}

   //Validation log out
   if(isset($_GET['logout'])) {
	   session_destroy();
	   unset($_SESSION['username']);
	   header('location: login.php');
   }
   

?>	   
	   
		   


