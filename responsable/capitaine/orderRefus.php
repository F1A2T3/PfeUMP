<?php
  require_once 'connection.php';
  $cin = $_GET['id'];
  $etat = "Refus_Capit";
  $check = $bdd->prepare('UPDATE user SET état_inscription = :etat WHERE CIN = :CIN');
  $check->execute(array(':etat' => $etat, ':CIN' => $cin));
  header("Location: order.php");