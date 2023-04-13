<?php
  session_start();
  require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styleAjout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-up">
            <form name="formSup" method="post" action="Inscription.php" enctype="multipart/form-data">
               <h2 class="signh2">Ajouter membre </h2>
               <span style="color:red;"><?php echo isset($_SESSION['error_msg_inscription']) ? $_SESSION['error_msg_inscription'] : '';
               echo isset($_SESSION['error_msg_equipe']) ? $_SESSION['error_msg_equipe'] : '';?></span><br>
               <div class="input-group">
                 <input  type="text" name="nom" required>
                 <label >Nom</label>
              </div>
              <div class="input-group">
                 <input type="text" name="prenom" required>
                 <label >Prenom</label>
              </div>
              <div class="input-group">
                 <input type="text" name="CIN" required>
                 <label >CIN</label>
              </div>
              <div class="input-group">
                 <input type="email" name="email" required>
                 <label>Email</label>
              </div>
              <div class="input-group">
                 <input name="tel" type="Tel" required>
                 <label >Téléphone</label>
              </div>
              <div class="input-group">
                  <input type="password" name="password" required>
                  <label>Mot de passe</label>
              </div>
                   <label for="Choice" style="font-size: larger; color:#16774a; border-bottom: 2px solid #16774a; ">Il est :</label><br>
                   <div class="clnext">
                   <label class="next" for="EtudiantFso">
                       <input type="radio" name="Fonctionnalite" id="EtudiantFso" value="EtudiantFso">
                       Etudiant Fso
                    </label><br>
                    <label class="next" for="FonctionnaireFso">
                       <input type="radio" name="Fonctionnalite" id="FonctionnaireFso" value="FonctionnaireFso">
                        Fonctionnaire Fso
                    </label><br>
                    <label class="next" for="Externe">
                       <input type="radio" name="Fonctionnalite" id="Externe" value="Externe">
                       Externe
                    </label>
                </div>
                <div class="img" style="margin-top: 30px; position: relative; z-index: 1;">
                   <label for="Choice" style="font-size: larger; color: #16774a; border-bottom: 2px solid #16774a; display: block;">Entrez la photo du membre :</label>
                   <input type="file" name="img" id="img" style="padding-left: 40px; width: 100%; height: 100%; opacity: 0; position: absolute; left: 0; top: 0; z-index: 3;">
                </div>
         <div class="clnext" style="padding-left: 0px;">
               <label for="Choice" style="font-size: larger; color: #16774a; border-bottom: 2px solid #16774a; ">Il veut  :</label><br>
            <div class="EquipeChoice" style="padding-top: 20px; padding-left: 30px;">
                <label class="next" for="newEquipe">
                    <input type="radio" name="equipe" id="newEquipe" value="newEquipe">
                    Créer une équipe 
                 </label><br>
                 <label class="next" for="oldEquipe">
                    <input type="radio" name="equipe" id="oldEquipe" value="oldEquipe">
                     Ajouter ce membre a une équipe
                 </label>
            </div>
            <div id="content">  
            <select id="chEq" name="selectChEq" style="display:none;">
               <?php
                     $sql='SELECT * from equipe'; 
                     $reponse=$bdd->prepare($sql);
                     $reponse->execute();
                  if($reponse->rowCount()>0){
                     while($donnees = $reponse->fetch()){
                       if($donnees[2] != 0)
                        echo "<option value=".$donnees[0].">".$donnees[0]."</option>"; 
                     }
                     }
                  else{
                     echo "Noooo equipe";
                  }
                  ?>
               </select>
               <div class="input-group">
                  <input type="text" name="equipeName" placeholder="Nom d'equipe" id="crEq" style="display:none;">
               </div>
            </div>
         </div>
               <div class="btn"><button type="submit" name="subm">Ajouter</button></div>
                <div class="btn"><button type="button"onclick="window.location.href='afficherUSER.php'">Annuler</button></div>
            </form>
        </div>
    <script>
      var btn1=document.getElementById("newEquipe");
      var btn2=document.getElementById("oldEquipe");
      var content=document.getElementById("content");
      function createElement1(){
            document.getElementById("chEq").style.display="none";
            document.getElementById("crEq").style.display="block";
        }
      function createElement2(){
            document.getElementById("crEq").style.display="none";
            document.getElementById("chEq").style.display="block";
       }
        btn1.addEventListener("click",createElement1);
        btn2.addEventListener("click",createElement2);
    </script>
 </div>
 </body>
 </html>