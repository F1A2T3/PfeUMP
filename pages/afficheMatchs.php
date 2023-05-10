<?php 
include 'connection.php';
$requete = "SELECT * FROM matchclub";
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
                    <label for="my-select" id="my-select">Filtrer par terrain :</label>
                    <select id="elect" name="options" onchange="fct1()">
                        <option value="">Sélectionnez un terrain</option>
                        <option value="Tout">Tout</option>
                        <option value="Foot">Foot</option>
                        <option value="Basket">Basket</option>
                        <option value="Volley">Volley</option>
                    </select>  
                    <label for="mySe" class="mySe">Filtrer par état :</label>
                    <select id="mySe" name="options" onchange="fct()">
                        <option value="">Sélectionnez une option</option>
                        <option value="Tout">Tout</option>
                        <optgroup label="Attente">
                        <option value="attente_respo">En attente responsable</option>
                        <option value="attente_capit">En attente capitaine</option>
                        </optgroup>
                        <optgroup label="Terminé">
                        <option value="accept">Acceptée</option>
                        <option value="refus">Refusée</option>
                        <option value="fixe">Fixe toute l'année</option>
                        </optgroup>
                    </select> 
                    <br> 
                    <?php
                        if (isset($_SESSION['acceptReserv'])) {
                            echo '<br>  <span style="color:yellow;display:block ruby;">'.$_SESSION                           ['acceptReserv'].'</span>';
                            unset($_SESSION['acceptReserv']);
                        }

                        if (isset($_SESSION['erreurReserv'])) {
                            echo '<br>  <span style="color:red;display:block ruby;">'.$_SESSION                           ['erreurReserv'].'</span>';
                            unset($_SESSION['erreurReserv']);
                        }

                        if (isset($_SESSION['refusReserv'])) {
                            echo '<br>  <span style="color:orange;display:block ruby;">'.$_SESSION                           ['refusReserv'].'</span>';
                            unset($_SESSION['refusReserv']);
                        }
                    ?>    
                    <br>
                    <table id="tableau">
                        <thead>
                            <tr>
                                <th>Equipe 1</th>
                                <th>Equipe 2</th>
                                <th>Terrain</th>
                                <th>Date</th>
                                <th>Debut Match</th>
                                <th>Fin Match</th>
                                <th>Etat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                                    
                                while ($line = $res->fetch(PDO::FETCH_ASSOC)) {
                                    if($line['id_terrain']==1){
                                        $terrain = "Foot";
                                    }
                                    else{
                                        if($line['id_terrain']==2){
                                            $terrain = "Basket";
                                        }
                                        else{
                                            $terrain = "Volley";
                                        }
                                    }
                                    $date = date('d/m/y',strtotime($line['temp_debut']));
                                    $debut = date('H:i', strtotime($line['temp_debut']));
                                    $fin = date('H:i', strtotime($line['temp_fin']));
                                    echo "<tr>";
                                    echo "
                                        <td>$line[equipe1]</td>
                                        <td>$line[equipe2]</td>
                                        <td>$terrain</td>
                                        <td>$date</td>
                                        <td>$debut</td>
                                        <td>$fin</td>
                                        <td>$line[statut]</td>
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
      
    function fct1() {
      const select = document.getElementById('elect');
      const option = select.value;
      const table = document.getElementById('tableau');

      for (let i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var cell = row.cells[2];

        if (option === '' ||option === 'Tout'|| cell.textContent === option) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      }
    }
      function fct(){
        const selectFilter = document.getElementById('mySe');
        const tableau = document.getElementById('tableau');
        const selectedValue = selectFilter.value;
        for (let i = 1; i < tableau.rows.length; i++) {
            const row = tableau.rows[i];
            const cell = row.cells[6]; 
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
                var Col = row.getElementsByTagName("td")[0];
                var Col2 = row.getElementsByTagName("td")[1];
                if (Col) {
                   var txtValue = Col.textContent || Col.innerText;
                   var txtValue2 = Col2.textContent || Col2.innerText
                   if (containsString(txtValue.toUpperCase(),input.value.toUpperCase()) || containsString(txtValue2.toUpperCase(),input.value.toUpperCase())) {
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