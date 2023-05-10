<?php 
    require_once 'connection.php';
    include "sidebar.php";
    $CIN=trim($_GET['id']);
    $reponse=$bdd->prepare('SELECT * FROM user WHERE CIN =:CIN ');
    $reponse->execute(array(':CIN'=>$CIN));//':password'=>$mdp
    $data = $reponse->fetch();
    $reponse2=$bdd->prepare('SELECT Nom,Prenom,CIN FROM responsable WHERE id_Respo =:id_Respo ');
    $reponse2->execute(array(':id_Respo'=>$data[10]));//':password'=>$mdp
    $data2 = $reponse2->fetch();
    //AND password = :password   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/profil.css"> 
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section id="content">
        <main>
            <div class="head-title">
                <div class="container emp-profile">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <?php if ($data && isset($data['img'])) { ?>
                                        <img src="<?php echo "../".$data['img'];?>" alt=""/>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                    <h6>
                                    <span style="color:black;">les informations personnel de</span> <?= $data['Nom']?> <?= $data['Prenom']?>
                                    </h6>
                                    
                                        <?php
                                          $reponse1=$bdd->prepare('SELECT Capitaine FROM equipe WHERE Nom_equipe =:equipeName ');
                                          $reponse1->execute(array(':equipeName'=>$data['Nom_equipe']));//':password'=>$mdp
                                          $data1 = $reponse1->fetch();
                                          if($data1[0]==$data['CIN']){ echo " C'est le capitaine de l'equipe  : <span style=\"color:rgb(225, 253, 44);\"> ".$data ['Nom_equipe']."</span>" ?? '';
                                          }else{echo " C'est un membre dans l'equipe  : <span style=\"color:rgb(225, 253, 44);\"> ".$data ['Nom_equipe']."</span>" ?? '';}?>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <span style="color:red;display:block ruby;">
                        <?php echo isset($_SESSION['msg_modif']) ? $_SESSION['msg_modif'] : ''; ?></span>      
                        <br>
                        <?php
                           switch ($data[6]){
                             case "Inscrit":
                                if($_SESSION['Login']==$data2[2]){
                                    ?>
                                    <p>
                                    la demande d'inscription de ce membre a été acceptée par vous.
                                    </p>
                                    <?php
                                       } else {
                                    ?>
                                    <p>
                                    la demande d'inscription de ce membre a été acceptée par <?php echo " :".$data2[0]." ".$data2[1] ?? '';?> .
                                    </p>
                                    <?php }
                        ?>
                        <?php 
                              break;
                             case "Attente_Capit":
                        ?>
                        <p>
                        La demande d'inscription de ce membre est en attente de la réponse du capitaine.
                        </p>
                        <?php
                              break;
                             case "Attente_Respo":
                        ?>
                        <p>
                        La demande d'inscription de ce membre est en attente de votre réponse en tant que responsable du club.
                        </p>
                        <?php
                              break;
                             case "Refus_Capit":
                        ?>
                        <p>
                        la demande d'inscription de ce membre a été refusée par le capitaine.
                        </p>
                        <?php
                              break;
                             default:
                               if($_SESSION['Login']==$data2[2]){
                        ?>
                        <p>
                        la demande d'inscription de ce membre a été refusée par vous.
                        </p>
                        <?php
                           } else {
                        ?>
                        <p>
                        la demande d'inscription de ce membre a été refusée par <?php echo " :".$data2[0]." ".$data2[1] ?? '';?> .
                        </p>
                        <?php }}?>
                        <?php
                           if (isset($_SESSION['msg_modif'])) {
                                echo '<span style="color:green;display:block ruby;">'.$_SESSION['msg_modif'].'</span>';
                                unset($_SESSION['msg_modif']);
                            }?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <?php if ($data && is_array($data)) { ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>CIN  </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>:<?php echo $data['CIN'] ?? '';?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Nom</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>:<?php echo $data['Nom'] ?? '';?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Prénom</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>:<?php echo $data['Prenom'] ?? '';?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Téléphone</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>:<?php echo $data['Tel'] ?? '';?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>:<?php echo $data['Email'] ?? '';?></p>
                                                </div>
                                            </div>
                                            <div class=" row">
                                                <div class="btn col-md-6"><a href="editeUser.php?id=<?php echo $CIN; ?>" >Editer</a></div>
                                                <div class="btn col-md-6"><a href="suppUser.php?id=<?php echo $CIN; ?>" >Supprimer</a></div>
                                            </div>
                                        <?php } else { ?>
                                            <p>Aucune donnée trouvée.</p>
                                        <?php } ?>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Your Bio</label><br/>
                                                <p>Your detail description</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>           
                </div>
            </div>
        </main>
    </section>
</body>
</body>
</html>