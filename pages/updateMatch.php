<?php
    include "connection.php";
    //include "sidebar.php";
    $id_match = trim($_GET['id']);
    // Récupération des données de l'utilisateur
    $requete = "SELECT * FROM matchclub WHERE id_match = ?";
    $reponse = $bdd->prepare($requete);
    $reponse->execute([$id_match]);
    $data = $reponse->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SpoClub</title>
  <!-- Liens vers les fichiers CSS de Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/match.css">
  <style>
    /* Style pour la fenêtre popup */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }
    
    /* Style pour le contenu de la fenêtre popup */
    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }
    
    /* Style pour les boutons de la fenêtre popup */
    .modal-content button {
      margin-top: 10px;
    }
    input[type="datetime-local"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      }
   </style> 
</head>
<body>    
    <section id="content">
        <main style="background-color:rgb(225, 253, 44);">
            <div  class="table-data">
                <div class="order">
                    <div id="container">
                     <div class="modal">
                        <h1>&bull; Modifier match &bull;</h1>
                        <div class="underline">
                        </div>
                        <div class="icon_wrapper">
                            <path d="M70.865,101.78c0,4.774,3.886,8.657,8.66,8.657c4.774,0,8.657-3.883,8.657-8.657c0-4.773-3.883-8.656-8.657-8.656    C74.751,93.124,70.865,97.006,70.865,101.78z"></path>
                            </svg>
                        </div>
                    <form action="RespoReservation.php" method="POST" id="contact_form">
                    <div id="formulaires">
                                <div class="name">
                                    <label for="equipe1">EQUIPE 1 :</label>
                                    <select name="equipe1" required>
                                    <?php 
                                        $sql = "SELECT Nom_equipe FROM equipe";
                                        $stmt = $bdd->prepare($sql);
                                        $stmt->execute();
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                          if($data['equipe1']==$row['Nom_equipe']){
                                             echo "<option value=\"$row[Nom_equipe]\" selected>";
                                          }else{
                                             echo "<option value=\"$row[Nom_equipe]\">";
                                            }
                                          echo  $row['Nom_equipe'] . "<br>";
                                          echo "</option>";
                                    } ?>
                                    </select>
                                </div>
                                <div class="email">
                                    <label for="equipe2">EQUIPE 2 :</label>
                                    <select name="equipe2">
                                     <?php 
                                        $sql = "SELECT Nom_equipe FROM equipe";
                                        $stmt = $bdd->prepare($sql);
                                        $stmt->execute();
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                          if($data['equipe2']==$row['Nom_equipe']){
                                             echo "<option value=\"$row[Nom_equipe]\" selected>";
                                          }else{
                                             echo "<Option disabled hidden selected></Option>";
                                             echo "<option value=\"$row[Nom_equipe]\">";
                                          }
                                            echo  $row['Nom_equipe'] . "<br>";
                                            echo "</option>";
                                     }?>
                                    </select>
                                </div>
                                <div class="date">
                                    <div id="content">
                                       <?php
                                         if($data['statut']=="fixe"){
                                            $jour = date('N', strtotime($data['temp_debut']));
                                            $nom_jour = '';
                                            switch ($jour) {
                                                case 1:
                                                    $nom_jour = 'Lundi';
                                                    break;
                                                case 2:
                                                    $nom_jour = 'Mardi';
                                                    break;
                                                case 3:
                                                    $nom_jour = 'Mercredi';
                                                    break;
                                                case 4:
                                                    $nom_jour = 'Jeudi';
                                                    break;
                                                case 5:
                                                    $nom_jour = 'Vendredi';
                                                    break;
                                                case 6:
                                                    $nom_jour = 'Samedi';
                                                    break;
                                                case 7:
                                                    $nom_jour = 'Dimanche';
                                                    break;
                                            }
                                       ?>
                                        <select id="chEq" name="day">
                                            <option value="Lundi" <?php if($nom_jour=="Lundi") echo "selected";?>>Lundi</option>
                                            <option value="Mardi" <?php if($nom_jour=="Mardi") echo "selected";?>>Mardi</option>
                                            <option value="Mercredi" <?php if($nom_jour=="Mercredi") echo "selected";?>>Mercredi</option>
                                            <option value="Jeudi" <?php if($nom_jour=="Jeudi") echo "selected";?>>Jeudi</option>
                                            <option value="Vendredi" <?php if($nom_jour=="Vendredi") echo "selected";?>>Vendredi</option>
                                            <option value="Samedi" <?php if($nom_jour=="Samedi") echo "selected";?>>Samedi</option>
                                            <option value="Dimanche" <?php if($nom_jour=="Dimanche") echo "selected";?>>Dimanche</option>
                                        </select>
                                        <div class="input-group">
                                          <?php }else{
                                            $date = date('Y-m-d', strtotime($data['temp_debut']));?>
                                            <input class="datepicker-input" type="date" name="date" placeholder="date :" id="crEq" value="<?= $date ?>">
                                          <?php}
                                             $heureD = date('H:i', strtotime($data['temp_debut']));
                                             $heureF = date('H:i', strtotime($temp_fin));?>
                                        </div>
                                        </div>
                                    <label for="date_debut"> Heure début :</label>
                                    <input type="time" name="heure_debut" id="date_debut_input" required value="<?php echo $heureD; ?>">
                                </div>
                                <div class="date">
                                    <label for="date_fin"> Heure fin :</label>
                                    <input type="time" name="heure_fin" id="date_fin_input" required value="<?php echo $heureF; ?>">
                                </div>
                      </div>
                        <button class="submit" type="submit"  id="form_button">Modifier</button>
                        <button class="submit" type="submit"  id="form_button">Supprimer</button>
                    </div>
                    </form>
                  </div>
                </div>
            </div>                
        </main>
    </section>
 <script>
    $(function () {
      $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
      });
    });
 </script>
</body>
</html>