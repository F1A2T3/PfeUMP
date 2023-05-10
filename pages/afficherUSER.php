<?php 
include 'connection.php';
$requete = "SELECT * FROM user";
$res = $bdd->query($requete);
if (!$res) {
    echo "La récupération des données a rencontré un problème '<br>'";
}
?>
<?php 
include 'sidebar.php';
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
</head>
<body>
    <h2>Liste of user</h2><br><br><br>
    <section id="content">
        <main style="margin-top: -108px;">
            <div class="table-data">
                <div class="order">
                    <button class="button-7 bx" role="button" style="width: 70px;background-color: rgb(255,253,44);color: #16774a; border-color :rgb(255,253,44);" onclick="window.location.href='AjouterMembre.php'">Ajouter</button>
                    <label for="my-select" class="my-select">Filtrer par état d'inscription :</label>
                    <select id="my-select" name="options" onchange="fct()">
                        <option value="">Sélectionnez une option</option>
                        <option value="Tout">Tout</option>
                        <optgroup label="Attente">
                        <option value="Attente_Respo">En attente responsable</option>
                        <option value="Attente_Capit">En attente capitaine</option>
                        </optgroup>
                        <optgroup label="Terminé">
                        <option value="Inscrit">Inscrit</option>
                        <option value="Refus_Capit">Refusé par capitaine</option>
                        <option value="Refus_Respo">Refusé par responsable</option>
                        </optgroup>
                    </select>   
                    <br> 
                    <?php
                        if (isset($_SESSION['msg_supp'])) {
                            echo '<br>  <span style="color:green;display:block ruby;">'.$_SESSION                           ['msg_supp'].'</span>';
                            unset($_SESSION['msg_supp']);
                        }
                        if (isset($_SESSION['msg_ajout'])) {
                            echo '<br>  <span style="color:red;display:block ruby;">'.$_SESSION                           ['msg_ajout'].'</span>';
                            unset($_SESSION['msg_ajout']);
                        }
                    ?>   <br>
                    <table id="tableau">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Téléphone</th>
                                <th>Nom équipe</th>
                                <th style="display:none;">Etat_inscription</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                                    
                                while ($line = $res->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";?>
                                         <td><img style="width :100px; height:100px;" src="<?php echo "../" .$line['img'];?>" alt=""/></td>
                                    <?php
                                    echo "
                                        <td>$line[Nom]</td>
                                        <td>$line[Prenom]</td>
                                        <td>0$line[Tel]</td>
                                        <td>$line[Nom_equipe]</td>
                                        <td style=\"display:none;\">$line[état_inscription]</td>
                                        <td class='icons-table'>
                                            <a class='status completed' href='profileuser.php?id=$line[CIN]'>profile<i class=''></i></a>
                                        </td>
                                    ";
                                    echo "</tr>";
                                }
                                $res->closeCursor();
                            ?>
                        </tbody>
                    </table> 
                </div>
            </div>                 
        </main>
    </section>
    <script src="../scripte/script.js"></script>
    <script>
      function fct(){
        const selectFilter = document.getElementById('my-select');
        const tableau = document.getElementById('tableau');
        const selectedValue = selectFilter.value;
        for (let i = 1; i < tableau.rows.length; i++) {
            const row = tableau.rows[i];
            const cell = row.cells[5]; 
            if (selectedValue === ''|| selectedValue === 'Tout'|| cell.textContent === selectedValue) {
            row.style.display = ''; 
            } else {
            row.style.display = 'none'; 
            }
        }
        }
        function containsString(str, substr) {
              return str.indexOf(substr) > -1;
        }
        function filterTable() {
            var input = document.getElementById("search");
            var table = document.getElementById("tableau");
            var rows = table.getElementsByTagName("tr");
            if(input.value.toUpperCase() == ""){
                for (var i = 1; i < rows.length; i++){
                    var row = rows[i];
                     row.style.display = "";}
                   }
            else{
             for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var Col = row.getElementsByTagName("td")[1];
                if (Col) {
                   var txtValue = Col.textContent || Col.innerText;
                   if (containsString(txtValue.toUpperCase(),input.value.toUpperCase())) {
                     row.style.display = "";
                    } else {
                       row.style.display = "none";
                    }
                }
            }}
        }
    </script>
</body>
</html>