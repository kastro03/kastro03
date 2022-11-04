<?php
$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);


if(!empty($_GET["value"])){

    $x=$_GET["value"];

    $qVratar="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
    inner join ekipa e on(e.EkipaID=s.ekipaID)
    inner join igralec i on (s.igralecID=i.igralecID) 
    where e.naziv='$x' AND i.pozicija='vratar'";

    

    $rsVratar=mysqli_query($conn,$qVratar);
   

    echo "<select name='Dvratar' class='inputPlayer'>";

    while($row=mysqli_fetch_array($rsVratar))
    {
        $ime=$row["ime"];
        $priimek=$row["priimek"];
        $ID=$row["IgralecID"];
        echo "<option value='$ID'>$ime $priimek</option>";
    }

    echo "</select>";        

}

?>