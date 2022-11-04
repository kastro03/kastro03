<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="klubi.css">

    <title>Klubi</title>
</head>
<body>
<?php
    if($_SESSION["name"]) {
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
    ?>

    <div id="main">

    <div class="naslov">
        <h1>Klubi</h1>
    </div>
    
        <div class="row">
            <?php

                $servername = "localhost";
                $username = "root";
                $DBname="matura_projektnogomet";

                $conn=mysqli_connect($servername,$username,"",$DBname);


                $q="SELECT linkLogoVeliki,barva,Imestadiuma FROM ekipa order by naziv";
                $rs=mysqli_query($conn,$q);

                for($i=0;$i<5;$i++){
                    $row=mysqli_fetch_array($rs);
                    $logo=$row["linkLogoVeliki"];
                    $barva=$row["barva"];
                    $stadion=$row["Imestadiuma"];

                echo "<div class='box'>";
                    echo "<div class='logoBox'>";
                        echo "<div class='logo'>";
                            echo "<img src='$logo' height='100px' width='100px'>";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='stadion' style='background-color:$barva'>";
                        echo "<div class='napis'>";
                            echo "Ime stadiona:<br>";
                            echo "$stadion";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                }
            ?>
         </div>

         <div class="row">

                <?php
                    for($i=0;$i<5;$i++){
                        $row=mysqli_fetch_array($rs);
                        $logo=$row["linkLogoVeliki"];
                        $barva=$row["barva"];
                        $stadion=$row["Imestadiuma"];

                        echo "<div class='box'>";
                            echo "<div class='logoBox'>";
                                echo "<div class='logo'>";
                                    echo "<img src='$logo' height='100px' width='100px'>";
                                 echo "</div>";
                            echo "</div>";

                            echo "<div class='stadion' style='background-color:$barva'>";

                            if($barva=="#f5f5f5"){
                                echo "<div class='napis tottenham'>";
                                    echo "Ime stadiona:<br>";
                                    echo "$stadion";
                                echo "</div>";
                            }
                            else{
                                echo "<div class='napis'>";
                                    echo "Ime stadiona:<br>";
                                    echo "$stadion";
                                echo "</div>";
                            }

                            echo "</div>";
  
                        echo "</div>";
                    }

                ?>
                
        </div>

    </div>
<?php
}else {
        header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
        }
        ?>

</body>
</html>