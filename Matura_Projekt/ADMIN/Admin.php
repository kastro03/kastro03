<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <title>ADMIN</title>
</head>
<body>
    
<?php
if($_SESSION["name"]=="Miha123") {
    require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");


?>

    <div id="main">
        <div class="box">
            <h2>Pozdravljeni 
            <?php
            $x=$_SESSION["name"];
            echo "<span style='color: blue'>$x</span>";
            ?>
            </h2>
        </div>
        <div>
            <div class="row">
               <a href="http://localhost/Matura_Projekt/Obrazec za igralca/ObrazecIgralec.php"><button class="gumb">Dodaj Igralca</button></a>
            </div>
            <div class="row">
                <a href="http://localhost/Matura_Projekt/Obrazec Za tekmo/obrazecTekma.php"><button class="gumb">Dodaj Tekmo</button></a>
            </div>
            <div class="row">
                <?php
                if(!empty($_SESSION["msg"]))
                echo $_SESSION["msg"];
                ?>
            </div>
        </div>


    </div>


<?php
}
else{
    header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
}
    ?>
</body>
</html>