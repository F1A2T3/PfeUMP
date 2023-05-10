<?php
// Récupération des données du formulaire
$nom_equipe1 = $_POST['nom_equipe1'];
$nom_equipe2 = $_POST['nom_equipe2'];
$sport = $_POST['sport'];
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
    // Insertion des données dans la base de données
    for ($i = 0; $i < count($nom_equipe1); $i++) {
        $requete = "INSERT INTO matchclub (equipe1, equipe2, id, date_debut, date_fin) VALUES (:nom_equipe1, :nom_equipe2, :sport, :date_debut, :date_fin)";
        $statement = $connexion->prepare($requete);
        $statement->bindParam(':nom_equipe1', $nom_equipe1[$i]);
        $statement->bindParam(':nom_equipe2', $nom_equipe2[$i]);
        $statement->bindParam(':sport', $sport[$i]);
        $statement->bindParam(':date_debut', $date_debut[$i]);
        $statement->bindParam(':date_fin', $date_fin[$i]);
        $statement->execute();
    }

    // Réponse à la requête AJAX
    echo "Les données ont été enregistrées avec succès !";
// Fermeture de la connexion
$connexion = null;
?>