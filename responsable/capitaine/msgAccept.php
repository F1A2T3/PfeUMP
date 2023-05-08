<?php
   require_once 'connection.php';
   session_start();
   $id = trim($_GET['id']);
   $check = $bdd->prepare('SELECT * FROM matchclub WHERE id_match = :id');
   $check->execute(array(':id' => $id));
   $data = $check->fetch();
   $update = $bdd->prepare('UPDATE matchclub SET statut = :statut WHERE id_match = :id');
   $update->execute(array(':statut' => 'attente_respo', ':id' => $id));
   header("Location: messages.php");    
 
