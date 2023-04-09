<?php 

$servername="localhost";
$username="root";
$password="";
$dbname="test";

//la connexion a la base de donnee 
$connection=new PDO('mysql:host=localhost;dbname=test','root','');
$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>