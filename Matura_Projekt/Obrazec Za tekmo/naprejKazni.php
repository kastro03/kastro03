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
    <link rel="stylesheet" href="naprejKazni.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Kazni</title>
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
        <form action="DodajTekmoVDB.php">
            <div class="naslovGlavni">
                <div class="nazaj">
                </div>
                <div class="naslovG">
                    <h2>Obrazec za tekmo (Kazni)</h2>
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
                        <h3>Kazni(Domači):</h3>
                    </div>
                    <div class="box">
                        <div class="input-menjava-wrapper">
                        <form action="vnosKazni.php">
                            <table>
                                <tr>
                                    <td>Igralec:</td>
                                    <td><select name="DigralecKazen">
                                        <?php
                                            $qIgralec="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                                            inner join ekipa e on(e.EkipaID=s.ekipaID)
                                            inner join igralec i on (s.igralecID=i.igralecID)
                                            where e.EkipaID=".$_SESSION["tekma"]["domaci"];
                                            $rs=mysqli_query($conn,$qIgralec);
                                            while($row=mysqli_fetch_array($rs)){
                                                $ime=$row["ime"];
                                                $priimek=$row["priimek"];
                                                $ID=$row["IgralecID"];
                                                echo "<option value='$ID'>$ime $priimek</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td>Minuta: </td>
                                    <td><input type="number" name="Dminuta"></td>
                                </tr>
                                <tr>
                                    <td>Karton:</td>
                                    <td>
                                        <select name="Dkarton" id="k">
                                            <option class="yellow" value="RU">rumeni</option>
                                            <option class="red" value="RD">rdeči</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="dodajKazen"><input type="submit" value="dodaj"></td>
                                </tr>
                            </table>
                        </form>
                        </div>
                                <?php
                                if(isset($_SESSION["kazniDomaci"])){
                                        foreach($_SESSION["kazniDomaci"] as $x){
                                            foreach($x as $k=>$v)
                                                echo "$k = $v<br>";
                                        }
                                    }
                                ?>
                     </div>
                </div>
                <div class="col">
                    <div class="naslov">
                        <h3>Kazni(Gosti):</h3>
                    </div>
                    <div class="box">
                        <div class="input-menjava-wrapper">
                        <form action="vnosKazni.php">
                            <table>
                                <tr>
                                    <td>Igralec:</td>
                                    <td><select name="GigralecKazen">
                                    <?php
                                            $qIgralec="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                                            inner join ekipa e on(e.EkipaID=s.ekipaID)
                                            inner join igralec i on (s.igralecID=i.igralecID)
                                            where e.EkipaID=".$_SESSION["tekma"]["gosti"];
                                            $rs=mysqli_query($conn,$qIgralec);
                                            while($row=mysqli_fetch_array($rs)){
                                                $ime=$row["ime"];
                                                $priimek=$row["priimek"];
                                                $ID=$row["IgralecID"];
                                                echo "<option value='$ID'>$ime $priimek</option>";
                                            }
                                        ?>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Minuta: </td>
                                    <td><input type="number" name="Gminuta"></td>
                                </tr>
                                <tr>
                                    <td>Karton:</td>
                                    <td>
                                        <select name="Gkarton" id="k">
                                            <option class="yellow" value="RU">rumeni</option>
                                            <option class="red" value="RD">rdeči</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="dodajKazen"><input type="submit" value="dodaj"></td>
                                </tr>
                            </table>
                        </form>
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

    <?php
    }
    else{
        header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
    }

    ?>

</body>
</html>