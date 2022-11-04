<?php

$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);

$x=$_GET["value"];

    $qIgralec="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
    inner join ekipa e on(e.EkipaID=s.ekipaID)
    inner join igralec i on (s.igralecID=i.igralecID) 
    where e.naziv='$x' AND i.pozicija!='vratar'";

    $rsIgralec=mysqli_query($conn,$qIgralec);

if(!empty($_GET["value"])){

   

    for($i=2;$i<=11;$i++)
    {
        echo "igralec $i:<br>";
        echo "<select name='Gigralec$i' class='inputPlayer'>";
        while($row=mysqli_fetch_array($rsIgralec))
        {
            $ID=$row['IgralecID'];
            $ime=$row["ime"];
            $priimek=$row["priimek"];
            echo "<option value='$ID'>$ime $priimek</option>";
        }
        $rsIgralec=mysqli_query($conn,$qIgralec);
        echo "</select>";
        echo "<br><br>";
    }
    echo "<br><br>";
    echo "<span style='color: red'>Kapetan: </span><br>";
    echo "<select name='KapetanG' class='inputPlayer'>";
        while($row=mysqli_fetch_array($rsIgralec))
        {
            $ID=$row['IgralecID'];
            $ime=$row["ime"];
            $priimek=$row["priimek"];
            echo "<option value='$ID'>$ime $priimek</option>";
        }
    echo "</select>";


}

?>