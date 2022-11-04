<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="nastavitveUporabnika.css">
    <title>NASTAVITVE</title>
</head>
<body>
    <?php  
    if(isset($_SESSION["name"])){
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
    
    ?>

    <div id="main">

        <div class="naslov">
            <h1>Nastavitve</h1>
        <div>
            
        <div class="spremembaGesla">
            <form action="nastavitveVnosGesla.php">
            <table>
                <tr>
                    <td colspan="2" style="text-align:center;"><h3><b>Sprememba gesla:</b></h3></td>
                </tr>
                <tr>
                    <td>Trenutno geslo:</td> <td><input type="password" name="trenutnoGeslo" /></td>
                </tr>

                <tr>
                    <td>Novo geslo:</td> <td><input type="password" name="novoGeslo" /></td>
                </tr>

                <tr>
                    <td>Ponovi geslo:</td> <td><input type="password" name="re-novoGeslo" /></td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align:center;"><input id="vnos" type="submit" value="spremeni" /></td>
                </tr>
            </table>
            </form>
        </div>

        <div class="spremembaEmail">
        <form action="nastavitveVnosMaila.php">
        <table> 
            <tr>
                <td colspan="2" style="text-align:center;"><h3><b>Sprememba e-maila:</b></h3></td>
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

    </div>

    <?php

}
else{
    header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
}
?>
</body>
</html>