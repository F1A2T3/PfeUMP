<?php 
        session_start();
    if(isset($_POST['next'])){
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['CIN'] = $_POST['CIN'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['tel'] = $_POST['tel'];
        $_SESSION['password'] = $_POST['password'];
         
        header("location: next.php");
        exit();}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Css/styleLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img src="../Images/avocado-svgrepo-com.svg" style="width: 38px; height: px;" >
               <h2 class="logo">  SpoClub </h2>
                  <nav>
                   <ul id="menuList">
                     <li><a href="">Home</a></li>
                     <li><a href="">Help</a></li>
                     <li><a href="">About us</a></li>
                     <li><a href="">CAP</a></li>
                     <li><a href="">UMP</a></li>
                   </ul>
                  </nav>
                <img src="../Images/burger-checklist-list-menu-navigation-svgrepo-com.svg" class="menu-icon" style="background-color: azure;" onclick="togglemenu()">
        </div>
    <div class="wrapper">
        <div class="form-wrapper sign-in">
            <form name="formSin" action="../Php/connexion.php" method="post">
               <h2 class="signh2">Sign In</h2>
               <div class="input-group">
                 <input name="CIN" class="usernamef" type="text" required>
                  <label for="username">CIN</label>
               </div>
               <div class="input-group">
                 <input name="password" class="passf" type="password" required>
                   <label for="password">password</label>
               </div>
               <button class="btnConex" type="submit" name="ok">Sign In</button>
               <p style="display:none;" id="error">
                 Verifier vos infos!!</p>
               <div class="signup-link">
                 <p>Don't have an account ?<a href="#" class="signUpBtn-link">Sign Up</a></p>
               </div>
            </form>
        </div>
        <div class="form-wrapper sign-up">
            <form name="formSup" method="post" action="">
               <h2 class="signh2">Sign up</h2>
               <div class="input-group">
                <input  type="text" name="nom" required>
                 <label >Nom</label>
              </div>
              <div class="input-group">
                <input type="text" name="prenom" required>
                 <label >Prenom</label>
              </div>
              <div class="input-group">
                <input type="text" name="CIN" required>
                 <label >CIN</label>
              </div>
              <div class="input-group">
                <input type="email" name="email" required>
                 <label>Email</label>
              </div>
              <div class="input-group">
                <input name="tel" type="Tel" required>
                 <label >Phone-number</label>
              </div>
              <div class="input-group">
                 <input type="password" name="password" required>
                   <label>password</label>
              </div>
              
               <button type="submit" name="next" onclick="window.location.href='../Php/next.php'">Next</button>
               <div class="signup-link">
                 <p>Already have an account ?<a href="#" class="signInBtn-link">Sign In</a></p>
               </div>
              </div>
            </form>
        </div>
    </div>
    </div>
    
     <script>
        const signUpBtnLink = document.querySelector('.signUpBtn-link');
        const signInBtnLink = document.querySelector('.signInBtn-link');
        const wrapper =  document.querySelector('.wrapper');
        signUpBtnLink.addEventListener('click', () => {wrapper.classList.toggle('active')});
        signInBtnLink.addEventListener('click', () => {wrapper.classList.toggle('active')});
        var menuList=document.getElementById("menuList");
        menuList.style.maxHeight="0px";
        function togglemenu(){
            if(menuList.style.maxHeight== "0px") 
               menuList.style.maxHeight="130px";
            else 
               menuList.style.maxHeight="0px"
        }
    </script>
</body>
</html>