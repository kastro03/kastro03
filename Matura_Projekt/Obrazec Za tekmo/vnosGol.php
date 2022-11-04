<?php
session_start();

if($_SESSION["tekma"]["FTgoliG"]>0){

    for($i=1;$i<=$_SESSION["tekma"]['FTgoliD'];$i++)
    {
        $niz="DigralecGol$i";
    
        if(!empty($_GET["minutaIgralecD$i"]) && !empty($_GET["opombaIgralecD$i"])){
        $goliDDrugacen[]=array(
            $niz =>$_GET[$niz],
            "minuta" => $_GET["minutaIgralecD$i"],
            "opomba" => $_GET["opombaIgralecD$i"]
        );
        $_SESSION["goliDDrugacen"]=$goliDDrugacen;
        }
        else{
        $goliDNavaden[]=array(
            $niz =>$_GET[$niz],
            "minuta" => $_GET["minutaIgralecD$i"]
        );
        $_SESSION["goliDNavaden"]=$goliDNavaden;
            }
        }
    
    }

if($_SESSION["tekma"]["FTgoliG"]>0){

for($i=1;$i<=$_SESSION["tekma"]['FTgoliG'];$i++)
{
    $niz="GigralecGol$i";

    if(!empty($_GET["minutaIgralecG$i"]) && !empty($_GET["opombaIgralecG$i"])){
    $goliGDrugacen[]=array(
        $niz =>$_GET[$niz],
        "minuta" => $_GET["minutaIgralecG$i"],
        "opomba" => $_GET["opombaIgralecG$i"]
    );
    $_SESSION["goliGDrugacen"]=$goliGDrugacen;
    }
    else{
    $goliGNavaden[]=array(
        $niz =>$_GET[$niz],
        "minuta" => $_GET["minutaIgralecG$i"]
    );
    $_SESSION["goliGNavaden"]=$goliGNavaden;
        }
    }

}

foreach($goliDNavaden as $x)
    foreach($x as $k=>$val)
        echo $k." = "."$val";

echo "<br><br>";

foreach($goliGNavaden as $x)
    foreach($x as $k=>$val)
        echo $k." = "."$val";

header("Location:naprejMenjave.php");
?>