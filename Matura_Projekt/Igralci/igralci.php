<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="igralci.css">
    <link rel="stylesheet" href="flags.css">
    <title>Igralci</title>
</head>
<body>
    <?php
    if($_SESSION["name"]) {
        require_once("C:/xampp/htdocs/Matura_Projekt/layout.php");
        
    $servername = "localhost";
    $username = "root";
    $DBname="matura_projektnogomet";

    $conn=mysqli_connect($servername,$username,"",$DBname);
    ?>

    <div id="main">

    <div class="center">
    <div class="filter-row">
        <div class="sezona">
            <select name="sezona">
                <?php
                    $q="SELECT * from sezona";
                    $res=mysqli_query($conn,$q);
                    while($row=mysqli_fetch_array($res))
                    {
                        $tmp=$row["naziv"];
                        $ID=$row["SezonaID"];
                        echo "<option value='$ID'>$tmp</option>";
                    }
                ?>
            </select>
            <select name="ekipa" onchange="ekipa(this.value)">
                <?php
                    $q="SELECT * from ekipa order by naziv";
                    $res=mysqli_query($conn,$q);
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<option value='".$row['EkipaID']."'>".$row['naziv']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
</div>

    <div class="naslov">
        <h1>Seznam Igralcev</h1>
</div>
      <?php


        $q="SELECT * FROM Igralec order by ime,priimek";
        $rs=mysqli_query($conn,$q);


        echo "<table id='tabela'>";

        echo "<tr class='first'>";
            echo "<td class='col1'>Ime igralca</td>";
            echo "<td class='col2'>Datum rojstva</td>";
            echo "<td class='col3'>Igralno mesto</td>";
            
            echo "<td class='col4'>Drzava</td>";
            echo "<td></td>";
            echo "<td class='col5'>Klub</td>";
            echo "<td></td>";
        echo "</tr>";
        
    require_once("C:/xampp/htdocs/Matura_Projekt/Obrazec za Igralca/drzave.php");
    
        while($row=mysqli_fetch_array($rs))
        {
            echo "<tr>";
                echo "<td class='col1'>";
                    echo $row["Ime"] ." ".$row["Priimek"];
                echo "</td>";


                echo "<td class='col2'>";
                    echo $row["DatumRojstva"];
                echo "</td>";
           

                echo "<td class='col3'>";
                    echo $row["pozicija"];
                echo "</td>";


                echo "<td class='col4d'>";
                require_once("C:/xampp/htdocs/Matura_Projekt/Obrazec za Igralca/drzave.php");
    
                    echo $row["drzava"];
                    echo "</td>";

                    echo "<td class='col-drzava'>";
                    foreach($drzave as $k =>$x)
                    {
                        if($row["drzava"]==$x)
                        {
                            $flag=$k;
                            break;
                        }
                    }
                    
        
                    
                    echo "<span class='flag $flag'></span>";
                    echo "</td>";
                $tmp=$row["IgralecID"];
                $querySelectEkipa="SELECT ekipaID from Sezona_igralec where igralecID="."'$tmp'";

                $res=mysqli_query($conn,$querySelectEkipa);
                $row=mysqli_fetch_array($res);
                $tmp=$row["ekipaID"];
                $q1="SELECT naziv,linkLogo from ekipa where EkipaID = $tmp";
                $rs1=mysqli_query($conn,$q1);
                $row1=mysqli_fetch_array($rs1);


                $tmp=$row1["linkLogo"];

                echo "<td class='col5'>";
                    echo $row1["naziv"];
                    
                echo "</td>";
                echo "<td class='colk'>";
                echo "<img style='margin-left:4px;display: inline-block;' src='$tmp' height='25px' width='25px'>";
                echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }else {
        header("Location:http://localhost/Matura_Projekt/Login/loginPage.php");
        }
        ?>

    </div>

    <script>
        function ekipa(str){
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tabela").innerHTML = this.responseText;
                }
            }
            console.log(document.getElementById("tabela"));   
            xmlhttp.open("GET", "http://localhost/Matura_Projekt/Igralci/selectEkipa.php?value="+str,true);
            xmlhttp.send();
        }
        

    </script>
</body>
</html>