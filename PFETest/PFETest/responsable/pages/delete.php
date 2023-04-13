<?php 
include 'connection.php';

if (isset($_GET['CIN'])) {
    $CIN = $_GET['CIN'];
    $requete = "DELETE FROM user WHERE CIN=:CIN";
    $statement = $bdd->prepare($requete);
    $statement->execute(array(':CIN' => $CIN));
}

header('location:afficherUSER.php');
exit;
?>
