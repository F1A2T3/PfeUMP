<?php 
include 'connection.php';

$requete = "SELECT * FROM user";
$res = $connection->query($requete);

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
        <main>
            <div class="head-title">
                <a href="#" class="btn-download">
                    <span class="text">Add</span>
                </a>
            </div>
            <br><br>
            <table>
                <thead>
                    <tr>
                        <th>CIN</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Capitaine</th>
                        <th>Nom équipe</th>
                        <th>id Respo</th>
                        <th>Type</th>
                        <th>Etat inscription</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                                    
                        while ($line = $res->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "
                                <td>$line[CIN]</td>
                                <td>$line[Nom]</td>
                                <td>$line[Prenom]</td>
                                <td>$line[Tel]</td>
                                <td>$line[Capitaine]</td>
                                <td>$line[Nom_equipe]</td>
                                <td>$line[id_Respo]</td>
                                <td>$line[Type]</td>
                                <td>$line[état_inscription]</td>
                                <td class='icons-table'>
                                    <button class='btn-icons trash'><a href='delete.php?id=$line[CIN]'><i class='fas fa-trash'></i></a></button>
                                    <button class='btn-icons pen'><a href='update.php?id=$line[CIN]'><i class='fas fa-pen-square'></i></a></button>
                                </td>
                            ";
                            echo "</tr>";
                        }
                        $res->closeCursor();
                    ?>
                </tbody>
            </table>                  
        </main>
    </section>
    <script src="../scripte/script.js"></script>
</body>
</html>
