<?php

$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);

if(!empty($_GET["value"])){
    $tmp=$_GET["value"];
    $q="SELECT Imestadiuma FROM Ekipa where naziv='$tmp'"; 
    $rs=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($rs);
    echo $row["Imestadiuma"];
    }


?>