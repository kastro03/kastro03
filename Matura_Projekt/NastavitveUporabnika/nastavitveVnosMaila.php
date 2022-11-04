<?php
session_start();


$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);

if(!empty($_GET["mail"]))
{
    $mailNov=$_GET["mail"];
    $user=$_SESSION["name"];

    $qMail="SELECT email from user where uporabnik='$user'";
    $rs=mysqli_query($conn,$qMail);
    $row=mysqli_fetch_array($rs);

    $m=$row["email"];

    $qUpdate="UPDATE user set email='$mailNov'";

    mysqli_query($conn,$qUpdate);
    $body="Uspesno ste spremenili email. Vaš e-mail je od sedaj naprej: $mailNov\n
    Na ta mail prosim ne odgavrjajte.";
    mail($m,"Sprememba maila",$body);

}

header("Location:http://localhost/Matura_Projekt/NastavitveUporabnika/nastavitveUporabnika.php");

?>