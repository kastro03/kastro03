<?php
session_start();

foreach($_SESSION["tekma"] as $k=>$x)
echo $k." = ".$x."<br>";

echo "<br><br>";

foreach($_SESSION["domacaPostava"] as $k=>$x)
echo $k." = ".$x."<br>";

echo "<br><br>";

foreach($_SESSION["gostojocaPostava"] as $k=>$x)
echo $k." = ".$x."<br>";

echo "<br><br>";

if(isset($_SESSION["goliDNavaden"])){
    foreach($_SESSION["goliDNavaden"] as $x)
        foreach($x as $k=>$v)
            echo "$k = $v<br>";
    }
    echo "<br><br>";

if(isset($_SESSION["goliGNavaden"])){
foreach($_SESSION["goliGNavaden"] as $x)
    foreach($x as $k=>$v)
        echo "$k = $v<br>";
}
echo "<br><br>";

if(isset($_SESSION["menjaveDomaci"])){
foreach($_SESSION["menjaveDomaci"] as $x)
    foreach($x as $k=>$v)
         echo "$k = $v<br>";
}
         echo "<br><br>";
if(isset($_SESSION["menjaveGosti"])){
foreach($_SESSION["menjaveGosti"] as $x)
    foreach($x as $k=>$v)
        echo "$k = $v<br>";
         }
echo "<br><br>";
if(isset($_SESSION["kazniDomaci"])){
foreach($_SESSION["kazniDomaci"] as $x)
    foreach($x as $k=>$v)
        echo "$k = $v<br>";
}
echo "<br><br>";

if(isset($_SESSION["kazniGosti"])){
foreach($_SESSION["kazniGosti"] as $x)
    foreach($x as $k=>$v)
        echo "$k = $v<br>";
}
echo "<br><br>";


$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";
$conn=mysqli_connect($servername,$username,"",$DBname);

$tekma=$_SESSION["tekma"];
$datum=$tekma["datum"];
$cas=$tekma["cas"];
$domaci=$tekma["domaci"];
$gosti=$tekma["gosti"];
$HTgoliD=$tekma["HTgoliD"];
$HTgoliG=$tekma["HTgoliG"];
$FTgoliD=$tekma["FTgoliD"];
$FTgoliG=$tekma["FTgoliG"];
$sodnik=$tekma["sodnik"];
$krog=$tekma["krog"];
$sezona=$tekma["sezona"];
$KapetanD=$_SESSION["KapetanD"];
$KapetanG=$_SESSION["KapetanG"];

$qINSERTTEKMA="INSERT INTO Tekma (datum,cas,domaci,gosti,resHTD,resHTG,resFTD,resFTG,SodnikID,Krog,Sezona,KapetanD,KapetanG) 
VALUES('$datum','$cas',$domaci,$gosti,$HTgoliD,$HTgoliG,$FTgoliD,$FTgoliG,$sodnik,$krog,$sezona,$KapetanD,$KapetanG)";

