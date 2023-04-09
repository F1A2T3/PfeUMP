<?php
// Paramètres de connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Connexion à la base de données en utilisant PDO
try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  // Configuration de PDO pour afficher les erreurs SQL
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("La connexion à la base de données a échoué : " . $e->getMessage());
}

// Récupération des informations personnelles de l'utilisateur
$user_id = 1; // L'identifiant de l'utilisateur à récupérer
$sql = "SELECT CIN, Nom, Prenom, Tel, img FROM user WHERE CIN = :F1212";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':F1212', $user_id);
$stmt->execute();


?>


<?php 
    include "sidebar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <link rel="stylesheet" href="../css/profil.css"> 
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section id="content">
        <main>
            <div class="head-title">
                <div class="container emp-profile">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="../images/brahim.jpeg" alt=""/>
                                    <div class="file btn btn-lg btn-primary">
                                        Change Photo
                                        <input type="file" name="file"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                            <h5>
                                                les information personnel 
                                            </h5>
                                            <h6>
                                                Web Developer and Designer
                                            </h6>
                                            <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-work">

                                </div>
                            </div>

                            
                            <!--CODE PHP -->
                            <?php 
                                if ($stmt->rowCount()>0) {
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $CIN = $row["CIN"];
                                    $nom = $row["Nom"];
                                    $prenom = $row["Prenom"];
                                    $telephone = $row["Tel"];
                                    
                                    $image = $row["img"];
                                
                            ?>

                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>CIN</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php $CIN ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php $nom .' '.$prenom?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php $email?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Phone</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php $telephone?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>image</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><?php $image?></p>
                                                    </div>
                                                </div>
                                                <?php 

                                                }
                                                ?>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Experience</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Expert</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Hourly Rate</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>10$/hr</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Total Projects</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>230</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>English Level</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Expert</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Availability</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>6 months</p>
                                                    </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Your Bio</label><br/>
                                                <p>Your detail description</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>           
                </div>
            </div>
        </main>
    </section>
</body>
</body>
</html>