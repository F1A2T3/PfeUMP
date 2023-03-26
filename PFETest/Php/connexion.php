<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(isset($_POST['ok'])) // Si il existe les champs email, password et qu'ils sont pas vident
    {
        $_SESSION['CIN']=$_POST['CIN'];
        $_SESSION['password']=$_POST['password'];
        $CIN = htmlspecialchars($_POST['CIN']); 
        $password = htmlspecialchars($_POST['password']);
        $reponse=$bdd->prepare('SELECT * FROM responsable WHERE CIN = :CIN AND password = :password');
        $reponse->execute(array(':CIN'=>$CIN,':password'=>$password));
        if($reponse->rowCount()>0){
            echo "I'm an admin";
        }
        else{
            $reponse=$bdd->prepare('SELECT * FROM user WHERE CIN = :CIN AND password = :password');
            $reponse->execute(array(':CIN'=>$CIN,':password'=>$password));
            $data = $reponse->fetch();
           if($reponse->rowCount()>0){
                if($data[7]=='Attente_Respo'||$data[7]=='Attente_Capit')
                      echo "Attente de validation de votre demande";
                else{
                    if($data[7]=='Refus_Capit')
                        echo "Refus du capitaine";
                    else{
                        if($data[7]=='Refus_Respo')
                            echo "Refus du responsable";
                        else{
                            if($data[5]==1&&$data[6]=='EtudiantFso')
                                echo "Le capitaine d'une equipe des etudiants";
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
            /*echo 
            "<script>
               document.getElementById('error').style.display='block';
               document.getElementById('error').style.color='red';
               </script>";*/
        }
        else 
           echo "vous n'etes pas inscrit";
    }
    $reponse->closeCursor();}
       