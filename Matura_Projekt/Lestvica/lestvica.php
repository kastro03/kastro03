<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lestvica.css">

    <title>Lestvica</title>
</head>
<body>
<?php
    if($_SESSION["name"]) {
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
    ?>

        <div id="main">
            <div class="center">
                <h1>Lestvica</h1>
            </div>

            <div class="wrapper">
                <div class="selectSezona">
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $DBname="matura_projektnogomet";
                        
                        $conn=mysqli_connect($servername,$username,"",$DBname) or die(mysqli_error($conn));

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
                    <div id="lestvica">
                        <table>
                            <tr>
                                <td class="col2 first"></td>
                                <td colspan="2" class='col1 first'>Klub</td>
                                <td class='col1 first'>ŠT Tekm</td>
                                <td class='col2 first'>Z</td>
                                <td class='col2 first'>N</td>
                                <td class='col2 first'>P</td>
                                <td class='col2 first'>GR</td>
                                <td class='col1 first'>ŠT točk</td>
                            </tr>

                            <?php

                                $q="SELECT * from lestvica l
                                inner join sezona s on (s.sezonaID=l.sezonaID)
                                where s.sezonaID=$ID
                                order by stTock desc,dobljeniGoli";
                                $rs=mysqli_query($conn,$q);

                                $i=0;

                                while($row=mysqli_fetch_array($rs)){
                                    $i++;
                                    $ekipaID=$row["ekipaID"];
                                    $SezonaID=$row["SezonaID"];
                                    $stTekm=$row["stTekm"];
                                    $stTock=$row["stTock"];
                                    $Z=$row["zmage"];
                                    $N=$row["neodloceno"];
                                    $P=$row["porazi"];
                                    $goli=$row["goli"];
                                    $dGoli=$row["dobljeniGoli"];

                                    $qEkipa="SELECT naziv,linkLogo from ekipa e
                                    inner join lestvica l on(e.ekipaID=l.ekipaID) where e.ekipaID=$ekipaID";
                                    $rsEkipa=mysqli_query($conn,$qEkipa);
                                    $x=mysqli_fetch_array($rsEkipa);
                                    $ekipa=$x["naziv"];
                                    $logo=$x["linkLogo"];
                                    if($ekipa=="Wolverhampton Wanderers")
                                    $ekipa="Wolves";
                                    echo "<tr>";
                                        echo "<td class='col2'>$i</td>";
                                        echo "<td class='col0'><img src='$logo' height='25px' width='25px'></td>";    
                                        echo "<td class='col1 firstCol'><span class='naziv'>$ekipa</span></td>";
                                        echo "<td class='col1'>$stTekm</td>";
                                        echo "<td class='col2'>$Z</td>";
                                        echo "<td class='col2'>$N</td>";
                                        echo "<td class='col2'>$P</td>";
                                        echo "<td class='col2'>$goli:$dGoli</td>";
                                        echo "<td class='col1'>$stTock</td>";
                                    echo "</tr>";
                                }
                            
                            ?>

                        </table>
                    </div>
                </div>
        </div>

<?php
}else {
        header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
        }
        ?>

</body>
</html>
