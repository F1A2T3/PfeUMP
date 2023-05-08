<?php
    session_start();
    require_once 'connection.php';
    if(isset($_POST['subm']))
    {
        // Data
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST ['email']);
        $password = htmlspecialchars($_POST['password']);
        $CIN = htmlspecialchars($_POST['CIN']);
        $tel = htmlspecialchars($_POST['tel']);
        $Fonctionnalite = htmlspecialchars($_POST['Fonctionnalite']);
        $equipe = htmlspecialchars($_POST['equipe']);
        //Image Traitement
        $target_dir = "../../Uploads/";
        $target_file = $target_dir.basename($_FILES["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $chek = getimagesize($_FILES["img"]["tmp_name"]);
        if($chek!==false){
            echo "File is an image - ".$chek["mime"].".";
            $uploadOk=1;
        } else {
            echo "File is not an image.";
            $uploadOk=0;
        }
        if(file_exists($target_file)){
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if($_FILES["img"]["size"] > 500000000){
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($imageFileType!="jpg"&&$imageFileType!="jpeg"&&$imageFileType!="pnj"){
            echo "Sorry, only jpg,jpge,pnj files are allowed";
            $uploadOk = 0;
        }
        if($uploadOk==0){
            echo "Sorry, your file is not uploaded";
        }
        else{
            if(move_uploaded_file($_FILES["img"]["tmp_name"],$target_file)){
                echo "The file".basename($_FILES["img"]["name"])."has been uploaded";
            }else
                echo "Sorry, ";
        }
       /* echo "Informations receved nom :".$nom."prenom :".$prenom."email :".$email."password :".$password."CIN :".$CIN."tel :".$tel."Fonctionnaite :".$Fonctionnalite."equipe :".$equipe."image : ".$target_file;*/
        //verification
        $check = $bdd->prepare('SELECT CIN, password FROM user WHERE CIN = :CIN AND password = :password');
        $check->execute(array('CIN' => $CIN, 'password' => sha1($password)));
        $data = $check->fetchAll();
        $row = $check->rowCount();
        if($row==0){
            echo "Gooood";
            $equipeName = "equip";
            //$capi = 0;
            $etat = "Non_Inscrit";
            if($equipe == 'newEquipe'){
                //echo "Cccc";
                $equipeName=htmlspecialchars($_POST['equipeName']);
                //echo "Brooooo".$equipeName;
                $check1 = $bdd->prepare('SELECT * FROM equipe where Nom_equipe = :equipeName');
                $check1->execute(array('equipeName' => $equipeName));
                $data1 = $check1->fetchAll();
                $row1 = $check1->rowCount();
                if($row1==0){
                    echo "Good";
                    $nb = 0;
                    $date = date('Y-m-d');
                    $etat = "Inscrit";
                    $capi =1;
                    $insertEq = $bdd->prepare('INSERT INTO equipe(Nom_equipe,Date_Creation,nbr_joueurs) VALUES(:equipeName,CURDATE(),:nb)');
                    $insertEq->execute(array(
                        ':equipeName' => $equipeName,
                        ':nb' => $nb
                    ));
                    //echo "equipe inserted";
                }
                else {
                        $error_msg_equipe = "Le nom d'equipe que vous avez choisi existe déja";
                        $_SESSION['error_msg_equipe']=$error_msg_equipe;
                        header("Location: AjouterMembre.php");
                        goto fin;
                    }
                    }
            else{
                    $etat = "Inscrit";
                    $capi = 0;
                    $equipeName = htmlspecialchars($_POST['selectChEq']);
                    $reponse=$bdd->prepare('SELECT u.Type FROM user u,equipe e WHERE e.Capitaine = u.CIN AND Nom_equipe = :equipe');
                    $reponse->execute(array(':equipe'=>$equipeName));
                    $data = $reponse->fetch();
                    if($data[0] != $Fonctionnalite){
                        $error_msg_type = "L'equipe " .$equipeName. "n'est pas une equipe des " .$Fonctionnalite;
                        $_SESSION['error_msg_type']=$error_msg_type;
                        header("Location: AjouterMembre.php");
                        goto fin;
                    }
                }
                $passwordCrypt = sha1($password);
                $insert = $bdd->prepare('INSERT INTO user(CIN,Nom,Prenom,Tel, Email,Type,état_inscription, password, Nom_equipe,img) VALUES(:CIN, :nom, :prenom, :tel, :email, :type, :etat, :password, :equipeName, :img)');
                $insert->execute(array(
                        ':CIN' => $CIN,
                        ':nom' => $nom,
                        ':prenom' => $prenom,
                        ':tel' => $tel,
                        ':email' => $email,
                        ':type' => $Fonctionnalite,
                        ':etat' => $etat,
                        ':password' => $passwordCrypt,
                        ':equipeName' => $equipeName,
                        ':img' => $target_file));
                if($capi == 1){
                    $Update = $bdd->prepare('UPDATE equipe set Capitaine = :cin WHERE Nom_equipe = :equipe');
                    $Update->execute(array('cin' => $CIN, 'equipe' => $equipeName));
                }
                $msg_ajout = "Membre ajouté avec succés";
                $_SESSION['msg_ajout']=$msg_ajout;
                header("Location: afficherUSER.php");    
        }
        else {
           $error_msg_inscription = "Il est déja inscrit";
           $_SESSION['error_msg_inscription']=$error_msg_inscription;
           header("Location: AjouterMembre.php");
        }
    }
    fin:
    //session_destroy();