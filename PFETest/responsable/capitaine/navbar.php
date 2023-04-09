<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    
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
						<input type="search" placeholder="Search...">
						<button type="submit" class="search-btn">
							<i class='bx bx-search' ></i>
						</button>
						
					</div>
				</form>
				<li>
					<a href="">
						<i class='' ></i>
						<span class="text">Login</span>
					</a>
				</li>			<li>
					<a href="#">
						<i class='' ></i>
						<span class="text">Register</span>
					</a>
				</li>			<li>
					<a href="#">
						<i class='' ></i>
						<span class="text">Admin</span>
					</a>
				</li>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
		
			<a href="#" class="profile">
				<img src="../images/brahim.jpeg">
			</a>
		</nav>
		<!-- NAVBAR -->
    </section>
    
	<script src="../scripte/script.js"></script>
</body>
</html>