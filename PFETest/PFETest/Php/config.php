<?php
    try 
    {
        $bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
        echo "Connected";
    }
    catch(PDOException $e)
    {
        die('Erreur HOOOOOO: '.$e->getMessage());
    }
    ?>