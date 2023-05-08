<?php
    session_start();
    require_once 'connection.php';
        $equipe1 = $_POST['equipe1'];
        $id_terrain = $_POST['type'];
        $date = $_POST['date'];
        $date_debut = $_POST['heure_debut'];
        $date_fin = $_POST['heure_fin'];
        $datestr =  $date . ' ' . $date_debut;
        $datetime = new DateTime($datestr);
        $debut = $datetime->format('Y-m-d H:i:s');
        $datestr =  $date . ' ' . $date_fin;
        $datetime = new DateTime($datestr);
        $fin = $datetime->format('Y-m-d H:i:s');
        if(empty($_POST['equipe2'])){
          $sql = "INSERT INTO matchclub (equipe1, equipe2, id_terrain, temp_debut, temp_fin, statut)
          VALUES (:equipe1, NULL, :id_terrain, :debut, :fin, 'attente_respo')";
          $stmt = $bdd->prepare($sql);
          $stmt->bindParam(':equipe1', $equipe1);
          $stmt->bindParam(':id_terrain', $id_terrain);
          $stmt->bindParam(':debut', $debut);
          $stmt->bindParam(':fin', $fin);
          $stmt->execute();
        }else{
          $sql = "INSERT INTO matchclub (equipe1, equipe2, id_terrain, temp_debut, temp_fin, statut)
          VALUES (:equipe1, :equipe2, :id_terrain, :debut, :fin, 'attente_capit')";
          $stmt = $bdd->prepare($sql);
          $stmt->bindParam(':equipe1', $equipe1);
          $stmt->bindParam(':equipe2',$_POST['equipe2'] );
          $stmt->bindParam(':id_terrain', $id_terrain);
          $stmt->bindParam(':debut', $debut);
          $stmt->bindParam(':fin', $fin);
          $stmt->execute();
        }
?>
