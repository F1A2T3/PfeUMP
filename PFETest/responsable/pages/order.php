<?php require_once 'sidebar.php';?>
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
                                        <img src="<?=$donnees[10]?>">
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
                                if(isset($_POST['Accepte'][$i])){
                                    $etat = "Inscrit";
                                }
                                if(isset($_POST['Refuser'][$i])){
                                    $etat = "Refus_Respo";
                                }
                                $check = $bdd->prepare('UPDATE user SET état_inscription = :etat WHERE CIN = :CIN');
                                $check->execute(array('etat' => $etat, 'CIN' => $cin[$i]));
                            }
                        }
                        else{
                            echo "<p>No row here</p>";
                        }
                    ?>     
                </div>
</body>
</html>