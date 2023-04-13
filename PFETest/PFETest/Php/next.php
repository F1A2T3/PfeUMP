<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/styleLogin.css">
    <title>Document</title>
</head>
<?php require_once 'config.php'; ?>
<body>
<div class="container">
        <div class="navbar">
            <img src="../Images/avocado-svgrepo-com.svg" style="width: 38px; height: px;" >
               <h2 class="logo">  SpoClub </h2>
                  <nav>
                   <ul id="menuList">
                     <li><a href="">Home</a></li>
                     <li><a href="">Help</a></li>
                     <li><a href="">About us</a></li>
                     <li><a href="">CAP</a></li>
                     <li><a href="">UMP</a></li>
                   </ul>
                  </nav>
                <img src="../Images/burger-checklist-list-menu-navigation-svgrepo-com.svg" class="menu-icon" style="background-color: azure;" onclick="togglemenu()">
        </div>
         <div class="wrapper" style="height: 600px; width: 500px; left:180px;padding-left: 40PX;margin-left: 150px;">
               <h2 class="signh2" >sign-up</h2><br>
               <span style="color:red;"><?php echo isset($_SESSION['error_msg_equipe']) ? $_SESSION['error_msg_equipe'] : ''; ?></span><br>
               <form name="formSup" method="Post" action="Inscription.php" enctype="multipart/form-data" style="padding-top: 20px;">
                   <label for="Choice" style="font-size: larger; color:#16774a; border-bottom: 2px solid #16774a; ">You are :</label><br>
                   <div class="clnext">
                   <label class="next" for="EtudiantFso">
                       <input type="radio" name="Fonctionnalite" id="EtudiantFso" value="EtudiantFso">
                       EtudiantFso
                    </label>
                    <label class="next" for="FonctionnaireFso">
                       <input type="radio" name="Fonctionnalite" id="FonctionnaireFso" value="FonctionnaireFso">
                        FonctionnaireFso
                    </label>
                    <label class="next" for="Externe">
                       <input type="radio" name="Fonctionnalite" id="Externe" value="Externe">
                       Externe
                    </label>
                </div>
                <div class="img" style="margin-top: 30px; position: relative; z-index: 1;">
                   <label for="Choice" style="font-size: larger; color: #16774a; border-bottom: 2px solid #16774a; display: block;">Entrez votre photo :</label>
                   <input type="file" name="img" id="img" style="padding-left: 40px; width: 100%; height: 100%; opacity: 0; position: absolute; left: 0; top: 0; z-index: 3;">
                </div>
         <div class="clnext" style="padding-left: 0px;">
               <label for="Choice" style="font-size: larger; color: #16774a; border-bottom: 2px solid #16774a; ">Vous voulez  :</label><br>
            <div class="EquipeChoice" style="padding-top: 20px; padding-left: 30px;">
                <label class="next" for="newEquipe">
                    <input type="radio" name="equipe" id="newEquipe" value="newEquipe">
                    Créer une équipe 
                 </label>
                 <label class="next" for="oldEquipe">
                    <input type="radio" name="equipe" id="oldEquipe" value="oldEquipe">
                     rejoindre une équipe 
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
                  <input type="text" name="equipeName" placeholder="Nom d'equipe" id="crEq" style="display:none;" >
               </div>
            </div>
         </div>
               <div class="btn"><button type="submit" name="subm">S'inscrire</button></div>
                <div class="btn"><button type="button" onclick="window.location.href='../Php/Login.php'">Annuler</button></div>
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
         
              var menuList=document.getElementById("menuList");
              menuList.style.maxHeight="0px";
              function togglemenu(){
                    if(menuList.style.maxHeight== "0px") 
                         menuList.style.maxHeight="130px";
                    else 
                         menuList.style.maxHeight="0px"
                     }
         </script>
</body>
</html>