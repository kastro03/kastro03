<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pozabljenoGeslo.css">
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Montserrat'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Pozabljeno geslo</title>
</head>
<body>
<div class="nazajNaPrijavo">
        <a href="loginPage.php">
            <i class="fa fa-sign-in" style="font-size:25px"></i> Prijava
        </a>
    </div>
<div class="spremembaEmail">
    <form>
   
    <table> 
            <tr>
                <td colspan="2" style="text-align:center;"><h3><b>Pozabljeno gesla:</b></h3></td>
            </tr>
            <tr>
                <td>E-mail:</td><td><input type="email" name="mail" required/>
            </tr>

            <tr>
                <td colspan="2" style="text-align:center;"><input id="vnos" type="submit" value="spremeni" /></td>
            </tr>
    </table>
    </form>
</div>

</body>
</html>

<?php

if(!empty($_GET["mail"])){

    $m=$_GET["mail"];
    $body="Pozdravljeni,\n
    za obnovitev gesla kliknite na povezavo:\n
    http://localhost/Matura_Projekt/PozabljenoGeslo/posljiGeslo.php?m=$m";
    mail($m,"Pozabljeno geslo",$body);

}


?>