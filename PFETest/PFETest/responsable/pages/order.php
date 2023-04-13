<?php
  require_once 'sidebar.php';
  $login = $_SESSION['Login'];
  $mdp = $_SESSION['mdp'];
  $reponse=$bdd->prepare('SELECT * FROM responsable WHERE CIN = :CIN AND mot_de_passe = :password');
  $reponse->execute(array(':CIN'=>$login,':password'=>$mdp));
  $data = $reponse->fetch();
  ?>
  <?php
    try 
    {
        $bdd = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
        echo "Connected";
    }
    catch(PDOException $e)
    {
        die('Erreur HOOOOOO: '.$e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Css/styleDemande.css">
    <title>Demandes</title>
</head>
<body>
    <section id="content">
    	<main>
			<div class="head-title">
                <div class="list">
                    <?php
                        $etat = "Attente_Respo";
                        $check = $bdd->prepare('SELECT * FROM user WHERE état_inscription = :etat');
                        $check->execute(array('etat' => $etat));
                        if($check->rowCount()>0){
                            $cin = array();
                            while($donnees = $check->fetch()){
                                $cin[] = $donnees[0]; ?>
                                <div class="Person">
                                        <img src="<?php echo "../" .$donnees[9] ;?>">
                                        <div class="Name"><?=$donnees[1]?> <?=$donnees[2]?></div>
                                        <div class="CIN"><?=$donnees[0]?></div>
                                        <form action="" method="post">
                                        <button class="accepter" name="Accepte[]" type="submit">Accepter</button>
                                        <button class="refuser" name="Refuser[]" type="submit">Refuser</button>
                                        </form>
                                </div> 
                        <?php
                            }
                            for($i=0;$i<$check->rowCount();$i++){
                                $check = $bdd->prepare('SELECT Nom_equipe,email,Nom,Prenom FROM user WHERE CIN = :CIN');
                                $check->execute(array('CIN' => $cin[$i]));
                                $reponse1 = $check->fetch();
                                $to=$reponse1[1];
                                $subject="Reponse de votre demmande de rejoint au club sportif";
                                $headers="from: <hassanifatima773@gmail.com>";
                                if(isset($_POST['Accepte'][$i])){
                                    $etat = "Inscrit";
                                    $message = "Bonjour, " . $reponse1[2] . " " . $reponse1[3] . ",\n\nVotre demande a été acceptée par le responsable, et vous êtes maintenant membre dans le club sportif.";
                                    $check = $bdd->prepare('UPDATE equipe SET nbr_joueurs = nbr_joueurs+1 WHERE Nom_equipe = :equipeName');
                                    $check->execute(array('equipeName' => $reponse1[0]));
                                    mail($to,$subject,$message,$headers);
                                }
                                if(isset($_POST['Refuser'][$i])){
                                    $etat = "Refus_Respo";
                                    $message="Bonjour,\n\nVotre demmande a été refusé par le responsable, veuillez vérifier votre demmande avec le responsable du club.";
                                    mail($to,$subject,$message,$headers);
                                }
                                if(isset($_POST['Refuser'][$i])||isset($_POST['Accepte'][$i])){
                                $check = $bdd->prepare('UPDATE user SET état_inscription = :etat WHERE CIN = :CIN');
                                $check->execute(array('etat' => $etat, 'CIN' => $cin[$i]));
                                $check1 = $bdd->prepare('UPDATE user SET id_Respo = :id WHERE CIN = :CIN');
                                $check1->execute(array('id' => $data[0], 'CIN' => $cin[$i]));
                                $check = $bdd->prepare('SELECT Capitaine FROM equipe WHERE Nom_equipe = :equipeName');
                                $check->execute(array('equipeName' => $reponse1[0]));
                                $result = $check->fetch();
                                if($result[0]==$cin[$i]){
                                  $check2 = $bdd->prepare('UPDATE equipe SET id_Respo = :id WHERE Nom_equipe = :equipeName');
                                  $check2->execute(array('id' => $data[0], 'equipeName' => $reponse1[0]));}
                                  header("Location: order1.php");}
                            }
                        }
                        else{
                            echo "<p>No row here</p>";
                        }
                    ?>     
                </div>
</body>
</html>