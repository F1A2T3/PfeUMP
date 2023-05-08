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
                                    <select name="equipe1[]" required>
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
                                    <select name="equipe2[]">
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
                                    <div class="EquipeChoice " style="padding-top: 20px; padding-left: 30px;">
                                        <label class="input-group" for="oldEquipe">
                                            <input type="radio" name="type_0" id="oldEquipe" value="Oui">
                                            Oui :
                                        </label>  
                                        <label class="input-group" for="newEquipe">
                                            <input type="radio" name="type_0" id="newEquipe"  value="Non">
                                            Non :
                                        </label>
                                    </div>
                                    <div id="content">
                                        <select id="chEq" name="day[]" style="display:none;">
                                            <option value="Lundi">Lundi</option>
                                            <option value="Mardi">Mardi</option>
                                            <option value="Mercredi">Mercredi</option>
                                            <option value="Jeudi">Jeudi</option>
                                            <option value="Vendredi">Vendredi</option>
                                            <option value="Samedi">Samedi</option>
                                            <option value="Dimanche">Dimanche</option>
                                        </select>
                                        <div class="input-group">
                                            <input class="datepicker-input" type="date" name="date[]" placeholder="date :" id="crEq" style="display:none;" >
                                        </div>
                                        </div>
                                    <label for="date_debut"> Heure début :</label>
                                    <input type="time" name="heure_debut[]" id="date_debut_input" required>
                                </div>
                                <div class="date">
                                    <label for="date_fin"> Heure fin :</label>
                                    <input type="time" name="heure_fin[]" id="date_fin_input" required>
                                </div>
                      </div>
                        <button class="submit" type="button" onclick="ajouterFormulaire()" id="form_button">Ajouter un formulaire</button>
                        <button class="submit" type="submit"  id="form_button">Reserver</button>
                    </div>
                    </form>
                </div>
            </div>                
        </main>
    </section>
    <!-- SCRIPTE  POUR AJOUTER UN FORMULAIRE -->
    <script>
var formCounter = 0;
function ajouterFormulaire() {
  formCounter++;
  var formHtml = '<div class="name"><label for="equipe1"></label><p><em> EQUIPE 1 :</em></p><select name="equipe1[]">\<?php $sql = "SELECT Nom_equipe FROM equipe";$stmt = $bdd->prepare($sql);$stmt->execute();while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {echo "<option value=\"$row[Nom_equipe]\">";echo  $row['Nom_equipe'] . "<br>";echo "</option>";} ?></select></div><div class="email"><label for="equipe2"></label><p><em> EQUIPE 2 :</em></p><select name="equipe2[]"><Option disabled hidden selected></Option>\<?php $sql = "SELECT Nom_equipe FROM equipe";$stmt = $bdd->prepare($sql);$stmt->execute();while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  echo "<option value=\"$row[Nom_equipe]\">";echo  $row['Nom_equipe'] . "<br>";echo "</option>";} ?></select></div><div class="date"><p style="padding-top: 20px; padding-left: 30px;"><em>Soutaitez-vous que ce match soit fixe tout au long de l\'année></p><div class="EquipeChoice " style="padding-top: 20px; padding-left: 30px;">' ;
  formHtml += '<label class="input-group" for="oldEquipe_'+ formCounter +'">';
  formHtml += '<input type="radio" name="type_'+ formCounter +'" id="oldEquipe_'+ formCounter +'" value="Oui">Oui :</label>';
  formHtml += '<label class="input-group" for="newEquipe_'+ formCounter +'">';
  formHtml += '<input type="radio" name="type_'+ formCounter +'" id="newEquipe_'+ formCounter +'" value="Non">Non :</label></div>';
  formHtml += '<div id="content_'+ formCounter +'">';
  formHtml += '<select id="chEq_'+ formCounter +'" name="day[]" style="display:none;">';
  formHtml += '<option value="Lundi">Lundi</option><option value="Mardi">Mardi</option><option value="Mercredi">Mercredi</option>';
  formHtml += '<option value="jeudi">Jeudi</option><option value="Vendredi">Vendredi</option><option value="Samedi">Samedi</option>';
  formHtml += '<option value="Dimanche">Dimanche</option></select>';
  formHtml += '<input class="datepicker-input" type="date" name="date[]" placeholder="date :" id="crEq_'+ formCounter +'" style="display:none;" ></div>';
  formHtml += '<label for="date_debut"> Heure début :</label><input type="time" name="heure_debut[]" id="date_debut_input" required></div><div class="date"><label for="date_fin">  Heure fin :</label><input type="time" name="heure_fin[]" id="date_fin_input" required></div>';
  var newForm = document.createElement('div');
  newForm.innerHTML = formHtml;
  document.getElementById('formulaires').appendChild(newForm);
  var btn1 = document.getElementById("newEquipe_" + formCounter);
  var btn2 = document.getElementById("oldEquipe_" + formCounter);
  var content = document.getElementById("content_" + formCounter);
    btn1.addEventListener('click', function() {
  createElement3(formCounter);});
    btn2.addEventListener('click', function() {
  createElement4(formCounter);});
}
   function createElement3(formCounter){
        document.getElementById("chEq_" + formCounter).style.display="none";
        document.getElementById("crEq_" + formCounter).style.display="block";
    }
    function createElement4(formCounter){
        document.getElementById("crEq_" + formCounter).style.display="none";
        document.getElementById("chEq_" + formCounter).style.display="block";
    }
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