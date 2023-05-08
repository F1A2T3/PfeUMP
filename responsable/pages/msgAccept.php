<?php
   require_once 'connection.php';
   session_start();
   $id = trim($_GET['id']);
   $check = $bdd->prepare('SELECT * FROM matchclub WHERE id_match = :id');
   $check->execute(array(':id' => $id));
   $data = $check->fetch();
   $check1 = $bdd->prepare('SELECT * FROM matchclub WHERE temp_debut = :temp_debut AND temp_fin = :temp_fin AND statut = :etat AND id_terrain = :terrain');
   $check1->execute(array(':temp_debut' => $data['temp_debut'], ':temp_fin' => $data['temp_fin'], ':etat' => 'accept', ':terrain' => $data[3]));
   $result = $check1->rowCount();
   if ($result > 0) {
     $update = $bdd->prepare('UPDATE matchclub SET statut = :statut WHERE id_match = :id');
     $update->execute(array(':statut' => 'refus', ':id' => $id));
     $erreurReserv = "Désolé, l'ajout du match n'a pas pu être effectué car il existe déjà un match prévu à la même heure";
     $_SESSION['erreurReserv']=$erreurReserv;
     header("Location: afficheMatchs.php");
   } else {
     $update = $bdd->prepare('UPDATE matchclub SET statut = :statut WHERE id_match = :id');
     $update->execute(array(':statut' => 'accept', ':id' => $id));
     $acceptReserv = "Reservation ajoutée avec succés";
     $_SESSION['acceptReserv']=$acceptReserv;
     header("Location: afficheMatchs.php");    
    }
 
