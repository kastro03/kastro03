<?php

    if(isset($_GET["value"])){
        $val=$_GET["value"];
        $servername = "localhost";
        $username = "root";
        $DBname="matura_projektnogomet";

        $conn=mysqli_connect($servername,$username,"",$DBname);

        $q="SELECT * from igralec i inner join sezona_igralec s on (i.IgralecID=s.IgralecID) where ekipaID=$val";
        $rs=mysqli_query($conn,$q);

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
    }

?>