<?php
session_start();


foreach($_SESSION["tekma"] as $k=>$x)
echo $k.": ".$x."<br>";

foreach($domacaPostava as $k=>$x)
echo $k.": ".$x."<br>";

foreach($gostojocaPostava as $k=>$x)
echo $k.": ".$x."<br>";

?>