<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="naprejMenjave.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Menjave</title>
</head>
<body>
    <?php
        if($_SESSION["name"]=="Miha123"){
            require_once("C:/xampp/htdocs/Matura_Projekt/layout1.php");
            $servername = "localhost";
            $username = "root";
            $DBname="matura_projektnogomet";
            $conn=mysqli_connect($servername,$username,"",$DBname);
    ?>

    <div id="main">
        <?php 
            foreach($_SESSION["domaceMenjave"] as $k=>$x)
            echo "$x <br>";
        ?>
        <form action="naprejKazni.php">
                    <div class="naslovGlavni">
                        <div class="nazaj">
                        </div>
                        <div class="naslovG">
                            <h2>Obrazec za tekmo (Menjave)</h2>
                        </div>
                        <div class="submit">
                            <button type="submit">
                                <i class="fa fa-arrow-right" style="font-size:40px;color:white;"></i>
                            </button>
                        </div>

                    </div>
        </form>

                    <div id="wrapper">
                        <div class="col">
                            <div class="naslov">
                                <h3>Menjave(Domači):</h3>
                            </div>
                            <div class="box">
                                <div class="input-menjava-wrapper">
                                <form action="vnosMenjava.php">
                                    <table>
                                        <tr>
                                            <td>V igro:</td>
                                            <td>
                                                <select name="DigralecV" style='width: 178px'>
                                                    <?php
                                                        $igralci=$_SESSION["domaceMenjave"];
                                                
                                                        foreach($igralci as $key =>$v)
                                                        {
                                                            $q="SELECT Ime,Priimek from igralec where IgralecID=$v";
                                                            $rs=mysqli_query($conn,$q);
                                                            $row=mysqli_fetch_array($rs);
                                                            $ime=$row["Ime"];
                                                            $priimek=$row["Priimek"];
                                                            echo "<option value='$v'>$ime $priimek</option>";

                                                        }
                                                    ?>
                                                </select>
            
                                            </td>
                                            <td class="col3"><i class="fa fa-arrow-right" style="font-size:20px;color:green;"></i></td>
                                        </tr>
                                        <td>Iz igre:</td>
                                            <td><select name="DigralecIZ" style='width: 178px'>
                                            <?php
                                                $igralci=$_SESSION["domacaPostava"];
                                    
                                                foreach($igralci as $key =>$v)
                                                {
                                                    $q="SELECT Ime,Priimek from igralec where IgralecID=$v";
                                                    $rs=mysqli_query($conn,$q);
                                                    $row=mysqli_fetch_array($rs);
                                                    $ime=$row["Ime"];
                                                    $priimek=$row["Priimek"];
                                                    echo "<option value='$v'>$ime $priimek</option>";

                                                }
                                                    ?>  
                                            </select>
                                                        
                                        </td>
                                            <td class="col3"><i class="fa fa-arrow-left" style="font-size:20px;color:red;"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Minuta: </td>
                                            <td><input type="number" name="Dminuta"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="dodajMenjavo"><input type="submit" value="dodaj"></td>
                                        </tr>
                                    </table>
                                </form>
                                </div>
                                <?php
                                if(isset($_SESSION["menjaveDomaci"])){
                                    foreach($_SESSION["menjaveDomaci"] as $x)
                                    foreach($x as $k=>$value)
                                    echo "$k = $value<br>";
                                }
                                ?>
                                
                            </div>
                        </div>

                        <div class="col">
                            <div class="naslov">
                                <h3>Menjave(Gosti):</h3>
                            </div>
                            <div class="box">
                            <div class="input-menjava-wrapper">
                                <form action="vnosMenjava.php">
                                    <table>
                                        <tr>
                                            <td>V igro:</td>
                                            <td><select name="GigralecV" style='width: 178px'>
                                                     <?php
                                                        $igralci=$_SESSION["gostojoceMenjave"];

                                                        foreach($igralci as $key =>$v)
                                                        {
                                                            $q="SELECT Ime,Priimek from igralec where IgralecID=$v";
                                                            $rs=mysqli_query($conn,$q);
                                                            $row=mysqli_fetch_array($rs);
                                                            $ime=$row["Ime"];
                                                            $priimek=$row["Priimek"];
                                                            echo "<option value='$v'>$ime $priimek</option>";
                                                        }
                                                    ?>
                                            </select></td>
                                            <td class="col3"><i class="fa fa-arrow-right" style="font-size:20px;color:green;"></i></td>
                                        </tr>
                                        <td>Iz igre:</td>
                                            <td><select name="GigralecIZ" style='width: 178px'>
                                            <?php
                                                        $igralci=$_SESSION["gostojocaPostava"];

                                                        foreach($igralci as $key =>$v)
                                                        {
                                                            $q="SELECT Ime,Priimek from igralec where IgralecID=$v";
                                                            $rs=mysqli_query($conn,$q);
                                                            $row=mysqli_fetch_array($rs);
                                                            $ime=$row["Ime"];
                                                            $priimek=$row["Priimek"];
                                                            echo "<option value='$v'>$ime $priimek</option>";
                                                        }
                                                    ?>
                                            </select></td>
                                            <td class="col3"><i class="fa fa-arrow-left" style="font-size:20px;color:red;"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Minuta: </td>
                                            <td><input type="number" name="Gminuta"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="dodajMenjavo"><input type="submit" value="dodaj"></td>
                                        </tr>
                                    </table>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
        
        <div id="back">
                    <a href="naprejGoli.php">
                                <button>
                                    <i class="fa fa-arrow-left" style="font-size:40px;color:white;"></i>
                                </button>
                            </a>
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