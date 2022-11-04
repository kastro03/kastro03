<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Tekma.css">
    <title>Rezultati</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php   
        if($_SESSION["name"]=="Miha123"){
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
        $servername = "localhost";
        $username = "root";
        $DBname="matura_projektnogomet";

        $conn=mysqli_connect($servername,$username,"",$DBname);
        $currentSeason=1;

        $ID=$_GET["value"];
        $qTekma="SELECT * FROM Tekma where TekmaID=$ID";
        $rsTekma=mysqli_query($conn,$qTekma);
        $row=mysqli_fetch_array($rsTekma);
        $datum=$row["datum"];
        $cas=$row["cas"];
        $domaci=$row["domaci"];
        $gosti=$row["gosti"];
        $DGoli=$row["resFTD"];
        $GGoli=$row["resFTG"];
        $Krog=$row["Krog"];
        $SodnikID=$row["SodnikID"];
        $KapetanD=$row["KapetanD"];
        $KapetanG=$row["KapetanG"];


        $qSodnik="SELECT Ime,Priimek from Sodnik where SodnikID=$SodnikID";
        $rs=mysqli_query($conn,$qSodnik);
        $row=mysqli_fetch_array($rs);
        $imeSodnika=$row["Ime"];
        $priimekSodnika=$row["Priimek"];

        $qStadion="SELECT Imestadiuma from Ekipa where EkipaID=$domaci";
        $rs=mysqli_query($conn,$qStadion);
        $row=mysqli_fetch_array($rs);
        $stadion=$row["Imestadiuma"];

        ?>

    <div id="main" class="center">
        <div class="center">
            <div class="tekma-data center">
                <?php
                    echo $Krog.". Krog | $stadion | $datum ob $cas";
                ?>
            </div>

<?php

$qDomaci="SELECT naziv,linkLogo from Ekipa where EkipaID=$domaci";
$qGosti="SELECT naziv,linkLogo from Ekipa where EkipaID=$gosti";

$rs=mysqli_query($conn,$qDomaci);
$row=mysqli_fetch_array($rs);

$DNaziv=$row["naziv"];
$DLogo=$row["linkLogo"];

$rs=mysqli_query($conn,$qGosti);
$row=mysqli_fetch_array($rs);

$GNaziv=$row["naziv"];
$GLogo=$row["linkLogo"];
?>

        <div class="center">
            <div class="rezultat">
                <div class="row-rezultat">
                    <div class="logo-col center">
                        <?php
                            echo "<img src='$DLogo' height='70px' widht='70'><br>$DNaziv";
                        ?>
                    </div>
                    <div class='rez-col center'>
                        <div class="box center">
                        <?php
                            echo $DGoli;
                        ?>
                        </div>
                    </div>

                    <div class='rez-col center'>
                    <div class="box center">
                        <?php
                            echo $GGoli;
                        ?>
                        </div>
                    </div>

                    <div class='logo-col center'>
                    <?php
                            echo "<img src='$GLogo' height='70px' widht='70'><br>$GNaziv";
                        ?>
                    </div>

                </div>
            </div>
            <div class="row center" style="margin-top: 20px;">
                        Sodnik: <?php echo "<b>$imeSodnika $priimekSodnika</b>";?>
            </div>
        </div>

        <div class="row">
            <div class="col1">
                <div class="center">
                    <?php echo $DNaziv; ?>
                </div>
                <div class="postava">
                    <table style="margin-top: 20px">
                        
                    <?php
                    $q="SELECT i.IgralecID,Ime,Priimek,StevilkaDresa,pozicija from Igralec i inner join tekma_igralec t on (i.IgralecID=t.IgralecID)
                    inner join sezona_igralec s on(s.IgralecID=i.IgralecID) where TekmaID=$ID AND ekipaID=$domaci and kdajJezacev=1 order by StevilkaDresa";
                    $rs=mysqli_query($conn,$q);
                    while($row=mysqli_fetch_array($rs)){
                        $IgralecID=$row["IgralecID"];
                        $imeIgralca=$row["Ime"];
                        $priimekIgralca=$row["Priimek"];
                        $stDresa=$row["StevilkaDresa"];
                        $pos=$row["pozicija"];
                       echo "<tr>";
                           echo "<td style='padding-left: 80px;width:200px'>";
                                echo "$imeIgralca $priimekIgralca";
                          echo "</td>";
                            echo "<td>";
                            if($pos=='vratar' && $IgralecID==$KapetanD)
                                echo $stDresa." (V) (<span style='color:yellow'>K</span>)";
                            else if($pos=='vratar')
                                echo $stDresa." (V)";
                            else if($IgralecID==$KapetanD)
                                echo $stDresa." (<span style='color:yellow'>K</span>)";
                            else
                                echo $stDresa;
                           echo "</td>";
                       echo "</tr>";
                    }
                        ?>
                    </table>
                </div>
            </div>

            <div class="col2">
                <div class="center">
                <?php echo $GNaziv; ?>
                </div>
                <div class="postava">
                    <table style="margin-top: 20px">
                        
                    <?php
                    $q="SELECT i.IgralecID,Ime,Priimek,StevilkaDresa,pozicija from Igralec i inner join tekma_igralec t on (i.IgralecID=t.IgralecID)
                    inner join sezona_igralec s on(s.IgralecID=i.IgralecID) where TekmaID=$ID AND ekipaID=$gosti and kdajJezacev=1 order by StevilkaDresa";
                    $rs=mysqli_query($conn,$q);
                    while($row=mysqli_fetch_array($rs)){
                        $IgralecID=$row["IgralecID"];
                        $imeIgralca=$row["Ime"];
                        $priimekIgralca=$row["Priimek"];
                        $stDresa=$row["StevilkaDresa"];
                        $pos=$row["pozicija"];
                       echo "<tr>";
                           echo "<td style='padding-left: 80px;width:200px'>";
                                echo "$imeIgralca $priimekIgralca";
                          echo "</td>";
                            echo "<td>";
                            if($pos=='vratar' && $IgralecID==$KapetanG)
                                echo $stDresa." (V) (<span style='color:yellow'>K</span>)";
                            else if($pos=='vratar')
                                echo $stDresa." (V)";
                            else if($IgralecID==$KapetanG)
                                echo $stDresa." (<span style='color:yellow'>K</span>)";
                            else
                                echo $stDresa;
                           echo "</td>";
                       echo "</tr>";
                    }
                        ?>
                    </table>
                </div>
            </div>

        </div>
    </div>
            <div class="row" style="margin-top: -25px;">
                <div class="col1-menjave">
                    <div class="center" style="margin-top: 5px;">
                        REZERVNI IGRALCI
                    </div>
                    <div class="rezerve">
                        <table style="margin-top: 20px">
                            <?php
                                $q="SELECT Ime,Priimek,StevilkaDresa,pozicija from Igralec i inner join sezona_igralec s on(i.igralecID=s.IgralecID)
                                 inner join tekma_igralec t on(i.igralecID=t.igralecID) where TekmaID=$ID and kdajJezacev<>1 and ekipaID=$domaci order by StevilkaDresa";
                                  $rs=mysqli_query($conn,$q);
                                  while($row=mysqli_fetch_array($rs)){
                                    $ime=$row["Ime"];
                                    $priimek=$row["Priimek"];
                                    $st=$row["StevilkaDresa"];
                                    $pos=$row["pozicija"];

                                    echo "<tr><td style='padding-left: 80px;width:200px'>$ime $priimek</td>";
                                    echo "<td>";

                                    if($pos=='vratar')
                                        echo $st." (V)";
                                    else
                                        echo $st;
                                    
                                    echo "<td></tr>";
                                  }
                            ?>
                        </table>
                    </div>
                </div>

                <div class="col2-menjave">
                    <div class="center" style="margin-top: 5px;">
                        REZERVNI IGRALCI
                    </div>
                    <div class="rezerve">
                        <table style="margin-top: 20px">
                            <?php
                                $q="SELECT Ime,Priimek,StevilkaDresa,pozicija from Igralec i inner join sezona_igralec s on(i.igralecID=s.IgralecID)
                                 inner join tekma_igralec t on(i.igralecID=t.igralecID) where TekmaID=$ID and kdajJezacev<>1 and ekipaID=$gosti order by StevilkaDresa";
                                  $rs=mysqli_query($conn,$q);
                                  while($row=mysqli_fetch_array($rs)){
                                    $ime=$row["Ime"];
                                    $priimek=$row["Priimek"];
                                    $st=$row["StevilkaDresa"];
                                    $pos=$row["pozicija"];

                                    echo "<tr><td style='padding-left: 80px;width:200px'>$ime $priimek</td>";
                                    echo "<td>";
                                    
                                    if($pos=='vratar')
                                        echo $st." (V)";
                                    else
                                        echo $st;

                                    echo "<td></tr>";
                                  }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="zadetki center">
                    <table>
                        <tr>
                            <td class="first" colspan="4">ZADETKI</td>
                        </tr>
                        <?php
                            $q="SELECT Ime,Priimek,g.igralecID,minuta,opomba from gol g inner join igralec i on(i.IgralecID=g.igralecID) where tekmaID=$ID order by minuta";
                            $rs=mysqli_query($conn,$q);
                            while($row=mysqli_fetch_array($rs)){
                                $IgralecID=$row["igralecID"];
                                $ime=$row["Ime"];
                                $priimek=$row["Priimek"];
                                $min=$row["minuta"];
                            
                            $qLogo="SELECT linkLogo from Ekipa e inner join sezona_igralec s on(e.EkipaID=s.EkipaID) where IgralecID=$IgralecID";
                            $rsLogo=mysqli_query($conn,$qLogo);
                            $rowLogo=mysqli_fetch_array($rsLogo);
                            $logo=$rowLogo["linkLogo"];
                                
                                echo "<tr><td style='padding-left:2px'><i class='fa fa-soccer-ball-o'></i></td>";
                                echo "<td style='padding-left: 20px'><img src='$logo' height='22px' width='22px'></td>";
                                echo "<td style='width:400px; padding-left:20px'>$ime $priimek</td>";
                                echo "<td>$min'";
                                
                                if($row["opomba"]==2)  //2 penal
                                    echo " (P)</td></tr>";
                                
                                else if($row["opomba"]==1) //1 avtogol
                                    echo " (AG)</td></tr>";
                                
                                else
                                    echo "</td></tr>";
                            }
                        ?>
                    </table>
            </div>
            <div class="menjave center">
                <table>
                        <tr>
                            <td class="first" colspan="4">MENJAVE</td>
                        </tr>

                        <?php
                            $qV="SELECT Ime,Priimek,linkLogo,minuta from Igralec i inner join sezona_igralec s on(i.igralecID=S.IgralecID) inner join menjava m on
                            (m.igralecV=I.igralecID) inner join ekipa e on (e.ekipaID=s.ekipaID) where m.TekmaID=$ID order by minuta";
                            $rs=mysqli_query($conn,$qV);

                            $qIZ="SELECT Ime,Priimek from Igralec i inner join sezona_igralec s on(i.igralecID=S.IgralecID) inner join menjava m on
                            (m.igralecIZ=I.igralecID)  where m.TekmaID=$ID order by minuta";
                            $rsIZ=mysqli_query($conn,$qIZ);

      
                            while($row=mysqli_fetch_array($rs))
                            {
                                $rowIZ=mysqli_fetch_array($rsIZ);
                                $imeV=$row["Ime"];
                                $priimekV=$row["Priimek"];
                                $imeIZ=$rowIZ["Ime"];
                                $priimekIZ=$rowIZ["Priimek"];
                                $logo=$row["linkLogo"];
                                $min=$row["minuta"];
                                
                                echo "<tr><td><img src='menjava.png'></td>";
                                echo "<td><img src='$logo' height='22px' width='22px'></td>";
                                echo "<td>$imeV $priimekV | $imeIZ $priimekIZ</td>";
                                echo "<td>$min'</td></tr>";
                            }
                        ?>
                </table>

            </div>

            <div class="kazni center">
            <table>
                        <tr>
                            <td class="first" colspan="4">KAZNI</td>
                        </tr>

                        <?php
                            $q="SELECT Ime,Priimek,minuta,karton,linkLogo from igralec i inner join sezona_igralec s on (i.igralecID=s.igralecID)
                            inner join kazen k on (i.igralecID=k.igralecID) inner join ekipa e on (e.ekipaID=s.EkipaID) where k.TekmaID=$ID order by minuta";

                            $rs=mysqli_query($conn,$q);

                            while($row=mysqli_fetch_array($rs)){
                                $ime=$row["Ime"];
                                $priimek=$row["Priimek"];
                                $min=$row["minuta"];
                                $karton=$row["karton"];
                                $logo=$row["linkLogo"];

                                echo "<tr>";
                                if($karton=='RU')
                                    echo "<td><img src='rumeni_k.jpg'></td>";
                                
                                if($karton=='RD')
                                    echo "<td><img src='rdeci_k.jpg'></td>";
                                
                                    echo "<td><img src='$logo' height='22px' width='22px'></td>";
                                    echo "<td>$ime $priimek</td>";
                                    echo "<td>$min'</td>";
                                echo "</tr>";

                            }
                        ?>
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