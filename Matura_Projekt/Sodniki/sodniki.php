<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sodniki.css">
    <title>Sodniki</title>
</head>
<body>

<?php
if($_SESSION["name"]) {
    require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
    $servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);
?>

<div id="main">

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



    $q="SELECT * FROM Sodnik order by ime,priimek";
    $rs=mysqli_query($conn,$q);

    echo "<table>";
    
    echo "<tr><td class='naslov' colspan='4'><h1>Sodniki</h1></td>";

    echo "<tr class='first'>";
    echo "<td class='col'>Ime sodnika</td>";
    echo "<td class='col'>Stevilo tekm</td>";
    echo "<td class='col'>Rumeni kartoni</td>";
    echo "<td class='col'>Rdeči kartoni</td>";
    echo "</tr>";

    
    while($row=mysqli_fetch_array($rs))
    {
        $ID=$row["SodnikID"];
        $qRumen="SELECT count(*) as st from kazen k inner join tekma t on(t.tekmaID=k.tekmaID) where karton='RU' and t.SodnikID=$ID";
        $rsRumen=mysqli_query($conn,$qRumen);
        $rowRU=mysqli_fetch_array($rsRumen);

        $qStTekm="SELECT count(*) as x from Tekma where SodnikID=$ID";
        $rsSTTEKM=mysqli_query($conn,$qStTekm);
        $rowStTekm=mysqli_fetch_array($rsSTTEKM);

        $qRdec="SELECT count(*) as st from kazen k inner join tekma t on(t.tekmaID=k.tekmaID) where karton='RD' and t.SodnikID=$ID";
        $rsRdec=mysqli_query($conn,$qRdec);
        $rowRD=mysqli_fetch_array($rsRdec);
        echo "<tr class='prikaz'>";
                echo "<td class='col1'>";
                    echo $row["Ime"] ." ".$row["Priimek"];
                echo "</td>";

                echo "<td class='center1'>";
                    echo $rowStTekm["x"];
                echo "</td>";

                echo "<td class='center1'>";
                    echo $rowRU["st"];
                 echo "</td>";

                echo "<td class='center1'>";
                    echo $rowRD["st"];
                echo "</td>";
    }

    echo "</table>";

}else {
    header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
    }

?>

    
</body>
</html>