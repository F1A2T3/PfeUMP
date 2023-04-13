<?php 

include 'connection.php';

$requet="SELECT * from equipe ";
$res=$bdd->query($requet);

if (!$res) {
    echo "la recuperation des donnees a ricintre un probleme '<br>'" ;
}

?>

<?php 
    //include 'navbar.php';
    include('sidebar.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/tble.css">
	<link rel="stylesheet" href="../css/nav.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/6404735ed8.js" crossorigin="anonymous"></script>

    
</head>
<body>
    <h2>liste of Team</h2>
    <section id="content">
        <main>
            <div class="head-title">
            <button class="button-7 bx" role="button" style="width: 70px;background-color: #16774a;color: rgb(225, 253, 44); border-color :#16774a;">Ajouter</button>  
                <br><br>
                <table style="border-radius='2'" id="tableau">
                    <tr>
                        <th>Nom Equipe</th>
                        <th>la date de creation</th>
                        <th>Nombre de joueur</th>
                        <th>id</th>
                        <th>Capitaine</th>
                    </tr>
                    <?php
                        while ($line = $res->fetch(PDO::FETCH_NUM)) {
                            echo "<tr>";
                            foreach ($line as $value) {
                                echo "<td>$value</td>";
                            }
                            echo "
                            <td class='icons-table'>
                                <button class='btn-icons trash'><i class='fa-sharp fa-solid fa-trash'></i></button>
                                <button class='btn-icons pen'><i class='fa-sharp fa-solid fa-pen-to-square'></i></button>
                            </td>
                            ";
                            echo "</tr>";
                        }
                    ?>
                </table>
                <?php $res->closeCursor()?>
                <?php 
                    //include 'sidebar.php'
                ?>
            </div>
        </main>
    </section>
    <link rel="stylesheet" href="../scripte/sidenav.js">
	<script src="../scripte/script.js"></script>
    <script>
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