<?php
   session_start();
   session_destroy();
   header("Location: ../../Php/Index1.php");
?>