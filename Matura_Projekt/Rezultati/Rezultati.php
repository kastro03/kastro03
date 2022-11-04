<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Rezultati.css">
    <title>Rezultati</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        ?>

<div id="main">
    <div class="center">
        <h1>Rezultati</h1>
    </div>
<div class="center">
    <div class="selectSezona">
                <?php
                        $q="SELECT SezonaID,naziv from sezona";
                        $rs=mysqli_query($conn,$q);

                        echo "<select name='sezona'>";
                        while($row=mysqli_fetch_array($rs)){
                            $naziv=$row["naziv"];
                            $ID=$row["SezonaID"];
                            echo "<option value='$ID'>$naziv</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
            </div>

    <div class="center">
            <?php
                $q="SELECT distinct Krog from tekma order by krog asc";
                $rs=mysqli_query($conn,$q);

                while($row=mysqli_fetch_array($rs))
                {
                    $k=$row["Krog"];
                   
                    
                    $qTekma="SELECT domaci,gosti,resFTD,resFTG,TekmaID from tekma where Krog=$k AND Sezona=$currentSeason";
                    
                    $resTekma=mysqli_query($conn,$qTekma);
                  


                    ///////////////////////////////////////////////////////////////////////
                    echo "<table style='margin-top:30px'>";
                    echo "<tr><td class='first' colspan='6'>$k. KROG</td></tr>";
                    while( $rowTekma=mysqli_fetch_array($resTekma)){


                    
                        $TekmaID=$rowTekma["TekmaID"];
                        //DOMACI ////////////////////////////////////////////////////////////////
                        $DEkipaID=$rowTekma["domaci"];
                        $DGoli=$rowTekma["resFTD"];
    
                        $qEkipaD="SELECT linkLogo,naziv from ekipa WHERE EkipaID=$DEkipaID";
    
                        $resEkipaD=mysqli_query($conn,$qEkipaD);
                        $rowD=mysqli_fetch_array($resEkipaD);
    
                        $DNaziv=$rowD["naziv"];
                        $DLogo=$rowD["linkLogo"];
    
                        //GOSTI /////////////////////////////////////////////////////////////
                        $GEkipaID=$rowTekma["gosti"];
                        $GGoli=$rowTekma["resFTG"];
    
                        $qEkipaG="SELECT linkLogo,naziv from ekipa WHERE EkipaID=$GEkipaID";
                        
                        $resEkipaG=mysqli_query($conn,$qEkipaG);
                        $rowG=mysqli_fetch_array($resEkipaG);
    
                        $GNaziv=$rowG["naziv"];
                        $GLogo=$rowG["linkLogo"];
                    echo "<tr class='result-row' ";?> onclick="window.location='http://localhost/Matura_projekt/Rezultati/Tekma/Tekma.php?value=<?php echo $TekmaID ?>';"><?php
                        echo "<td class='col1'>$DNaziv</td>";
                        echo "<td class='col2' style='padding-top:7px'><img src='$DLogo' width='30px' height='30px'></td>";
                        echo "<td class='col2'><div class='box' style='margin-left:19px'>$DGoli</div></td>";
                        echo "<td class='col2'><div class='box'>$GGoli</div></td>";
                        echo "<td class='col2' style='padding-top:7px'><img src='$GLogo' width='30px' height='30px'></td>";
                        echo "<td>$GNaziv</td>";
                    echo "</tr>";
                    }
                   echo "</table>";

                
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