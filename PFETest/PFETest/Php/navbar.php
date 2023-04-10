<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/navbarStyle.css">
    <title>Document</title>
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
</div>
    <script>
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