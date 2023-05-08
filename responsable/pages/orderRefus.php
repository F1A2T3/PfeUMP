<?php
  session_start();
  require_once 'connection.php';
  $login = $_SESSION['Login'];
  $mdp = $_SESSION['mdp'];
  $reponse=$bdd->prepare('SELECT * FROM responsable WHERE CIN = :CIN AND mot_de_passe = :password');
  $reponse->execute(array(':CIN'=>$login,':password'=>$mdp));
  $data = $reponse->fetch();
  echo "hooo".$data[2];
  $cin = trim($_GET['id']);
  $check = $bdd->prepare('SELECT Nom_equipe,email,Nom,Prenom FROM user WHERE CIN = :CIN');
  $check->execute(array(':CIN' => $cin));
  $reponse1 = $check->fetch();
  echo "hooo".$reponse1[1];
  echo "hooo".$reponse1[0];
  echo "hooo".$reponse1[2];
  $to=$reponse1[1];
  $subject="Reponse de votre demmande de rejoint au club sportif";
  $headers="from: <hassanifatima773@gmail.com>";
    $etat = "Refus_Respo";
    $message="Bonjour," . $reponse1[2] . " " . $reponse1[3] . "\n\nVotre demmande a été refusé par le responsable, veuillez vérifier votre demmande avec le responsable du club.";
    mail($to,$subject,$message,$headers);
    $check = $bdd->prepare('UPDATE user SET état_inscription = :etat WHERE CIN = :CIN');
    $check->execute(array(':etat' => $etat,':CIN' => $cin));
    $check1 = $bdd->prepare('UPDATE user SET id_Respo = :id WHERE CIN = :CIN');
    $check1->execute(array(':id' => $data[0], ':CIN' => $cin));
    $check = $bdd->prepare('SELECT Capitaine FROM equipe WHERE Nom_equipe = :equipeName');
    $check->execute(array(':equipeName' => $reponse1[0]));
    $result = $check->fetch();
  if($result[0]==$cin){
    $check2 = $bdd->prepare('UPDATE equipe SET id_Respo = :id WHERE Nom_equipe = :equipeName');
    $check2->execute(array(':id' => $data[0], ':equipeName' => $reponse1[0]));}
    header("Location: order.php");