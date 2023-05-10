<?php
   require_once 'connection.php';
   session_start();
   $id = trim($_GET['id']);
   $update = $bdd->prepare('UPDATE matchclub SET statut = :statut WHERE id_match = :id');
   $update->execute(array(':statut' => 'refus', ':id' => $id));
   $refusReserv = "Reservation refusée avec succés";
   $_SESSION['refusReserv']=$refusReserv;
   header("Location: afficheMatchs.php");