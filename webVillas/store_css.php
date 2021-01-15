<?php
  if ( !isset($_GET['style']) ) {
    header('Location: index.php');
    exit();
  }
  switch ($_GET['style']) {  
    case '1':
      $style = 'file.css';
      break;  
    case '2':
      $style = 'file2.css';
      break;  
    default:
      $style = 'file.css';
  } 
  if (isset($_COOKIE['css']))
    setcookie('css', '', time()-3600);

  $expire= time()+ 120*24*60*60;
  setcookie('css', $style, $expire);
  header('Location: index.php');
  exit();
 ?>