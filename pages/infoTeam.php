<?php
// Connexion à la base de données
require_once 'connection.php';

// Récupération de l'ID de l'équipe
$nom_equipe = trim($_GET['id']);
$reponse = $bdd->prepare('SELECT * FROM equipe WHERE Nom_equipe = :equipeName');
$reponse->execute(array(':equipeName'=>$nom_equipe));
$data1 = $reponse->fetch();
$reponse3 = $bdd->prepare('SELECT * FROM equipe WHERE id_Respo IS NULL AND Nom_equipe = :equipeName');
$reponse3->execute(array(':equipeName'=>$nom_equipe));
$nb_lines = $reponse3->rowCount();
if($nb_lines==0){
$reponse2=$bdd->prepare('SELECT Nom,Prenom,CIN FROM responsable WHERE id_Respo =:id_Respo ');
$reponse2->execute(array(':id_Respo'=>$data1[3]));//':password'=>$mdp
$data2 = $reponse2->fetch();}
$reponse3=$bdd->prepare('SELECT Nom,Prenom FROM user WHERE CIN =:capitaine ');
$reponse3->execute(array(':capitaine'=>$data1[4]));//':password'=>$mdp
$data3 = $reponse3->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'équipe <?php echo $nom_equipe; ?></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/profil.css"> 
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include "sidebar.php";?>
    <section id="content">
        <main>
            <div class="head-title">
                <div class="container emp-profile">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6  ">
                            <div class="profile-head">
                                <h5>
                                    Informations de l'équipe <?php echo $nom_equipe;?>
                                </h5>
                                <h6>
                                    <?php //echo $data[1];?>
                                </h6>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">À propos</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                            </div>
                        <div class="col-md-4">        
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                        <?php
                                            if (isset($_SESSION['msg_modifEq'])) {
                                                    echo '<span style="color:green;display:block ruby;">'.$_SESSION['msg_modifEq'].'</span>';
                                                    unset($_SESSION['msg_modifEq']);
                                            }?>
                                        <br>
                                            <?php 
                                            if($nb_lines>0){?>
                                            <p>l'équipe en question n'a pas encore été ajoutée au club, car la demande d'inscription de son capitaine est en attente de votre validation</p>
                                            <?php
                                             }else{
                                                if($nb_lines==0&&$data1[2]==0){ 
                                                   if($_SESSION['Login']==$data2[2]){
                                            ?>
                                            <p>
                                            l'équipe en question n'a pas été ajoutée au club, car la demande d'inscription de son capitaine a été refusée par vous.
                                            </p>
                                            <?php
                                                  } else {
                                            ?>
                                            <p>
                                            l'équipe en question n'a pas été ajoutée au club, car la demande d'inscription de son capitaine a été refusée par le responsable <?php echo " :".$data2[0]." ".$data2[1] ?? '';?> .
                                            </p>
                                            <?php }
                                            ?>
                                            <?php
                                                }else {
                                            if($_SESSION['Login']==$data2[2]){
                                            ?>
                                            <p>
                                            l'équipe en question a été ajoutée au club, et la demande d'inscription de son capitaine a été acceptée par vous.
                                            </p>
                                            <?php
                                                  } else {
                                            ?>
                                            <p>
                                            l'équipe en question a été ajoutée au club, et la demande d'inscription de son capitaine a été acceptée par le responsable <?php echo " :".$data2[0]." ".$data2[1] ?? '';?> .
                                            </p>
                                             <?php  }
                                             }}
                                            ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nom de l'équipe</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data1[0];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date de création</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data1[1];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nombre de joueurs</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <?php echo $data1[2];?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Capitaine d'equipe :</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $data3[0]." ".$data3[1];?></p>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="profile-work">
                                <div class="">
                                     <button type="button" class="btn1 btn col-md-12" onclick="window.location.href='listeMembres.php?equipe=<?php echo $nom_equipe; ?>'" style="width: 264px;height: 58px;">Liste des membres <img src="../../Images/right-arrow-svgrepo-com.svg"></button><br><br><br>
                                     <button type="button" class="btn1" onclick="window.location.href='updateEquipe.php?equipe=<?php echo $nom_equipe; ?>'"style="width: 191px;height: 58px;">Modifier<img src="../../Images/right-arrow-svgrepo-com.svg"></button><br><br><br>
                                     <button type="button" class="btn1" onclick="window.location.href='suppEquipe.php?equipe=<?php echo $nom_equipe; ?>'"style="width: 190px;height: 58px;">Supprimer <img src="../../Images/right-arrow-svgrepo-com.svg"></button><br><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>           
            </div>
        </main>
    </section>
<script src="../scripte/script.js"></script>
<script src="https://kit.fontawesome.com/6404735ed8.js" crossorigin="anonymous"></script>
</body>
</html>