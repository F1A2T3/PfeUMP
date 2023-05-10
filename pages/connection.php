<?php 

$servername="localhost";
$username="root";
$password="";
$dbname="test";

//la connexion a la base de donnee 
$bdd=new PDO('mysql:host=localhost;dbname=test','root','');
$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>