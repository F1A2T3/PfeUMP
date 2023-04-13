<?php 
    include 'sidebar.php';
	$sql = "SELECT COUNT(*) AS nb_users FROM user WHERE état_inscription = ?";
	$stmt = $bdd->prepare($sql);
	$stmt->execute(array("Inscrit"));
	$nb_users = $stmt->fetchColumn();
	$sql = "SELECT COUNT(*) AS nb_demandes FROM user WHERE état_inscription = ?";
	$stmt = $bdd->prepare($sql);
	$stmt->execute(array("Attente_Respo"));
	$nb_Demmandes = $stmt->fetchColumn();
	$sql = "SELECT COUNT(*) AS nb_equipes FROM equipe WHERE nbr_joueurs != 0";
	$stmt = $bdd->prepare($sql);
	$stmt->execute();
	$nb_equipes = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>
    
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
  <<link rel="stylesheet" href="https://kit.fontawesome.com/6404735ed8.css" crossorigin="anonymous">title>Document</title>

</head>
<body>
	<section id="content">
    	<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>

			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?=$nb_Demmandes?></h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?=$nb_users?></h3>
						<p>Members</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3><?$nb_equipes?></h3>
						<p>Equipes</p>
					</span>
				</li>
			</ul>   
<style>
    @import url("https://fonts.googleapis.com/css?family=Lato:400,700&display=swap");
    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }

    th, td {
      text-align: left;
      padding: 16px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    .icons-table{
      display: flex;
      justify-content: space-around;
    }
    .btn-icons i {
      font-size: 1.5em;
    }
    .plus i{
      color: powderblue;
    }
    .trash i{
      color: tomato;
    }
    .pen i{
      color: forestgreen;
    }

    .Tablebtns {
        display: flex;
    }
    .Tablentn {
        padding: 1em;
        background-color: rgb(157 151 151 / 73%);
        margin: 12px;
        border-radius: 12px;
        cursor: pointer;
        font-family: sans-serif;
        font-size: 0,8em;
        font-weight: 700;
    }


    body.dark {
    --light: #2f2f36;
    --grey: #273048;
    --dark: #cdcd90fc;
}

   </style>
    <!--
				</div>
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
    -->


		</main>

	</section>

	<script src="../scripte/script.js"></script>
  <script src="https://kit.fontawesome.com/6404735ed8.js" crossorigin="anonymous"></script>


</body>

</html>