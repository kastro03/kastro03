<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <title>Domov</title>
</head>
<body>


    <?php
if($_SESSION["name"]) {
require_once("C:/xampp/htdocs/Matura_Projekt/layoutHome.php");
    ?>

    <div id="main">
        <div class="center">
             <h1>Dobrodošli v aplikaciji za nogometno ligo</h1>
            <div>
</div>

<?php
}else {
    header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
}

?>
</body>
</html>

