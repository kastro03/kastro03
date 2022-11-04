<?php
session_start();

    if(!empty($_GET["DigralecV"]) && !empty($_GET["DigralecIZ"]) &&!empty($_GET["Dminuta"])){
       
        $_SESSION["menjaveDomaci"][]=array(
        "igralecV" => $_GET["DigralecV"],
        "igralecIZ" => $_GET["DigralecIZ"],
        "minuta" => $_GET["Dminuta"]
    );

  

}

if(!empty($_GET["GigralecV"]) && !empty($_GET["GigralecIZ"]) &&!empty($_GET["Gminuta"])){

    $_SESSION["menjaveGosti"][]=array(
            "igralecV"=>$_GET["GigralecV"],
            "igralecIZ"=>$_GET["GigralecIZ"],
            "minuta"=>$_GET["Gminuta"]
    );  
}



    header("Location:naprejMenjave.php");

?>