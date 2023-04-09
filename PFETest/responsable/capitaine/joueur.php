<?php 
    include "connection.php";

    $request = "SELECT CIN, Nom, Prenom, Tel, Nom_equipe, état_inscription, img FROM user";
    $res = $connection->query($request);

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
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Nom de l'équipe</th>
                    <th>Etat de l'inscription</th>
                    <th>Statut</th>
                </tr>

                <?php 
                    while ($ligne = $res->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>"; 
                        echo "
                            <td>{$ligne['Nom']}</td>
                            <td>{$ligne['Prenom']}</td>
                            <td>{$ligne['Tel']}</td>
                            <td>{$ligne['Nom_equipe']}</td>
                            <td>{$ligne['état_inscription']}</td>";
                            //echo "<td class='icons-table'>
                               // <button class='btn-icons trash'><a href='delete.php?id={$ligne['id']}'><i class='fa-sharp fa-solid fa-trash'></i></a></button>
                               // <button class='btn-icons pen'><a href='edit.php?id={$ligne['id']}'><i class='fa-sharp fa-solid fa-pen-to-square'></i></a></button>
                            //</td>
//";
                        echo "</tr>";
                    }
                ?>
            </table>
        </main>
    </section>

</body>
</html>
