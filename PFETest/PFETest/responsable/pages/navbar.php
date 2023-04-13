<?php 
	session_start();
	require_once 'connection.php';
    $login = $_SESSION['Login'];
    $mdp = $_SESSION['mdp'];
    $reponse=$bdd->prepare('SELECT * FROM responsable WHERE CIN = :CIN AND mot_de_passe = :password');
    $reponse->execute(array(':CIN'=>$login,':password'=>$mdp));
    $data = $reponse->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-D2uAk7VJbM8wqZPsdvAaKJElKs4l2W4c9/svF1Hn7h/4gTsyTklZpTj+OBCxrRa7+nWfge8lwv7VGPYQaGz7Ng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/nav.css">
	
</head>
<body>
    <section id="content">
        <nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
				<form action="#">
					<div class="form-input">
						<input type="search" placeholder="Search..." id="search" onkeyup="filterTable()">
						<button type="submit" class="search-btn">
							<i class='bx bx-search' ></i>
						</button>
					</div>
				</form>
				<div class="notification ">
                     <i class="bx bxs-bell"></i>
                     <?php
                    $sql = "SELECT COUNT(*) AS nombre_demandes FROM user WHERE état_inscription = ?";
			        $stmt = $bdd->prepare($sql);
			        $stmt->execute(array("Attente_Respo"));
			        $nombreDemandes = $stmt->fetchColumn();
                      if ($nombreDemandes > 0) {
                          echo '<span class="num">' . $nombreDemandes . '</span>';
                        }
					//   else{
					// 	echo '<span class="num"> 0</span>';
					//   }
                      ?>
                    </span>
                </div>

			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
		
			<a href="#" class="profile">
				<img src="<?php echo $data[6];?>">
			</a>
		</nav>
		<!-- NAVBAR -->
    </section>
    
	<script src="../scripte/script.js"></script>
</body>
</html>