<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(isset($_POST['ok'])) // Si il existe les champs email, password et qu'il sont pas vident
    {
        // Patch XSS
        $CIN = htmlspecialchars($_POST['CIN']); 
        $password = htmlspecialchars($_POST['password']);
        $sql="SELECT * FROM user WHERE CIN='$CIN' AND password='$password'";
        $reponse=$bdd->query($sql);
        if($reponse->rowCount()>0){
            header("Location: Page2.php");
        }
        else{
            echo 
            "<script>
               document.getElementById('error').style.display='block';
               document.getElementById('error').style.color='red';
               </script>";
        }
    $reponse->closeCursor();}
       