<?php 
    include "sidebar.php";
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
       <form name="formSup" method="post" action="Inscription.php" enctype="multipart/form-data">
          <div class="row">
                <h2 class="signh2">Ajouter Equipe</h2>
               <span style="color:red;"><?php echo isset($_SESSION['error_msg_inscription']) ? $_SESSION['error_msg_inscription'] : '';?></span><br>
               <div class="input-group">
                 <input  type="text" name="nom_equipe" required>
                 <label >Nom d'equipe</label>
                </div>
             <div id="content">  
              <select id="chCp" name="selectChCp"style="margin-left:-289px;">
                <?php
                     $sql='SELECT CIN from user WHERE Nom_equipe IS NULL AND état_inscription="Inscrit"'; 
                     $reponse=$bdd->prepare($sql);
                     $reponse->execute();
                  if($reponse->rowCount()>0){
                     while($donnees = $reponse->fetch()){
                        echo "<option value=".$donnees[0].">".$donnees[0]."</option>"; 
                     }
                    }
                   else{
                     ?>
                    <option style="margin-left:-286px;">Tous les membres du club sont engagés dans une équipe</option>
                <?php
                    }
                    echo "</select><br><br>"; 
                ?>
             </div>
            </div>
             <p>Vous voulez ajouter un utilisateur(capitaine de la nouvelle equipe) ?<a href="AjouterMembre.php" class="signUpBtn-link">Ajouter</a></p>
          <div class="btn">
            <button type="submit" name="subm"onclick="window.location.href='AjoutEquipe.php'">Ajouter</button>
          </div>
          <div class="btn">
            <button type="button"onclick="window.location.href='equipe.php'">Annuler</button>
          </div>            
         </div>
      </form>     
     </div>
     </div>
    </main>
  </section>
</body>
</html>