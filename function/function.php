<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('display_startup_errors',1);


$user='root';
$pass='';
$pdo=new PDO("mysql:host=localhost;dbname=customer",$user,$pass);
if(!$pdo){
echo "Not Connected";
}




?>