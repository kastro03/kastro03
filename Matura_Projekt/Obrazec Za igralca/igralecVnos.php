<?php


$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname) or die(mysqli_error($conn));

$currentSeason=1;


if(!empty($_GET["ime"]) && !empty($_GET["priimek"]) && 
!empty($_GET["datumRojstva"]) && !empty($_GET["drzava"]) && !empty($_GET["ekipa"])
 && !empty($_GET["pozicija"]) && !empty($_GET["STDresa"]))
{



    $ime=$_GET["ime"];
    $priimek=$_GET["priimek"];
    $datumRojstva=$_GET["datumRojstva"];
    $drzava=$_GET["drzava"];
    $ekipa=$_GET["ekipa"];
    $pozicija=$_GET["pozicija"];
    $stDresa=$_GET["STDresa"];


    $q="SELECT EkipaID from Ekipa where naziv="."'$ekipa'";
    $res=mysqli_query($conn,$q);

    $row=mysqli_fetch_array($res);
    $ekipaID=$row["EkipaID"];

    $q1="INSERT INTO igralec (ime,priimek,datumRojstva,drzava,pozicija,StevilkaDresa) VALUES
    ("."'$ime'".",'$priimek'".",'$datumRojstva'".",'$drzava'".",'$pozicija',$stDresa)";
 
     mysqli_query($conn,$q1) or die(mysqli_error($conn));

     $querySelectIgralecID="SELECT IgralecID from Igralec WHERE Ime="."'$ime'"." AND Priimek=".
     "'$priimek'"." AND DatumRojstva="."'$datumRojstva'";

    $res=mysqli_query($conn,$querySelectIgralecID);
    $row=mysqli_fetch_array($res);
    $igralecID=$row["IgralecID"];
     $q2="INSERT INTO Sezona_igralec Values($currentSeason,$igralecID,$ekipaID)";
     mysqli_query($conn,$q2);

}

?>