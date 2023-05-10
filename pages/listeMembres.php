<?php 
include 'connection.php';

// Vérifier si le nom de l'équipe a été envoyé en paramètre
if(isset($_GET['equipe'])) {
    $nom_equipe = trim($_GET['equipe']);

    // Requête pour récupérer les membres de l'équipe
    $requete = "SELECT * FROM user WHERE Nom_equipe = :nom_equipe";
    $res = $bdd->prepare($requete);
    $res->execute(array(':nom_equipe' => $nom_equipe));

    if (!$res) {
        echo "La récupération des données a rencontré un problème '<br>'";
    }
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
    <title>Liste des membres de l'équipe <?php echo $nom_equipe; ?></title>
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
   
    <section id="content">
    <main><h2 style="text-align: center;">Liste des membres de l'équipe <?php echo $nom_equipe; ?></h2><br><br>
        <div  class="table-data">
            
                <div class="order">
                    <table id="tableau">
                        <thead>
                            <tr>
                                <th>CIN</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Téléphone</th>
                                <th>Nom équipe</th>
                                <th>Etat d'inscription</th>
                                <th>Profil</th>
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
                                        <td>$line[Nom_equipe]</td>
                                        <td>$line[état_inscription]</td>
                                        <td class='icons-table'>
                                            <a class='status completed' href='profileuser.php?id=$line[CIN]'>profile<i class=''></i></a>
                                        </td>
                                    ";
                                    echo "</tr>";
                                }
                                $res->closeCursor();
                            ?>
                        </tbody>
                    </div>
                </div>
            </table>                  
        </main>
    </section>
    <script src="../scripte/script.js"></script>
</body>
</html>