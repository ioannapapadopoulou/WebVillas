<?php
  if (isset($_COOKIE['css']))
    setcookie ('css', '', time()-3600);
  //ανακατευθύνουμε στην αρχική
  header('Location: index.php');
  exit();
 ?>