<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");

session_destroy();
?>