<?php
// Connexion à la base de données
require_once 'connection.php';
include 'sidebar.php';
// Récupération de l'ID de l'utilisateur
$equipeName = trim($_GET['equipe']);
$requete = "DELETE FROM equipe WHERE Nom_equipe = ?";
$reponse = $bdd->prepare($requete);
$reponse->execute([$equipeName]);
$msg_suppE = "Membre supprimé";
$_SESSION['msg_suppE']=$msg_suppE;
header("Location: equipe.php");
exit();
