<?php
    session_start();
    $login = $_SESSION['Login'];
    $mdp = $_SESSION['mdp'];
    $reponse=$bdd->prepare('SELECT * FROM responsable WHERE CIN = :CIN AND mot_de_passe = :password');
    $reponse->execute(array(':CIN'=>$login,':password'=>$mdp));
    $data = $reponse->fetch();
    require_once 'connection.php';
    if(isset($_POST['subm']))
    {
        // Data
        $sql='SELECT CIN from user WHERE Nom_equipe IS NULL AND état_inscription="Inscrit"'; 
        $reponse=$bdd->prepare($sql);
        $reponse->execute();
        if($reponse->rowCount()>0){
        $nom = htmlspecialchars($_POST['nom_equipe']);
        $capitCin = htmlspecialchars($_POST['selectChCp']);
        $nb = 1;
        $date = date('Y-m-d');
        $insert = $bdd->prepare('INSERT INTO equipe(Nom_equipe,Date_Creation,nbr_joueurs,id_Respo , Capitaine) VALUES(:NomEq, :DateCreation, :nb_joueurs, :id_Respo, :capit)');
        $insert->execute(array(
                ':NomEq' => $nom,
                 ':DateCreation' => $date,
                 ':nb_joueurs' => $nb,
                 ':id_Respo' => $data[0],
                 ':capit' => $capitCin));
        $Update = $bdd->prepare('UPDATE user set Nom_equipe = :equipe WHERE CIN = :cin');
        $Update->execute(array('cin:' => $capitCin, 'equipe' => $nom));
        $msg_insert = "Equipe insérée avec succés";
        $_SESSION['msg_insert']=$msg_insert;   
    }
    header("Location: equipe.php"); 
}
    //session_destroy();