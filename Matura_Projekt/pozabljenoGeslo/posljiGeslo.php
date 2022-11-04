<?php

$geslo="";
for($i=0;$i<9;$i++)
{
    $x=chr(rand(ord('a'),ord('z')));
    $y=chr(rand(ord('A'),ord('Z')));
    if($i==2 || $i==5 || $i==7){
        $geslo.=$y;
    }
    else{
        $geslo.=$x;
    }
}

$mail=$_GET["m"];

echo $mail;

$body="Pozdravljeni,\n
vaše novo geslo: $geslo";
mail($mail,"Novo geslo",$body);

$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);
$geslo=md5($geslo);

$q="UPDATE user set geslo='$geslo' where email='$mail'";
mysqli_query($conn,$q);


header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
?>