<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données
    if(isset($_POST['ok'])) // Si il existe les champs email, password et qu'ils sont pas vident
    {
       // $_SESSION['Login']=$_POST['CIN'];
        //$_SESSION['mdp']=$_POST['password'];
        $CIN = htmlspecialchars($_POST['CIN']); 
        $password = htmlspecialchars($_POST['password']);
        $reponse=$bdd->prepare('SELECT * FROM responsable WHERE CIN = :CIN AND mot_de_passe = :password');
        $reponse->execute(array(':CIN'=>$CIN,':password'=>$password));
        if($reponse->rowCount()>0){
            header("Location: ../responsable/pages/main.php");
        }
        else{
            $reponse=$bdd->prepare('SELECT * FROM user WHERE CIN = :CIN AND password = :password');
            $reponse->execute(array(':CIN'=>$CIN,':password'=>$password));
            $data = $reponse->fetch();
           if($reponse->rowCount()>0){
                if($data[7]=='Attente_Respo'||$data[7]=='Attente_Capit')
                    header("Location: Page2.php");
                else{
                    if($data[7]=='Refus_Capit'){
                        $error_msg_refusC = "Votre demande est refusé par le capitaine !!!";
                        $_SESSION['error_msg_refusC']=$error_msg_refusC;
                        header("Location: Login.php");
                    }   
                    else{
                        if($data[7]=='Refus_Respo'){
                        $error_msg_refusR = "Votre demande est refusé par le responsable!!!";
                        $_SESSION['error_msg_refusR']=$error_msg_refusR;
                        header("Location: Login.php");}
                        else{
                            if($data[5]==1&&$data[6]=='EtudiantFso')
                            header("Location: ../responsable/capitaine/indx.php");
                            else{
                                if($data[5]==1&&($data[6]=='FonctionnaireFso'||$data[6]=='Externe'))
                                    echo "Le capitaine d'une equipe des fonctionnaires ou des externes";
                                else{
                                    echo "normal user";
                                }
                            }
                        }
                    }
                }
        }
        else {
           $error_msg_inscription = "Mot de passe ou CIN est incorrect !!!";
           $_SESSION['error_msg_inscription']=$error_msg_inscription;
           header("Location: Login.php");}
    }
    $reponse->closeCursor();}
       