<?php
session_start();

$datum=$_GET["datumTekme"];
$cas=$_GET["casTekme"];
$domaci=$_GET["domaci"];
$gosti=$_GET["gosti"];
$HTgoliD=$_GET["goliDHT"];
$HTgoliG=$_GET["goliGHT"];
$FTgoliD=$_GET["goliDFT"];
$FTgoliG=$_GET["goliGFT"];
$sodnik=$_GET["sodnik"];
$krog=$_GET["krog"];
$sezona=1;

if($HTgoliD<=$FTgoliD && $HTgoliG <=$FTgoliG && $gosti!=$domaci){
        $servername = "localhost";
        $username = "root";
        $DBname="matura_projektnogomet";
        $conn=mysqli_connect($servername,$username,"",$DBname);

        $qDomaci="SELECT EkipaID from ekipa where naziv='$domaci'";
        $qGosti="SELECT EkipaID from ekipa where naziv='$gosti'";

        $rs=mysqli_query($conn,$qDomaci);
        $row=mysqli_fetch_array($rs);
        $domaci=$row["EkipaID"];
        
        $rs=mysqli_query($conn,$qGosti);
        $row=mysqli_fetch_array($rs);
        $gosti=$row["EkipaID"];


$tekma=array(
    'datum' => $datum,
    'cas' => $cas,
    'domaci' => $domaci,
    'gosti' => $gosti,
    'HTgoliD' => $HTgoliD,
    'HTgoliG' => $HTgoliG,
    'FTgoliD' => $FTgoliD,
    'FTgoliG' => $FTgoliG,
    'sodnik' => $sodnik,
    'krog' => $krog,
    'sezona' => $sezona
);

$_SESSION["tekma"]=$tekma;

$domacaPostava=array(
    'vratar' =>$_GET['Dvratar'],
    'igralec2' => $_GET['Digralec2'],
    'igralec3' => $_GET['Digralec3'],
    'igralec4' => $_GET['Digralec4'],
    'igralec5' => $_GET['Digralec5'],
    'igralec6' => $_GET['Digralec6'],
    'igralec7' => $_GET['Digralec7'],
    'igralec8' => $_GET['Digralec8'],
    'igralec9' => $_GET['Digralec9'],
    'igralec10' => $_GET['Digralec10'],
    'igralec11' => $_GET['Digralec11']
);

$_SESSION["domacaPostava"]=$domacaPostava;

$domaceMenjave=array(
    'menjava1' => $_GET['Dmenjava1'],
    'menjava2' => $_GET['Dmenjava2'],
    'menjava3' => $_GET['Dmenjava3'],
    'menjava4' => $_GET['Dmenjava4'],
    'menjava5' => $_GET['Dmenjava5'],
    'menjava6' => $_GET['Dmenjava6'],
    'menjava7' => $_GET['Dmenjava7'],
    'menjava8' => $_GET['Dmenjava8'],
    'menjava9' => $_GET['Dmenjava9']
);

$_SESSION["domaceMenjave"]=$domaceMenjave;

$gostojocaPostava=array(
    'vratar'  => $_GET['Gvratar'],
    'igralec2' => $_GET['Gigralec2'],
    'igralec3' => $_GET['Gigralec3'],
    'igralec4' => $_GET['Gigralec4'],
    'igralec5' => $_GET['Gigralec5'],
    'igralec6' => $_GET['Gigralec6'],
    'igralec7' => $_GET['Gigralec7'],
    'igralec8' => $_GET['Gigralec8'],
    'igralec9' => $_GET['Gigralec9'],
    'igralec10' => $_GET['Gigralec10'],
    'igralec11' => $_GET['Gigralec11']
);

$_SESSION["KapetanD"]=$_GET["KapetanD"];

$_SESSION["gostojocaPostava"]=$gostojocaPostava;

$gostojoceMenjave=array(
    'menjava1' => $_GET['Gmenjava1'],
    'menjava2' => $_GET['Gmenjava2'],
    'menjava3' => $_GET['Gmenjava3'],
    'menjava4' => $_GET['Gmenjava4'],
    'menjava5' => $_GET['Gmenjava5'],
    'menjava6' => $_GET['Gmenjava6'],
    'menjava7' => $_GET['Gmenjava7'],
    'menjava8' => $_GET['Gmenjava8'],
    'menjava9' => $_GET['Gmenjava9']
);

$_SESSION["gostojoceMenjave"]=$gostojoceMenjave;

$_SESSION["KapetanG"]=$_GET["KapetanG"];


header("Location:naprejGoli.php");
}
?>

