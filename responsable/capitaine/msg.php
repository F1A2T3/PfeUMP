<?php
  session_start();
  //require_once 'sidebar.php';
  require_once 'connection.php';
  //$login = $_SESSION['Login'];
  //$mdp = $_SESSION['mdp'];
  $id = trim($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/stylemsg.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <span></span>
            <div class="content">
              <?php
                 $jours = array(
                  'Monday' => 'Lundi',
                  'Tuesday' => 'Mardi',
                  'Wednesday' => 'Mercredi',
                  'Thursday' => 'Jeudi',
                  'Friday' => 'Vendredi',
                  'Saturday' => 'Samedi',
                  'Sunday' => 'Dimanche'
                 );
                 $check = $bdd->prepare('SELECT * FROM matchclub WHERE id_match = :id');
                 $check->execute(array(':id' => $id));
                 $data = $check->fetch(); 
                 $date = date('d-m-y', strtotime($data[4]));
                 $jouren = date('l', strtotime($data[4]));
                 $jour = $jours[$jouren];
                 $debut = date('H:i:s', strtotime($data[4]));
                 $fin = date('H:i:s', strtotime($data[5]));                 
                 $check1 = $bdd->prepare('SELECT u.Nom, u.Prenom ,u.Type
                 FROM matchclub m
                 JOIN equipe e ON m.equipe1 = e.Nom_equipe
                 JOIN user u ON e.Capitaine = u.CIN WHERE m.id_match=:match');
                 $check1->execute(array('match'=>$data[0]));
                 $data1 = $check1->fetch();
               ?>
                <h2><?=$data1[0]?> <?=$data1[1]?></h2>
                <p>Salut,<br>
                    Je suis le capitaine de l'équipe <?=$data[1]?> (<?php if($data1[2]=="EtudiantFso"){echo "des etudiants de FSO";}else{if($data1[2]=="FonctionnaireFso"){echo "des fonctionnaires";}else{echo "des externes";}}?>) et j'aimerais soumettre une demande pour un match <?php if($data[3]==1){echo "de foot";}else{if($data[3]==2){echo "de basket";}else{echo "de volley";}}?> contre votre équipe. Nous sommes disponibles pour jouer le <?=$jour?> <?=$date?> de <?=$debut?> à <?=$fin?>.Je vous remercie d'avance pour votre réponse.</p>
                <a href="msgAccept.php<?php echo "?id=".$data[0];?>">Accepter</a>
                <a href="msgRefus.php<?php echo "?id=".$data[0];?>">Refuser</a>
            </div>
        </div>
    </div>
</body>
</html>