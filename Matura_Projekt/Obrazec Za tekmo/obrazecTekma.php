<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="obrazecTekma.css">
    <title>Obrazec za Tekmo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php   
        if($_SESSION["name"]=="Miha123"){
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
        $servername = "localhost";
        $username = "root";
        $DBname="matura_projektnogomet";

        $conn=mysqli_connect($servername,$username,"",$DBname);
        unset($_SESSION["gostojocaPostava"]);
        unset($_SESSION["domacaPostava"]);
        unset($_SESSION["tekma"]);
        unset($_SESSION["menjaveDomaci"]);
        unset($_SESSION["domaceMenjave"]);
        unset($_SESSION["gostojoceMenjave"]);
        unset($_SESSION["menjaveGosti"]);
        unset($_SESSION["goliGNavaden"]);
        unset($_SESSION["goliDNavaden"]);
        unset($_SESSION["goliGDrugacen"]);
        unset($_SESSION["goliDDrugacen"]);
        unset($_SESSION["kazniGosti"]);
        unset($_SESSION["kazniDomaci"]);
    ?>

    <div id="main">
            <div class="naslov">
                <h2>Obrazec za tekmo</h2>
            </div>
      <div class="containerObrazec">
            <form action="vnosTekma.php">
                <div class="DatumVnos">
                    <label>Datum  in čas tekme: </label>
                    <input type="date" name="datumTekme" required/>
                    <input type="time" name="casTekme" required/>
                    <br>
                    KROG:<input type="text" name="krog" id="krog" required/>
                    <br>
                    Stadion: <span id="stadion">Emirates Stadium</span>
                </div>


                    <div class="col1">
                        <label>Domača ekipa: </label>
                        <select name="domaci" id="selectEkipa" onchange="vseDomaci(this.value);">
                            <?php
                                $q="SELECT naziv FROM ekipa order by naziv";
                                $rs=mysqli_query($conn,$q);

                                while($row=mysqli_fetch_array($rs))
                                {
                                    $x=$row["naziv"];
                                    echo "<option value='$x'>$x</option>";
                                }
                            ?>
                            </select>
                    </div>

                    <div class="col2">
                        <label>Gostojoča ekipa: </label>
                        <select name="gosti" onchange="vseGosti(this.value);">
                            <?php
                                $q="SELECT naziv FROM ekipa order by naziv";
                                $rs=mysqli_query($conn,$q);

                                while($row=mysqli_fetch_array($rs))
                                {
                                    $x=$row["naziv"];
                                    echo "<option value='$x'>$x</option>";
                                }
                            ?>
                            </select>
                    </div>
            
            
                <div class="postava">
                    <!------------------------------------------------------------->
                    <div class="domacaPostava col1">
                       <?php 

                        $q="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                        inner join ekipa e on(e.EkipaID=s.ekipaID)
                        inner join igralec i on (s.igralecID=i.igralecID)
                         where e.naziv='Arsenal' AND i.pozicija<>'vratar'";


                        $qGK="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                        inner join ekipa e on(e.EkipaID=s.ekipaID)
                        inner join igralec i on (s.igralecID=i.igralecID)
                         where e.naziv='Arsenal' AND i.pozicija='vratar'";

                        $rs=mysqli_query($conn,$q);

                        $rsGK=mysqli_query($conn,$qGK);
                        
                        echo "Vratar: <br>";
                        
                        echo "<div id='GKD'>";
                            echo "<select class='inputPlayer' name='Dvratar'>";
                                while($row=mysqli_fetch_array($rsGK))
                                {
                                    $ime=$row["ime"];
                                    $priimek=$row["priimek"];
                                    $ID=$row["IgralecID"];
                                    echo "<option value='$ID'>$ime $priimek</option>";
                                }
                                echo "</select>";
                        echo "</div><br>";
                       
                                
                        echo "<div id='domaci'>";

                        for($i=2;$i<=11;$i++)
                        {
                            echo "igralec $i:<br>";
                            echo "<select name='Digralec$i' class='inputPlayer'>";
                            while($row=mysqli_fetch_array($rs))
                            {
                                $ID=$row['IgralecID'];
                                $ime=$row["ime"];
                                $priimek=$row["priimek"];
                                echo "<option value='$ID'>$ime $priimek</option>";
                            }
                            $rs=mysqli_query($conn,$q);
                            echo "</select>";
                            echo "<br><br>";
                        }
                        $rs=mysqli_query($conn,$q);
                        echo "<br><br>";
                        echo "<span style='color: red'>Kapetan: </span> <br>";
                        echo "<select name='KapetanD' class='inputPlayer'>";
                            while($row=mysqli_fetch_array($rs))
                            {
                                $ID=$row['IgralecID'];
                                $ime=$row["ime"];
                                $priimek=$row["priimek"];
                                echo "<option value='$ID'>$ime $priimek</option>";
                            }
                        echo "</select>";
                        echo "</div>";
                       ?>
                    
                    </div>

                    <!------------------------------------------------------------>
                
                    <div class="gostojocaPostava col2">
                        <?php

                        
                        $q="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                        inner join ekipa e on(e.EkipaID=s.ekipaID)
                        inner join igralec i on (s.igralecID=i.igralecID)
                        where e.naziv='Arsenal' AND i.pozicija<>'vratar'";


                        $qGK="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                        inner join ekipa e on(e.EkipaID=s.ekipaID)
                        inner join igralec i on (s.igralecID=i.igralecID)
                        where e.naziv='Arsenal' AND i.pozicija='vratar'";

                        $rs=mysqli_query($conn,$q);

                        $rsGK=mysqli_query($conn,$qGK);

                        echo "Vratar: <br>";

                        echo "<div id='GKG'>";
                            echo "<select class='inputPlayer' name='Gvratar'>";
                                while($row=mysqli_fetch_array($rsGK))
                                {
                                    $ime=$row["ime"];
                                    $priimek=$row["priimek"];
                                    $ID=$row["IgralecID"];
                                    echo "<option value='$ID'>$ime $priimek</option>";
                                }
                                echo "</select>";
                        echo "</div><br>";

                                
                        echo "<div id='gosti'>";

                        for($i=2;$i<=11;$i++)
                        {
                            echo "igralec $i:<br>";
                            echo "<select name='Gigralec$i' class='inputPlayer'>";
                            while($row=mysqli_fetch_array($rs))
                            {
                                $ID=$row['IgralecID'];
                                $ime=$row["ime"];
                                $priimek=$row["priimek"];
                                echo "<option value='$ID'>$ime $priimek</option>";
                            }
                            $rs=mysqli_query($conn,$q);
                            echo "</select>";
                            echo "<br><br>";
                        }

                        $rs=mysqli_query($conn,$q);
                        echo "<br><br>";
                        echo "<span style='color: red'>Kapetan: </span> <br>";
                        echo "<select name='KapetanG' class='inputPlayer'>";
                            while($row=mysqli_fetch_array($rs))
                            {
                                $ID=$row['IgralecID'];
                                $ime=$row["ime"];
                                $priimek=$row["priimek"];
                                echo "<option value='$ID'>$ime $priimek</option>";
                            }
                        echo "</select>";

                        echo "</div>";
                        ?>
                        
                    </div>
                </div>  

                <div id="menjave">
                    <h2>Menjave</h2>
                    <div id="menjaveDomaci" class="col1">
                        <?php

                        $q="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                        inner join ekipa e on(e.EkipaID=s.ekipaID)
                        inner join igralec i on (s.igralecID=i.igralecID)
                        where e.naziv='Arsenal'";

                        $rs=mysqli_query($conn,$q);

                            for($a=1;$a<10;$a++)
                            {
                                echo "menjava ".$a.":<br>";
                                echo "<select name='Dmenjava$a' class='inputPlayer'>";
                                    while($row=mysqli_fetch_array($rs))
                                    {
                                        $ID=$row['IgralecID'];
                                        $ime=$row["ime"];
                                        $priimek=$row["priimek"];
                                        echo "<option value='$ID'>$ime $priimek</option>";
                                    }
                                    $rs=mysqli_query($conn,$q);
                                    echo "</select><br><br>";
                            }
                        ?>
                    </div>

                    <div id="menjaveGosti" class="col1">
                            <?php

                        $q="SELECT i.IgralecID,ime,priimek from Sezona_igralec s
                        inner join ekipa e on(e.EkipaID=s.ekipaID)
                        inner join igralec i on (s.igralecID=i.igralecID)
                        where e.naziv='Arsenal'";

                        $rs=mysqli_query($conn,$q);

                            for($a=1;$a<10;$a=$a+1)
                            {
                                echo "menjava ".$a.":<br>";
                                echo "<select name='Gmenjava$a' class='inputPlayer'>";
                                    while($row=mysqli_fetch_array($rs))
                                    {
                                        $ID=$row['IgralecID'];
                                        $ime=$row["ime"];
                                        $priimek=$row["priimek"];
                                        echo "<option value='$ID'>$ime $priimek</option>";
                                    }
                                    $rs=mysqli_query($conn,$q);
                                    echo "</select><br><br>";
                            }
                        ?>
                    </div>
                </div>

                <div class="HTrezultat">
                Polčas rezultat: <input type="text" name="goliDHT" /> : <input type="text" name="goliGHT" />
             </div>

            <div class="FTrezultat">
                Končni rezultat: <input type="text" name="goliDFT" /> : <input type="text" name="goliGFT" />
             </div>

            <div class="sodnik">
                Glavni sodnik:
                <select name="sodnik">
                    <?php
                        $q="SELECT * from sodnik";
                        $rs=mysqli_query($conn,$q);
                        while($row=mysqli_fetch_array($rs))
                        {
                            $ime=$row["Ime"];
                            $priimek=$row["Priimek"];
                            $ID=$row["SodnikID"];
                            echo "<option value='$ID'>$ime $priimek</option>";
                        }

                    ?>
                </select>
            </div>
             
            <div class="vnos">
                <button type="submit">
                    <i class="fa fa-arrow-right" style="font-size:40px;color:white;"></i>
                </button>
            </div>


            </form>

        </div>


    </div>

    <script>

        
        
        function vseDomaci(str){
            ZaStadion(str);
            ZaGKDomaci(str);
            ZaIgralceDomaci(str);
            ZaMenjaveDomaci(str);
        }

        function vseGosti(str){
            ZaIgralceGosti(str);
            ZaGKGosti(str);
            ZaMenjaveGosti(str);
        }


        function ZaStadion(str){
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("stadion").innerHTML = this.responseText;
                }
            }
            console.log(document.getElementById("stadion"));   
            xmlhttp.open("GET", "http://localhost/Matura_Projekt/Obrazec%20Za%20tekmo/stadion.php?value="+str,true);
            xmlhttp.send();
        }

        function ZaGKDomaci(str) {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("GKD").innerHTML = this.responseText;
                }
            }
            console.log(document.getElementById("GKD"));   
            xmlhttp.open("GET", "http://localhost/Matura_Projekt/Obrazec%20Za%20tekmo/ZaVratarD.php?value="+str,true);
            xmlhttp.send();
        }


        function ZaIgralceDomaci(str) {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("domaci").innerHTML = this.responseText;
                }
            }
            console.log(document.getElementById("domaci"));   
            xmlhttp.open("GET", "http://localhost/Matura_Projekt/Obrazec%20Za%20tekmo/ZaIgralceDomaci.php?value="+str,true);
            xmlhttp.send();
        }
        
        function ZaMenjaveDomaci(str) {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("menjaveDomaci").innerHTML = this.responseText;
                }
            }
            console.log(document.getElementById("domaci"));   
            xmlhttp.open("GET", "http://localhost/Matura_Projekt/Obrazec%20Za%20tekmo/ZaMenjaveD.php?value="+str,true);
            xmlhttp.send();
        }

        function ZaIgralceGosti(str){
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("gosti").innerHTML = this.responseText;
                }
            }
            console.log(document.getElementById("gosti"));   
            xmlhttp.open("GET", "http://localhost/Matura_Projekt/Obrazec%20Za%20tekmo/ZaIgralceGosti.php?value="+str,true);
            xmlhttp.send();
        }

        function ZaMenjaveGosti(str) {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("menjaveGosti").innerHTML = this.responseText;
                }
            }
            console.log(document.getElementById("domaci"));   
            xmlhttp.open("GET", "http://localhost/Matura_Projekt/Obrazec%20Za%20tekmo/ZaMenjaveG.php?value="+str,true);
            xmlhttp.send();
        }

        function ZaGKGosti(str){
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("GKG").innerHTML = this.responseText;
                }
            }
            console.log(document.getElementById("GKG"));   
            xmlhttp.open("GET", "http://localhost/Matura_Projekt/Obrazec%20Za%20tekmo/ZaVratarG.php?value="+str,true);
            xmlhttp.send();
        }
    </script>
    <?php
}
else{
    header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
}
?>
</body>
</html>