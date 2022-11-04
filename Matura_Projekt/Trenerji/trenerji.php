<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="trenerji.css">
    <link rel="stylesheet" href="flags.css">
    <title>Trenerji</title>
</head>
<body>
<?php

if($_SESSION["name"]) {
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
    
    
    echo '<div id="main">';


$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);

    $q="SELECT * FROM trener order by ime,priimek";
    $rs=mysqli_query($conn,$q);


?>
<div class="center">
    <div class="filter-row">
        <div class="sezona">
            <select name="sezona">
                <?php
                    $q="SELECT * from sezona";
                    $res=mysqli_query($conn,$q);
                    while($row=mysqli_fetch_array($res))
                    {
                        $tmp=$row["naziv"];
                        $ID=$row["SezonaID"];
                        echo "<option value='$ID'>$tmp</option>";
                    }
                ?>
            </select>
        </div>
    </div>
</div>

    <?php


   echo "<table>";

   echo "<tr><td class='naslov' colspan='6'><h1>Trenerji<h1></td></tr>";

   echo "<tr class='first'>";
       echo "<td class='col1'>Ime Trenerja</td>";
       echo "<td class='col2'>Datum rojstva</td>";
       echo "<td class='col3'>Drzava</td>";
       echo "<td></td>";
       echo "<td class='col4'>Klub</td>";
       echo "<td class='colKlub'></td>";
   echo "</tr>";

   require_once("C:/xampp/htdocs/Matura_Projekt/Obrazec za Igralca/drzave.php");
    
        while($row=mysqli_fetch_array($rs))
        {
            echo "<tr class='prikaz'>";
                echo "<td class='col1'>";
                    echo $row["Ime"] ." ".$row["Priimek"];
                echo "</td>";


                echo "<td class='col2'>";
                    echo $row["DatumRojstva"];
                echo "</td>";
           
          

               echo "<td class='col3'>";
                require_once("C:/xampp/htdocs/Matura_Projekt/Obrazec za Igralca/drzave.php");
    
                echo $row["drzava"];
                foreach($drzave as $k =>$x)
                {
                    if($row["drzava"]==$x)
                    {
                        $flag=$k;
                        break;
                    }
                }
    
                echo "</td><td class='colFlag'>";
                echo "<span class='flag $flag'></span>";
            echo "</td>";

            $tmp=$row["TrenerID"];
            $querySelectEkipa="SELECT ekipaID from sezona_trener where TrenerID = $tmp";
            $rs1=mysqli_query($conn,$querySelectEkipa);
            $row1=mysqli_fetch_array($rs1);
                $tmp=$row1["ekipaID"];
                $querySelectLOGO="SELECT * from ekipa where ekipaID=$tmp";
                $rs2=mysqli_query($conn,$querySelectLOGO);
                $row2=mysqli_fetch_array($rs2);
            $tmp=$row2["linkLogo"];

            echo "<td>";
            echo $row2["naziv"];
                echo "</td>";

                echo "<td class='colKlub'>";
                echo "<img style='margin-left:4px;display: inline-block;' 
                src='$tmp' height='25px' width='25px'>";
            
                echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }else {
        header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
            }

?>

    </div>
</body>
</html>