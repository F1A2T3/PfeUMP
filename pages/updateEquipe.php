<?php
// Connexion à la base de données
require_once 'connection.php';
include 'sidebar.php';
// Récupération de l'ID de l'utilisateur
$nomEquipe = $_GET['equipe'];

// Récupération des données de l'utilisateur
$requete = "SELECT * FROM equipe WHERE Nom_equipe = ?";
$reponse = $bdd->prepare($requete);
$reponse->execute([$nomEquipe]);
$data = $reponse->fetch();

$requete1 = "SELECT CIN FROM user WHERE Nom_equipe = ?";
$reponse1 = $bdd->prepare($requete1);
$reponse1->execute([$nomEquipe]);

// Traitement du formulaire
if (isset($_POST['submit'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $capitaine = htmlspecialchars($_POST['selectChEq']);
    // Mise à jour des données de l'utilisateur
    $requete2 = "UPDATE user SET Nom_equipe=? WHERE CIN = ?";
    $reponse2 = $bdd->prepare($requete2);
    $reponse2->execute([$nom, $capitaine]);
    $requete4 = "SELECT COUNT(*) FROM user WHERE Nom_equipe = ?;";
    $reponse4 = $bdd->prepare($requete4);
    $reponse4->execute([$nom]);
    $requete3 = "UPDATE equipe SET Nom_equipe=?, Capitaine = ?,nbr_joueurs = ? WHERE Nom_equipe = ?";
    $reponse3 = $bdd->prepare($requete3);
    $reponse3->execute([$nom, $capitaine,$reponse4[0],$nomEquipe]);

    $msg_modifEq = "Equipe modifié";
    $_SESSION['msg_modifEq']=$msg_modifEq;
    // Redirection vers la page de profil de l'utilisateur
    header("Location: infoTeam.php?id=$nomEquipe");
    exit();
}
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
    <link rel="stylesheet" href="../css/styleAjout.css">
</head>
<body>
 <section id="content">
  <main>
   <div class="head-title">
        <div class="container emp-profile" style="width :444px;margin-right:232px;">
            <form name="formSup" method="post" enctype="multipart/form-data">
              <div class="row">
                <h2 class="signh2">Editer l'équipe<br><?php echo $nomEquipe;?></h2>
                <?php
                if (isset($_SESSION['msg_suppu'])) {
                        echo '<span style="color:green;display:block ruby;">'.$_SESSION['msg_suppu'].'</span>';
                        unset($_SESSION['msg_suppu']);
                }?>
                <div class="input-group">
                 <input  type="text" name="nom" value="<?php echo $nomEquipe;?>" required>
                 <label >Nom d'équipe :</label>
               </div>
              <div class="clnext" style="padding-left: 0px;">
              <label>Changer le capitaine de l'équipe :</label>
              <select id="chEq" name="selectChEq" style="margin-left: 278px;">
               <?php
                     $sql='SELECT CIN from user WHERE Nom_equipe IS NULL AND état_inscription="Inscrit"'; 
                     $reponse=$bdd->prepare($sql);
                     $reponse->execute();
                  if($reponse->rowCount()>0){
                     while($donnees = $reponse->fetch()){
                           echo "<option value=".$donnees[0]." >".$donnees[0]."</option>";
                     }
                     }
                  else{
                     echo "Noooo equipe";
                  }
                  while($data1 = $reponse1->fetch()){
                    if($data1[0] == $data[4]){
                        echo "<option value=".$data1[0]." selected >".$data1[0]."</option>";}
                      else{
                        echo "<option value=".$data1[0].">".$data1[0]."</option>";
                      }} 
                  ?>
            </select>
               </div>
        </div><br>
        <p>Vous voulez ajouter un membre a cette equipe ?<a href="AjouterMembre.php" class="signUpBtn-link">Ajouter</a></p>
        <div class="btn">
            <input type="submit" name="submit" value="Modifier"style="width: 121px;border-radius: 13px;background-color:rgb(225, 253, 44);border: none;height: 29px;"> 
        </div> 
     </div>
    </form>           
   </div>
  </div>
 </main>
</section>
</body>
</html>