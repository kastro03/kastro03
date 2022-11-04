<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="http://localhost/Matura_Projekt/layout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home</title>
</head>
<body>
    <div class="container">
        <div class="icon"><button onclick="openNav()">&#9776;</button></div>       
    </div>
 
        <div id="menu" class="sidemenu">
            <a href="http://localhost/Matura_Projekt/home.php">Domov</a>
            <a href="http://localhost/Matura_Projekt/Lestvica/lestvica.php">Lestvica</a>
            <a href="http://localhost/Matura_Projekt/Rezultati/Rezultati.php">Rezultati</a>
            <a href="http://localhost/Matura_Projekt/ListaStrelcev/ListaStrelcev.php">Lista Strelcev</a>
            <a href="http://localhost/Matura_Projekt/Klub/klubi.php">Klubi</a>
            <a href="http://localhost/Matura_Projekt/Igralci/igralci.php">Igralci</a>
            <a href="http://localhost/Matura_Projekt/Trenerji/trenerji.php">Trenerji</a>
            <a href="http://localhost/Matura_Projekt/Sodniki/sodniki.php">Sodniki</a>
            <a href="http://localhost/Matura_Projekt/logout.php">Odjava</a>
            <?php
                if($_SESSION["name"]=='Miha123') {
                   echo '<a style="color:red;"href="http://localhost/Matura_Projekt/Admin/admin.php">ADMIN</a>';
                }
            ?>
            <div class="uporabnik">
               Prijavljen: <?php $x=$_SESSION['name']; echo "<span style='color:yellow'>$x</span>"; ?>
                <a href="http://localhost/Matura_Projekt/NastavitveUporabnika/nastavitveUporabnika.php">
                    <i class="fa fa-gear" style="font-size:20px; color:lightblue"></i> NASTAVITVE
                </a>
            </div>
        </div>
        

        <script>
let t=false;
            
            function openNav()
            {
               
                if(t==false){
                document.getElementById("menu").style.width="300px";
                document.getElementById("main").style.marginLeft="300px";
                    t=true;
                }
                
               else{
                document.getElementById("menu").style.width="0";
                document.getElementById("main").style.marginLeft="0";
                t=false;
               }
            }

        </script>


