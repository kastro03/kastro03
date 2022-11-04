<?php
session_start();


$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);


if(!empty($_GET["novoGeslo"]) && !empty($_GET["trenutnoGeslo"]) && ! empty($_GET["re-novoGeslo"])){

    $trenutno=$_GET["trenutnoGeslo"];
    $novo=$_GET["novoGeslo"];
    $reNovo=$_GET["re-novoGeslo"];


    $user=$_SESSION["name"];


    $qSelect="SELECT geslo,email from user where uporabnik='$user'";
    
    $rs=mysqli_query($conn,$qSelect);
    $row=mysqli_fetch_array($rs);
    $geslo=$row["geslo"];
    $mail=$row["email"];

    if(strlen($novo)>=8 && $reNovo==$novo)
    {
        $novo=md5($novo);
        $qUpdate="UPDATE user set geslo='$novo' where uporabnik='$user'";
        mysqli_query($conn,$qUpdate);
        $body="Pozdravljeni,\n
        uspesno ste spremenili geslo.";
        mail($mail,"Sprememba gesla",$body);
    }
    else
    $msg="Vnos ni pravilen";

}

header("Location:http://localhost/Matura_Projekt/NastavitveUporabnika/nastavitveUporabnika.php");
?>