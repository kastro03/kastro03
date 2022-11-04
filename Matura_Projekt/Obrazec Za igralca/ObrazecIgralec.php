<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ObrazecIgralec.css">
    <link rel="stylesheet" href="flags.css">
    <title>Obrazec za igralec</title>
</head>
<body>

    <?php   
        if($_SESSION["name"]=="Miha123"){
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
    ?>

    <div id="main">
    
        <div class="obrazec">
            <div id="naslov"><h2><b>Obrazec za igralca</b></h2></div>
                <table>
                    <form>
                        <tr>
                            <td>Ime:</td> 
                            <td><input class="ime" type="text" name="ime" required/></td>
                        </tr>

                        <tr>
                            <td>Priimek:</td> 
                            <td><input type="text" name="priimek" /></td>
                        </tr>

                        <tr>
                            <td>Datum rojstva:</td> 
                            <td><input type="date" name="datumRojstva" required/></td>
                        </tr>

                        <tr>
                            <td>Drzava:</td> 

                            <td>
                                <select name="drzava">
                                <?php 
                                
                                require_once("drzave.php");


                            foreach($drzave as $k=>$x)
                                echo "<option value='$x'>$x</option>";
                                ?>
                            </select>
                            </td>
                        </tr>    

                        <tr>
                            <td>Ekipa:</td>
                            <td><select name="ekipa">

                        <?php

                $servername = "localhost";
                $username = "root";
                $DBname="matura_projektnogomet";

                $conn=mysqli_connect($servername,$username,"",$DBname);

                $q="SELECT naziv from ekipa";
                $rs=mysqli_query($conn,$q);

                        while($row=mysqli_fetch_array($rs))
                        {
                            $x=$row["naziv"];
                            echo "<option value='$x'>$x</option>";
                        }
                        mysqli_close($conn);
                        ?>

                    </select></td> 
            
                    </tr>


                    <tr>
                        <td>Igralno mesto: </td>
                <td><select name="pozicija">
                    <option value="vratar">vratar</option>
                    <option value="obramba">obramba</option>
                    <option value="sredina">sredina</option>
                    <option value="napad">napad</option>
                </select>
                    </td>
                    </tr>

                    <tr>
                        <td>Številka dresa:</td>
                        <td><input type="number" name="STDresa" required/></td>
                    </tr>

                    <tr>
                        <td style="text-align:center;" colspan="2">
                            <input id="vnos" type="submit" value="vnesi"/>
                        </td>
                    </tr>

                    </form>
                </table>
        </div>
    </div>
    <?php
        require_once("igralecVnos.php");
        
        }
        else{
            header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
        }

        
    ?>
</body>
</html>