if(mysqli_query($conn,$qINSERTTEKMA)){
    echo "Tekma uspesno posodobljena";

    $qTekmaID="SELECT TekmaID from tekma order by TekmaID desc";
    $rs=mysqli_query($conn,$qTekmaID);
    $row=mysqli_fetch_array($rs);
    $TekmaID=$row["TekmaID"];

    
//INSERT MENJAVA-------------------------------------------

$tmpD=[];

if(isset($_SESSION["menjaveDomaci"])){
    $menjaveDomaci=$_SESSION["menjaveDomaci"];
            foreach($menjaveDomaci as $x){
                $igralecV=$x["igralecV"];
                $igralecIZ=$x["igralecIZ"];
                $minuta=$x["minuta"];
            $qINSERTMENJAVE="INSERT into menjava (igralecV,igralecIZ,minuta,TekmaID) 
            VALUES($igralecV,$igralecIZ,$minuta,$TekmaID)";
            mysqli_query($conn,$qINSERTMENJAVE);
            $q="INSERT INTO tekma_igralec VALUES($igralecV,$TekmaID,$minuta)";
            mysqli_query($conn,$q);

            $tmp[]=$igralecV;
            }
        }

        $tmpG=[];
        if(isset($_SESSION["menjaveGosti"])){
        $menjaveGosti=$_SESSION["menjaveGosti"];
            foreach($menjaveGosti as $x){
                $igralecV=$x["igralecV"];
                $igralecIZ=$x["igralecIZ"];
                $minuta=$x["minuta"];
            $qINSERTMENJAVE="INSERT into menjava (igralecV,igralecIZ,minuta,TekmaID) 
            VALUES($igralecV,$igralecIZ,$minuta,$TekmaID)";
            mysqli_query($conn,$qINSERTMENJAVE);
            $q="INSERT INTO tekma_igralec VALUES($igralecV,$TekmaID,$minuta)";
            mysqli_query($conn,$q);

            $tmpG[]=$igralecV;
            }
        }



//INSERT Tekma_igralec

            $domacaPostava=$_SESSION["domacaPostava"];
            $gostojocaPostava=$_SESSION["gostojocaPostava"];
            $DRezervniIgralci=$_SESSION["domaceMenjave"];
            $GRezervniIgralci=$_SESSION["gostojoceMenjave"];

            foreach($domacaPostava as $k=>$x)
            {
                $q="INSERT INTO tekma_igralec VALUES($x,$TekmaID,1)";
                mysqli_query($conn,$q);
            }

            foreach($gostojocaPostava as $k=>$x)
            {
                $q="INSERT INTO tekma_igralec VALUES($x,$TekmaID,1)";
                mysqli_query($conn,$q);
            }

            foreach($DRezervniIgralci as $k=>$x)
            {
                if(!in_array($x,$tmpD)){
                    $q="INSERT INTO tekma_igralec VALUES($x,$TekmaID,0)";
                    mysqli_query($conn,$q);
                }
            }

            foreach($GRezervniIgralci as $k=>$x)
            {
                if(!in_array($x,$tmpG)){
                    $q="INSERT INTO tekma_igralec VALUES($x,$TekmaID,0)";
                    mysqli_query($conn,$q);
                }
            }

//INSERT GOL-----------------------------------------



if(!empty($_SESSION["goliDDrugacen"])){
    $goliDDrugacen=$_SESSION["goliDDrugacen"];
    $i=1;

            foreach($goliDDrugacen as $x)
            {
                
                $niz="DigralecGol$i";
                $igralec=$x[$niz];
                $minuta=$x["minuta"];
                $opomba=$x["opomba"];

                $qINSERTGOL="INSERT INTO gol (igralecID,minuta,opomba,tekmaID)
                VALUES ($igralec,$minuta,'$opomba',$TekmaID)";
                mysqli_query($conn,$qINSERTGOL);
                $i++;
            }
        }

        if(!empty($_SESSION["goliDNavaden"])){
            $goliDNavaden=$_SESSION["goliDNavaden"];
            $i=1;
                foreach($goliDNavaden as $x)
                {
                    
                    $niz="DigralecGol$i";
                    echo $niz;
                    $igralec=$x[$niz];
                    $minuta=$x["minuta"];

                    $qINSERTGOL="INSERT INTO gol (igralecID,minuta,tekmaID)
                    VALUES ($igralec,$minuta,$TekmaID)";
                    mysqli_query($conn,$qINSERTGOL);
                    $i++;
                }
        }

        if(!empty($_SESSION["goliGDrugacen"])){
            $goliGDrugacen=$_SESSION["goliGDrugacen"];

            $i=1;
                foreach($goliGDrugacen as $x)
                {
                    
                    $niz="GigralecGol$i";
                    $igralec=$x[$niz];
                    $minuta=$x["minuta"];
                    $opomba=$x["opomba"];

                    $qINSERTGOL="INSERT INTO gol (igralecID,minuta,opomba,tekmaID)
                    VALUES ($igralec,$minuta,'$opomba',$TekmaID)";
                    mysqli_query($conn,$qINSERTGOL);
                    $i++;
                }
        }
        
        if(!empty($_SESSION["goliGNavaden"])){
            $goliGNavaden=$_SESSION["goliGNavaden"];
            $i=1;
                foreach($goliGNavaden as $x)
                {
                    
                    $niz="GigralecGol$i";
                    $igralec=$x[$niz];
                    $minuta=$x["minuta"];

                    $qINSERTGOL="INSERT INTO gol (igralecID,minuta,tekmaID)
                    VALUES ($igralec,$minuta,$TekmaID)";
                    mysqli_query($conn,$qINSERTGOL);
                    $i=$i+1;
                }
            }

        //INSERT Kazni----------------------------

        
       
if(isset($_SESSION["kazniDomaci"])){
    $kazniDomaci=$_SESSION["kazniDomaci"];
        foreach($kazniDomaci as $x)
        {
            $igralec=$x["igralec"];
            $minuta=$x["minuta"];
            $karton=$x["karton"];

            $qINSERTKAZEN="INSERT INTO Kazen (igralecID,minuta,karton,TekmaID) VALUES
            ($igralec,$minuta,'$karton',$TekmaID)";
            mysqli_query($conn,$qINSERTKAZEN);
        }
}

if(isset($_SESSION["kazniGosti"])){
    $kazniGosti=$_SESSION["kazniGosti"];
        foreach($kazniGosti as $x)
        {
            $igralec=$x["igralec"];
            $minuta=$x["minuta"];
            $karton=$x["karton"];

            $qINSERTKAZEN="INSERT INTO Kazen (igralecID,minuta,karton,TekmaID) VALUES
            ($igralec,$minuta,'$karton',$TekmaID)";
            mysqli_query($conn,$qINSERTKAZEN);
        }
}

        //UPDATE--LESTVICA------------------

        if($FTgoliD>$FTgoliG) //ČE ZMAGAJO DOMACI
        {
            //-----------------------------
            $qDomaci=
            "UPDATE lestvica set 
                stTock=3,
                zmage=zmage+1,
                goli=goli+$FTgoliD,
                dobljeniGoli=dobljeniGoli+$FTgoliG,
                stTekm=stTekm+1
                WHERE ekipaID=$domaci";
            //----------------------------------

                $qGosti=
                "UPDATE lestvica set
                porazi=porazi+1,
                goli=goli+$FTgoliG,
                dobljeniGoli=dobljeniGoli+$FTgoliD,
                stTekm=stTekm+1
                WHERE ekipaID=$gosti";
        }

        if($FTgoliG>$FTgoliD) // ČE ZMAGAJO GOSTJE
        {
            $qGosti=
            "UPDATE lestvica set
            stTock=stTock+3,
            zmage=zmage+1,
            goli=goli+$FTgoliG,
            dobljeniGoli=dobljeniGoli+$FTgoliD,
            stTekm=stTekm+1
            WHERE ekipaID=$gosti";

            $qDomaci=
            "UPDATE lestvica set
            porazi=porazi+1,
            goli=goli+$FTgoliD,
            dobljeniGoli=dobljeniGoli+$FTgoliG,
            stTekm=stTekm+1
            WHERE ekipaID=$domaci";
        } 

        if($FTgoliD==$FTgoliG)
        {
            $qDomaci=
            "UPDATE lestvica set
            stTock=stTock+1,
            neodloceno=neodloceno+1,
            goli=goli+$FTgoliD,
            dobljeniGoli=dobljeniGoli+$FTgoliG,
            stTekm=stTekm+1
            WHERE ekipaID=$domaci";

            $qGosti=
            "UPDATE lestvica set
            stTock=stTock+1,
            neodloceno=neodloceno+1,
            goli=goli+$FTgoliG,
            dobljeniGoli=dobljeniGoli+$FTgoliD,
            stTekm=stTekm+1
            WHERE ekipaID=$gosti";
        }

        if(mysqli_query($conn,$qDomaci) &&  mysqli_query($conn,$qGosti))
        {
            $msg="Uspesno";
        }
        else
            $msg="Neuspesno";
       


}
else
$msg="Neuspesno";

$_SESSION["msg"]=$msg;

header("Location:http://localhost/Matura_Projekt/ADMIN/admin.php");
?>