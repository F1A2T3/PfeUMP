<?php 
    include "connection.php";
    include "sidebar.php";
    $reponse=$bdd->prepare('SELECT Nom_equipe FROM user WHERE CIN = :CIN AND password = :password');
    $reponse->execute(array(':CIN'=>$login,':password'=>$mdp));
    $data = $reponse->fetch();
    $request = "SELECT CIN, Nom, Prenom, Tel, Nom_equipe, état_inscription, img FROM user WHERE Nom_equipe = :equipeName";
    $res = $bdd->prepare($request);
    $res->execute(array(':equipeName' => $data[0]));
    if (!$res) {
        echo "La récupération des données a rencontré un problème. <br>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste d'équipes</title>
    <link rel="stylesheet" href="../css/tble.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/6404735ed8.js" crossorigin="anonymous"></script>

</head>
<body>
    <section id="content">
        <main>
            <table id="tableau">
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Nom de l'équipe</th>
                    <th>Etat de l'inscription</th>
                </tr>

                <?php 
                    while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>"; 
                        ?>
                            <td><img style="width :100px; height:100px;" src="<?php echo "../" .$ligne['img'];?>" alt=""/></td>
                        <?php 
                          echo "
                            <td>{$ligne['Nom']}</td>
                            <td>{$ligne['Prenom']}</td>
                            <td>0{$ligne['Tel']}</td>
                            <td>{$ligne['Nom_equipe']}</td>
                            <td>{$ligne['état_inscription']}</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </main>
    </section>
    <script>
        function containsString(str, substr) {
              return str.indexOf(substr) > -1;
        }
        function filterTable() {
            var input = document.getElementById("searchCapit");
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
