<?php
    session_start();
    //include "sidebar.php";
    include_once "connection.php";
    $login = $_SESSION['Login'];
    $mdp = $_SESSION['mdp'];
    $reponse1=$bdd->prepare('SELECT Nom_equipe FROM user WHERE CIN = :CIN AND password = :password');
    $reponse1->execute(array(':CIN'=>$login,':password'=>$mdp));
    $data1 = $reponse1->fetch();
    $equipe = $data1[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste of user</title>
    <link rel="stylesheet" href="../css/tble.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/6404735ed8.css" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/6404735ed8.js" crossorigin="anonymous"></script>

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="stylesheet" href="../css/style.css">
     <link rel="stylesheet" href="../css/stylemsgs.css"> 
</head>

<body>  
  <section >
        <main>
            <!-- <div  class="table-data">
                <div class="order "> -->
                <div class="box">
        <h3>Boite de messages</h3>
      <?php
        $etat = "attente_capit";
        $check = $bdd->prepare('SELECT * FROM matchclub WHERE statut = :etat');
        $check->execute(array(':etat' => $etat));
        if($check->rowCount()>0){
            //$cin = array();
            while($donnees = $check->fetch()){
                $check1 = $bdd->prepare('SELECT u.img, u.Nom, u.Prenom
                FROM matchclub m
                JOIN equipe e ON m.equipe1 = e.Nom_equipe
                JOIN user u ON e.Capitaine = u.CIN WHERE m.id_match=:match AND m.equipe2=:equipe' );
                $check1->execute(array(':match' => $donnees[0],':equipe'=>$equipe));
                $data = $check1->fetch();
                 ?>
        <div class="list" onclick="window.location.href='msg.php<?php echo "?id=".$donnees[0];?>';">
            <div class="imgBx">
                <img src="../<?=$data[0]?>" >
            </div>
            <div class="content">
                <h2 class="rank"><small></small></h2>
                <h4><?=$data[1]?> <?=$data[2]?></h4>
                <p>Demande de match</p>
            </div>
        </div>
        <?php
            }
                }
                else{
                    echo "<p>Vous n'avez aucun message</p>";
                }
                    ?>  
      </div>
                   
                </div>
            </div>
        </main>
    </section>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-+JZJzvJZJzvJzvJZJzvJZJzvJZJzvJZJzvJZJzvJZJzvJZJzvJZJzvJZJzvJZJz"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../responsable/scripte/script.js"></script> -->
</body>
</html>