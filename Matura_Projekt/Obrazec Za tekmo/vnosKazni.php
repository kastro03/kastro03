<?php
    session_start();
        if(!empty($_GET["DigralecKazen"])  && !empty($_GET["Dkarton"]) && !empty($_GET["Dminuta"])){
               
            $igralec=$_GET["DigralecKazen"];
                $minuta=$_GET["Dminuta"];
                $karton=$_GET["Dkarton"];


                $_SESSION["kazniDomaci"][]=array(
                    "igralec" => $igralec,
                    "minuta" => $minuta,
                    "karton" => $karton
                );

                
         }

    if(!empty($_GET["GigralecKazen"])  && !empty($_GET["Gkarton"]) && !empty($_GET["Gminuta"])){
        $igralec=$_GET["GigralecKazen"];
        $minuta=$_GET["Gminuta"];
        $karton=$_GET["Gkarton"];


        $_SESSION["kazniGosti"][]=array(
            "igralec" => $igralec,
            "minuta" => $minuta,
            "karton" => $karton
        );

        
        }

        header("Location:naprejKazni.php");
?>