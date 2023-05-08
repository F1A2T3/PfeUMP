<?php
    include "connection.php";
    include "sidebar.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réservation de terrain de club de sport</title>
  <!-- Liens vers les fichiers CSS de Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/match.css">
  <style>
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
                        <h1>&bull; Reserver un match &bull;</h1>
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
                                            echo "<option value=\"$row[Nom_equipe]\">";
                                            echo  $row['Nom_equipe'] . "<br>";
                                            echo "</option>";
                                    } ?>
                                    </select>
                                </div>
                                <div class="email">
                                    <label for="equipe2">EQUIPE 2 :</label>
                                    <select name="equipe2">
                                    <Option disabled hidden selected></Option>
                                    <?php 
                                        $sql = "SELECT Nom_equipe FROM equipe";
                                        $stmt = $bdd->prepare($sql);
                                        $stmt->execute();
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value=\"$row[Nom_equipe]\">";
                                            echo  $row['Nom_equipe'] . "<br>";
                                            echo "</option>";
                                    } ?>
                                    </select>
                                </div>

                                <div class="date">
                                    <p style="padding-top: 20px; padding-left: 30px;"><em>Soutaitez-vous que ce match soit fixe tout au long de l'année :</em></p>
                                        <div class="input-group">
                                            <input class="datepicker-input" type="date" name="date" placeholder="date :" id="crEq" >
                                        </div>
                                        </div>
                                    <label for="date_debut"> Heure début :</label>
                                    <input type="time" name="heure_debut" id="date_debut_input" required>
                                </div>
                                <div class="date">
                                    <label for="date_fin"> Heure fin :</label>
                                    <input type="time" name="heure_fin" id="date_fin_input" required>
                                </div>
                                <div class="type">
                                    <label for="type">Le terrain du match :</label>
                                    <select name="type" id="type">
                                        <option value="1">Terrain du foot </option>
                                        <option value="2">Terrain du basket</option>
                                        <option value="3">Terrain du volley</option>
                                    </select>
                                </div>
                      </div>
                        <button class="submit" type="submit"  id="form_button">Reserver</button>
                    </div>
                    </form>
                </div>
            </div>                
        </main>
    </section>
    <!-- SCRIPTE  POUR AJOUTER UN FORMULAIRE -->
<script>         
    var menuList=document.getElementById("menuList");
    menuList.style.maxHeight="0px";
    function togglemenu(){
        if(menuList.style.maxHeight== "0px") 
            menuList.style.maxHeight="130px";
        else 
            menuList.style.maxHeight="0px"
        }
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