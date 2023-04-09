<?php
include 'connection.php';

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $cin = $_POST['CIN'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $tel = $_POST['Tel'];
    $capitaine = $_POST['Capitaine'];
    $nomEquipe = $_POST['nom_equie'];
    $idRespo = $_POST['id_Respo'];
    $type = $_POST['Type'];
    $etatInscription = $_POST['etat_inscription'];
    
    // Update query
    $query = "UPDATE users SET CIN='$cin', Nom='$nom', Prenom='$prenom', Tel='$tel', Capitaine='$capitaine', nom_equie='$nomEquipe', id_Respo='$idRespo', Type='$type', etat_inscription='$etatInscription' WHERE id='$id'";
    
    // Execute the query
    if($connection->query($query)){
        header('location: index.php');
    }else{
        echo "Error updating record: " . $connection->error;
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    // Select the record that needs to be updated
    $query = "SELECT * FROM users WHERE id=$id";
    $result = $connection->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    $connection = null;
    //header('location:afficherUSER.php')
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>CIN:</label>
        <input type="text" name="CIN" value="<?php echo $row['CIN']; ?>"><br><br>
        <label>Nom:</label>
        <input type="text" name="Nom" value="<?php echo $row['Nom']; ?>"><br><br>
        <label>Prenom:</label>
        <input type="text" name="Prenom" value="<?php echo $row['Prenom']; ?>"><br><br>
        <label>Tel:</label>
        <input type="text" name="Tel" value="<?php echo $row['Tel']; ?>"><br><br>
        <label>Capitaine:</label>
        <input type="text" name="Capitaine" value="<?php echo $row['Capitaine']; ?>"><br><br>
        <label>Nom equipe:</label>
        <input type="text" name="nom_equie" value="<?php echo $row['nom_equie']; ?>"><br><br>
        <label>Id respo:</label>
        <input type="text" name="id_Respo" value="<?php echo $row['id_Respo']; ?>"><br><br>
        <label>Type:</label>
        <input type="text" name="Type" value="<?php echo $row['Type']; ?>"><br><br>
        <label>Etat d'inscription:</label>
        <input type="text" name="etat_inscription" value="<?php echo $row['etat_inscription']; ?>"><br><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>

<?php }  ?>
