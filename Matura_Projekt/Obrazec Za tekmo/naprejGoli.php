<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="naprejGoli.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Goli</title>
</head>
<body>
    <?php
        if($_SESSION["name"]=="Miha123"){
            require_once("C:/xampp/htdocs/Matura_Projekt/layout1.php");
            $servername = "localhost";
            $username = "root";
            $DBname="matura_projektnogomet";
            $conn=mysqli_connect($servername,$username,"",$DBname);
    ?>

            <div id="main">
                <form action="vnosGol.php">
                    <div class="naslovGlavni">
                        <div class="nazaj">
                        </div>
                        <div class="naslovG">
                            <h2>Obrazec za tekmo (Zadetki)</h2>
                        </div>
                        <div class="submit">
                            <button type="submit">
                                <i class="fa fa-arrow-right" style="font-size:40px;color:white;"></i>
                            </button>
                        </div>

                    </div>
        

                    <div class="wrapper">
                        <div class="col">
                            <div class="naslov">
                                <h4>Goli(Domači):</h4>
                            </div>

                            <div class="boxGoli">
                            <?php  
                             $qIgralec="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                             inner join ekipa e on(e.EkipaID=s.ekipaID)
                             inner join igralec i on (s.igralecID=i.igralecID)
                             where e.EkipaID=".$_SESSION["tekma"]["domaci"];
                            
                                    for($i=1;$i<=$_SESSION["tekma"]["FTgoliD"];$i++)
                                    {
                                        $rs=mysqli_query($conn,$qIgralec);
                                    echo "<div class='input-gol-wrapper'>";
                                        echo "<table>";
                                            echo "<tr>";
                                                echo "<td>Igralec:</td>";
                                                echo "<td><select name='DigralecGol$i' style='width: 178px'/>";
                                                while($row=mysqli_fetch_array($rs)){
                                                    $ime=$row["ime"];
                                                    $priimek=$row["priimek"];
                                                    $ID=$row["IgralecID"];
                                                    echo "<option value='$ID'>$ime $priimek</option>";
                                                }
                                        echo "</select></td>";
                                            echo "</tr>";

                                            echo "<tr>";
                                                echo "<td>Minuta:</td>";
                                                echo "<td><input type='number' max='100' name='minutaIgralecD$i' required/></td>";
                                            echo "</tr>";

                                            echo "<tr>";
                                                echo "<td>Penal:</td>";
                                                echo "<td style='text-align:center;'>";
                                                       echo "<input type='radio' name='opombaIgralecD$i' value='2'/>";
                                                    echo "</td>";
                                            echo "</tr>";

                                            echo "<tr>";

                                            echo "<td>Avtogol:</td>";
                                                echo "<td style='text-align:center;'>";
                                                    echo "<input type='radio' name='opombaIgralecD$i' value='1' />";
                                                echo "</td>";
                                            echo "</tr>";


                                        echo "</table>";
                                    echo "</div>";
                                    }
                                ?>
                            </div>

                        </div>

                        <div class="col">
                            <div class="naslov">
                                <h4>Goli(Gosti):</h4>
                            </div>

                            <div class="boxGoli">
                            <?php  
                                    
                                    
                                    $qIgralec="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                                    inner join ekipa e on(e.EkipaID=s.ekipaID)
                                    inner join igralec i on (s.igralecID=i.igralecID)
                                    where e.EkipaID=".$_SESSION["tekma"]["gosti"];
                                    
                                    for($i=1;$i<=$_SESSION["tekma"]["FTgoliG"];$i++)
                                    {
                                        $rs=mysqli_query($conn,$qIgralec);
                                    echo "<div class='input-gol-wrapper'>";
                                        echo "<table>";
                                            echo "<tr>";
                                                echo "<td>Igralec:</td>";
                                                echo "<td><select name='GigralecGol$i' style='width: 178px'/>";
                                                        while($row=mysqli_fetch_array($rs)){
                                                            $ime=$row["ime"];
                                                            $priimek=$row["priimek"];
                                                            $ID=$row["IgralecID"];
                                                            echo "<option value='$ID'>$ime $priimek</option>";
                                                        }
                                                echo "</select></td>";
                                            echo "</tr>";

                                            echo "<tr>";
                                                echo "<td>Minuta:</td>";
                                                echo "<td><input type='number' max='100' name='minutaIgralecG$i'/></td>";
                                            echo "</tr>";

                                            echo "<tr>";
                                                echo "<td>Penal:</td>";
                                                echo "<td style='text-align:center;'>";
                                                       echo "<input type='radio' name='opombaIgralecG$i' value='2'/>";
                                                    echo "</td>";
                                            echo "</tr>";

                                            echo "<tr>";

                                            echo "<td>Avtogol:</td>";
                                                echo "<td style='text-align:center;'>";
                                                    echo "<input type='radio' name='opombaIgralecG$i' value='1' />";
                                                echo "</td>";
                                            echo "</tr>";


                                        echo "</table>";
                                    echo "</div>";
                                    }
                                ?>
                            </div>

                        </div>

                        </div>
                    </div>


                </form>
                <div id="back">
                    <a href="obrazecTekma.php">
                                <button>
                                    <i class="fa fa-arrow-left" style="font-size:40px;color:white;"></i>
                                </button>
                            </a>
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

<?php


?>