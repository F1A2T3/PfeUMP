<?php
    session_start();
    require_once 'connection.php';
    $id_terrain = $_SESSION['id_terrain'];
    $nb_formulaires = count($_POST['equipe1']);
    $nb_date = 0;
    $nb_day = 0;
    $err_jeu = 0;
    $err_existe = 0;
    for($i = 0; $i < $nb_formulaires; $i++) {
        $equipe1 = $_POST['equipe1'][$i];
        $type = $_POST['type_'.$i];
        $date_debut = $_POST['heure_debut'][$i];
        $date_fin = $_POST['heure_fin'][$i];
        if($type=="Non"){
            $date = $_POST['date'][$nb_date];
            //echo $date;
            $datestr =  $date . ' ' . $date_debut;
            $datetime = new DateTime($datestr);
            $debut = $datetime->format('Y-m-d H:i:s');    
            $datestr = $date . ' ' . $date_fin;
            $datetime = new DateTime($datestr);
            $fin = $datetime->format('Y-m-d H:i:s');
            $sql = "SELECT COUNT(*) AS count FROM matchclub WHERE temp_debut = :debut AND temp_fin = :fin";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':debut', $debut);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $result['count'];
            if($count==0){
                $sql = "SELECT COUNT(*) AS count FROM matchclub
                WHERE (equipe1 = :equipe OR equipe2 = :equipe)
                AND YEARWEEK(DATE(:date), 1) = YEARWEEK(DATE(temp_debut), 1) AND statut = :statut";
                $statut="accept";
                $stmt = $bdd->prepare($sql);
                $stmt->bindParam(':equipe', $equipe1);
                $stmt->bindParam(':statut', $statut);
                $stmt->bindParam(':date', $debut);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $count2 = $result['count'];
                if(empty($_POST['equipe2'][$i])){
                    if ($count2 > 0) {
                       $nb_jeu = "Notez bien que l'equipe ".$equipe1." a ".$count2." fois matchs dans la semaine ou la date ".$date." se trouve,vous pouvez vérifier les matchs dans votre calendrier.";
                       $_SESSION['nb_jeu'][$err_jeu]=$nb_jeu;
                       $err_jeu =$err_jeu+1;
                     }
                     $sql = "INSERT INTO matchclub (equipe1, equipe2, id_terrain, temp_debut, temp_fin, statut)
                     VALUES (:equipe1, NULL, :id_terrain, :debut, :fin, 'accept')";
                     $stmt = $bdd->prepare($sql);
                     $stmt->bindParam(':equipe1', $equipe1);
                     $stmt->bindParam(':id_terrain', $id_terrain);
                     $stmt->bindParam(':debut', $debut);
                     $stmt->bindParam(':fin', $fin);
                     $stmt->execute();
                }else{
                    $sql = "SELECT COUNT(*) AS count FROM matchclub
                    WHERE (equipe1 = :equipe OR equipe2 = :equipe)
                    AND YEARWEEK(DATE(:date), 1) = YEARWEEK(DATE(temp_debut), 1) AND statut = :statut";
                    $statut="accept";
                    $stmt = $bdd->prepare($sql);
                    $stmt->bindParam(':equipe',$_POST['equipe2'][$i]);
                    $stmt->bindParam(':statut', $statut);
                    $stmt->bindParam(':date', $debut);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count3 = $result['count'];
                    $count4=$count2+$count3;
                    if($count4>0){
                        $nb_jeu = "Notez bien que l'equipe ".$equipe1."et l'equipe ".$_POST['equipe2'][$i]." ont ".$count4." fois matchs dans la semaine ou la date ".$date." se trouve,vous pouvez vérifier les matchs dans votre calendrier.";
                        $_SESSION['nb_jeu'][$nb_date]=$err_jeu;
                        $err_jeu =$err_jeu+1;
                    }
                    $sql = "INSERT INTO matchclub (equipe1, equipe2, id_terrain, temp_debut, temp_fin, statut)
                     VALUES (:equipe1, :equipe2, :id_terrain, :debut, :fin, 'accept')";
                    $stmt = $bdd->prepare($sql);
                    $stmt->bindParam(':equipe1', $equipe1);
                    $stmt->bindParam(':equipe2', $_POST['equipe2'][$i]);
                    $stmt->bindParam(':id_terrain', $id_terrain);
                    $stmt->bindParam(':debut', $debut);
                    $stmt->bindParam(':fin', $fin);
                    $stmt->execute();
                }   
            }
            else{
                if(empty($_POST['equipe2'][$i]))
                  $erreur_exist = "Le match que vous avez planifier de l'equipe ".$equipe1." dans ".$date ."  qui commence ".$date_debut." et qui se termine le ".$date_fin." n'a pas été inséré dans la calendrier, car il existe déjà un autre match prévu pour cette période";
                else{
                  $erreur_exist = "Le match que vous avez planifier entre l'equipe ".$equipe1." et l'equipe".$_POST['equipe2'][$i]."dans ".$date ."  qui commence ".$date_debut." et qui se termine le ".$date_fin." n'a pas été inséré dans la calendrier, car il existe déjà un autre match prévu pour cette période";
                }
                $_SESSION['err_existe'][$err_existe]=$erreur_exist;
                $err_existe =$err_existe+1;
            }
            $nb_date = $nb_date+1;
        }
        else{
            echo $_POST['day'][$nb_day];
            $day_en = frenchToEnglishDay($_POST['day'][$nb_day]);
            echo $day_en;
            $currentMonth = date('n'); 
            $currentYear = date('Y');
            $dayOfWeek = $day_en;
            $dates = array(); 
            if ($currentMonth >= 9) {
                for ($k = $currentMonth; $k <= 12; $k++) {
                    $numDays = date('t', strtotime("$currentYear-$k-01")); 
                        for ($j = 1; $j <= $numDays; $j++) {
                            $date = date('Y-m-d', strtotime("$currentYear-$k-$j"));
                            if (date('l', strtotime($date)) == $dayOfWeek) {
                               $dates[] = $date;
                            }
                        }
                }
                for ($u = 1; $u <= 7; $u++) {
                    $numDays = date('t', strtotime(($currentYear + 1) . "-$u-01")); 
                        for ($j = 1; $j <= $numDays; $j++) {
                            $date = date('Y-m-d', strtotime(($currentYear + 1) . "-$u-$j"));
                            if (date('l', strtotime($date)) == $dayOfWeek) {
                               $dates[] = $date;
                            }
                        }
                }
            } else {
                for ($u = $currentMonth; $u <= 7; $u++) {
                     $numDays = date('t', strtotime("$currentYear-$u-01")); 
                    for ($j = 1; $j <= $numDays; $j++) {
                        $date = date('Y-m-d', strtotime("$currentYear-$u-$j"));
                        if (date('l', strtotime($date)) == $dayOfWeek) {
                            $dates[] = $date;
                        }
                    }
                } 
            }
            print_r($dates);
            $dates_debut = array();
            foreach($dates as $dat) {
               $datetime_str = $dat . ' ' . $date_debut;
               $datetime = new DateTime($datetime_str);
               $dates_debut[] = $datetime->format('Y-m-d H:i:s');
            }
            $dates_fin = array();
            foreach($dates as $dat) {
               $datetime_str = $dat . ' ' . $date_fin;
               $datetime = new DateTime($datetime_str);
               $dates_fin[] = $datetime->format('Y-m-d H:i:s');
            }
            print_r($date_debut);
            print_r($dates_fin);
            $exist=0;
            for($m=0;$m<count($dates_debut);$m++){
                $sql = "SELECT COUNT(*) AS count FROM matchclub WHERE temp_debut = :debut AND temp_fin = :fin";
                $stmt = $bdd->prepare($sql);
                $stmt->bindParam(':debut', $dates_debut[$m]);
                $stmt->bindParam(':fin', $dates_fin[$m]);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $result['count'];
                if($count!=0){
                    $exist=1;
                }
            }
            echo count($dates_debut);
            echo count($dates_fin);
            if($exist==0){
                if(empty($_POST['equipe2'][$i])){
                  for($m=0;$m<count($dates_debut);$m++){
                    $sql = "INSERT INTO matchclub (equipe1, equipe2, id_terrain, temp_debut, temp_fin, statut)
                    VALUES (:equipe1, NULL, :id_terrain, :debut, :fin, 'fixe')";
                    $stmt = $bdd->prepare($sql);
                    $stmt->bindParam(':equipe1', $equipe1);
                    $stmt->bindParam(':id_terrain', $id_terrain);
                    $stmt->bindParam(':debut', $dates_debut[$m]);
                    $stmt->bindParam(':fin', $dates_fin[$m]);
                    $stmt->execute();}
                }else{
                    for($m=0;$m<count($dates_debut);$m++){
                        $sql = "INSERT INTO matchclub (equipe1, equipe2, id_terrain, temp_debut, temp_fin, statut)
                        VALUES (:equipe1, :equipe2, :id_terrain, :debut, :fin, 'fixe')";
                        $stmt = $bdd->prepare($sql);
                        $stmt->bindParam(':equipe1', $equipe1);
                        $stmt->bindParam(':equipe2',$_POST['equipe2'][$i]);
                        $stmt->bindParam(':id_terrain', $id_terrain);
                        $stmt->bindParam(':debut', $dates_debut[$m]);
                        $stmt->bindParam(':fin', $dates_fin[$m]);
                        $stmt->execute();
                    }
                }
            }else{
                if(empty($_POST['equipe2'][$i]))
                  $erreur_exist = "Le match fixe que vous avez planifier de l'equipe ".$equipe1." dans ".$_POST['day'][$nb_day]."  qui commence ".$date_debut." et qui se termine le ".$date_fin." n'a pas été inséré dans la calendrier, car il existe déjà un autre match prévu pour cette période";
                else{
                  $erreur_exist = "Le match fixe que vous avez planifier entre l'equipe ".$equipe1." et l'equipe".$_POST['equipe2'][$i]."dans ".$_POST['day'][$nb_day]."  qui commence ".$date_debut." et qui se termine le ".$date_fin." n'a pas été inséré dans la calendrier, car il existe déjà un autre match prévu pour cette période";
                }
                $_SESSION['err_existe'][$err_existe]=$erreur_exist;
                $err_existe =$err_existe+1;
            }

            $nb_day=$nb_day+1;
        }
    }
    function frenchToEnglishDay($day) {
        switch($day) {
          case 'Lundi':
            return 'Monday';
          case 'Mardi':
            return 'Tuesday';
          case 'Mercredi':
            return 'Wednesday';
          case 'Jeudi':
            return 'Thursday';
          case 'Vendredi':
            return 'Friday';
          case 'Samedi':
            return 'Saturday';
          case 'Dimanche':
            return 'Sunday';
          default:
            return '';
        }
      }
?>
