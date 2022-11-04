<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ListaStrelcev.css">
    <title>Lista strelcev</title>
</head>
<body>

    <?php   
        if($_SESSION["name"]=="Miha123"){
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
        $servername = "localhost";
        $username = "root";
        $DBname="matura_projektnogomet";
        
        $conn=mysqli_connect($servername,$username,"",$DBname) or die(mysqli_error($conn));
?>

        <div id="main">
            <div class="center">
                <h1>Lista Strelcev</h1>
            </div>
            <div class="wrapper">
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

                <div class="lista">
                    <table>
                        <tr>
                            <td class='col1 first'>Ime</td>
                            <td class='col2 first'>Klub</td>
                            <td class='col3 first'>ŠT golov</td>
                            <td class='col4 first'>P</td>
                            <td class="col4 first">AG</td>
                        </tr>

                        <?php
                            $q="SELECT distinct g.igralecID,opomba,Ime,Priimek,linkLogo,count(golID) as koliko from gol g
                            inner join igralec i on (i.igralecID=g.igralecID)
                            inner join sezona_igralec s on(g.igralecID=s.igralecID)
                            inner join ekipa e on(e.ekipaID=s.ekipaID) group by g.igralecID order by koliko desc";

                            
                            $rs=mysqli_query($conn,$q);
                            while($row=mysqli_fetch_array($rs)){
                                $id=$row["igralecID"];
                                $ime=$row["Ime"];
                                $priimek=$row["Priimek"];
                                $logo=$row["linkLogo"];
                                $ST=$row["koliko"];
                                $opomba=$row["opomba"];
                                echo "<tr>";
                                    echo "<td class='col1'>$ime $priimek</td>"; 
                                    echo "<td class='col2'><img src='$logo' height='25px' width='25px'></td>";     
                                    echo "<td>$ST</td>";
                             
                                    if($opomba==2){
                                    $qPenal="SELECT count(*) as stPenalov from gol where opomba=2 and igralecID=$id group by igralecID";
                                    $rsPenal=mysqli_query($conn,$qPenal);
                                    $rowPenal=mysqli_fetch_array($rsPenal);
                                    $y=$rowPenal["stPenalov"];
                                    echo "<td>$y</td>";   
                                    }
                                    else     
                                        echo "<td>0</td>";  
                                        
                                        if($opomba==1){
                                            $qPenal="SELECT count(*) as stPenalov from gol where opomba=1 and igralecID=$id group by igralecID";
                                            $rsPenal=mysqli_query($conn,$qPenal);
                                            $rowPenal=mysqli_fetch_array($rsPenal);
                                            $y=$rowPenal["stPenalov"];
                                            echo "<td>$y</td>";   
                                        }
                                        else
                                            echo "<td>0</td>"; 
                                echo "</tr>";
                            }
                        ?>
                    </table>
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