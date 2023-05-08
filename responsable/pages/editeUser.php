<?php
// Connexion à la base de données
require_once 'connection.php';
include 'sidebar.php';
// Récupération de l'ID de l'utilisateur
$id_utilisateur = trim($_GET['id']);

// Récupération des données de l'utilisateur
$requete = "SELECT * FROM user WHERE CIN = ?";
$reponse = $bdd->prepare($requete);
$reponse->execute([$id_utilisateur]);
$data = $reponse->fetch();

$requete1 = "SELECT Capitaine FROM equipe WHERE Nom_equipe = ?";
$reponse1 = $bdd->prepare($requete1);
$reponse1->execute([$data['Nom_equipe']]);
$data1 = $reponse1->fetch();

// Traitement du formulaire
if (isset($_POST['submit'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST ['email']);
    $CIN = htmlspecialchars($_POST['CIN']);
    $tel = htmlspecialchars($_POST['tel']);
    $Fonctionnalite = htmlspecialchars($_POST['Fonctionnalite']);
    if($data['CIN']==$data1[0]){
       $equipe = htmlspecialchars($_POST['selectChEq']);
    }else{
       $equipe = htmlspecialchars($_POST['equipeName']);
    }
    $etat = htmlspecialchars($_POST['etat']);
        //Image Traitement
    $target_dir = "../../Uploads/";
    $target_file = $target_dir.basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $chek = getimagesize($_FILES["img"]["tmp_name"]);
    if($chek!==false){
        echo "File is an image - ".$chek["mime"].".";
        $uploadOk=1;
    } else {
        echo "File is not an image.";
        $uploadOk=0;
    }
    if(file_exists($target_file)){
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if($_FILES["img"]["size"] > 500000000){
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if($imageFileType!="jpg"&&$imageFileType!="jpeg"&&$imageFileType!="pnj"){
        echo "Sorry, only jpg,jpge,pnj files are allowed";
        $uploadOk = 0;
    }
    if($uploadOk==0){
        echo "Sorry, your file is not uploaded";
    }
    else{
        if(move_uploaded_file($_FILES["img"]["tmp_name"],$target_file)){
            echo "The file".basename($_FILES["img"]["name"])."has been uploaded";
        }else
                echo "Sorry, ";
        }

    // Mise à jour des données de l'utilisateur
    $requete = "UPDATE user SET CIN=?, Nom = ?, Prenom = ?,Tel=? Email = ?, Type = ?, état_inscription = ?,Nom_equipe = ?,img = ? WHERE CIN = ?";
    $reponse = $bdd->prepare($requete);
    $reponse->execute([$CIN, $nom, $prenom,$tel,$email,$Fonctionnalite,$etat,$equipe, $target_file, $id_utilisateur]);

    $msg_modif = "Utilisateur modifié";
    $_SESSION['msg_modif']=$msg_modif;
    // Redirection vers la page de profil de l'utilisateur
    header("Location: profileuser.php?id=$id_utilisateur");
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
                        <h2 class="signh2">Editer les informations de<br><?php echo $data['Nom'] . ' ' . $data['Prenom'];?></h2>
               <div class="input-group">
                 <input  type="text" name="nom" value="<?php echo $data['Nom'];?>" required>
                 <label >Nom</label>
              </div>
              <div class="input-group">
                 <input type="text" name="prenom" value="<?php echo $data['Prenom']; ?>" required>
                 <label >Prenom</label>
              </div>
              <div class="input-group">
                 <input type="text" name="CIN" value="<?php echo $data['CIN']; ?>" required>
                 <label >CIN</label>
              </div>
              <div class="input-group">
                 <input type="email" name="email" value="<?php echo $data['Email']; ?>" required>
                 <label>Email</label>
              </div>
              <div class="input-group">
                 <input name="tel" type="Tel" value="<?php echo "0".$data['Tel']; ?>" required>
                 <label >Téléphone</label>
              </div>
                   <label for="Choice" style="font-size: larger; color:rgb(225, 253, 44); border-bottom: 2px solid #16774a; ">Il est :</label><br>
                   <div class="clnext">
                   <label class="next" for="EtudiantFso">
                       <input type="radio" name="Fonctionnalite" id="EtudiantFso" value="EtudiantFso" <?php if($data['Type']=="EtudiantFso"){ echo "checked";}?>>
                       Etudiant Fso
                    </label><br>
                    <label class="next" for="FonctionnaireFso">
                       <input type="radio" name="Fonctionnalite" id="FonctionnaireFso" value="FonctionnaireFso"<?php if($data['Type']=="FonctionnaireFso"){ echo "checked";}?>>
                        Fonctionnaire Fso
                    </label><br>
                    <label class="next" for="Externe">
                       <input type="radio" name="Fonctionnalite" id="Externe" value="Externe"<?php if($data['Type']=="Externe"){ echo "checked";}?>>
                       Externe
                    </label>
                </div><br>
                <div>
                <input type="image" src="<?php echo "../".$data['img'];?>" style="width:80px;height:80px;display:block;margin-left:161px;" id="img"><div>
                <div class="img" style="margin-top: 30px; position: relative; z-index: 1;">
                   <div id="preview"></div>
                   <label for="Choice" style="font-size: larger; color: rgb(225, 253, 44); border-bottom: 2px solid rgb(225, 253, 44); display: block;font-size:smaller;">Changer la photo du membre :</label>
                   <input type="file" name="img" id="img" style="padding-left: 40px; width: 100%; height: 100%; opacity: 0; position: absolute; left: 0; top: 0; z-index: 3;">
                </div>
         <div class="clnext" style="padding-left: 0px;">
            <label>L'état d' inscription :</label> 
            <select name="etat">
                <option value="Attente_Respo">Attente responsable</option>
                <option value="Inscrit">Inscrit</option>
                <option value="Attente_Capit">Attente Capitaine</option>
                <option value="Refus_Respo">Refusé par responsable</option>
                <option value="Refus_Capit">Refusé par capitaine</option>
            </select><br>
            <?php
                  if($data['CIN']!=$data1[0]){
               ?>
            <label>Changer l'équipe de l'utilisateur</label>
            <select id="chEq" name="selectChEq">
               <?php
                     $sql='SELECT * from equipe'; 
                     $reponse=$bdd->prepare($sql);
                     $reponse->execute();
                  if($reponse->rowCount()>0){
                     while($donnees = $reponse->fetch()){
                       if($donnees[2] != 0){
                         if($data['Nom_equipe']==$donnees[0]){
                           echo "<option value=".$donnees[0]." selected >".$donnees[0]."</option>";}
                         else{
                           echo "<option value=".$donnees[0].">".$donnees[0]."</option>";
                         }} 
                     }
                     }
                  else{
                     echo "Noooo equipe";
                  }
                  ?>
            </select><?php } 
                  else{?>
               <div class="input-group">
                  <input type="text" name="equipeName" placeholder="Nom d'equipe" id="crEq"value="<?php echo $data['Nom_equipe']; ?>"><?php }?>
               </div>

         </div>
           <div class="btn">
             <input type="submit" name="submit" value="Modifier"style="width: 121px;border-radius: 13px;background-color:rgb(225, 253, 44);border: none;height: 29px;"> 
           </div> 
                        </div>
                    </form>           
                </div>
            </div>
        </main>
    </section>
    <script>
            const input = document.querySelector('input[type="file"]');
            const preview = document.querySelector('#preview');

            input.addEventListener('change', () => {
            const file = input.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                document.getElementById("img").style.display="none";
                const image = new Image();
                image.src = reader.result;
                preview.innerHTML = '';
                image.width = 80;
                image.height = 80;
                preview.appendChild(image);
            });

            if (file) {
              reader.readAsDataURL(file);
            }
            });
        </script>
</body>
</body>
</html>