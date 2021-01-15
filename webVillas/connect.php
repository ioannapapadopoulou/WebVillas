<?php
$host='localhost';
$user='root';
$passWord='';
$dbname='webvillas';

$conn= "mysql:host=$host;dbname=$dbname";
//Ενεργοποίηση PDO
try{
      $pdoObject=new PDO($conn,$user,$passWord);
      $pdoObject -> exec('set names utf8');
} catch (PDOException $e) {
      echo 'Connection failed: '.$e->getMessage();
    }
?>