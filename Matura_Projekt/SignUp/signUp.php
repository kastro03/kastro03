<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signUp.css">
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Montserrat'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Registracija</title>
</head>
<body>
    <div class="home">
        <a id="loginPage" href="http://localhost/Matura_Projekt/Login/loginPage.php"><i class="fa fa-home" style="color: black; font-size:30px"></i> Prijava</a>
    </div>

    <div class="center">
        <h1>Registracija</h1>

        
    <form>
        
        <div class="txt_field">
            <input type="text" name="uporabnik" required />
            <span></span>
            <label>Uporabnik</label>
        </div>

        <div class="txt_field">
            <input type="text" name="email" required />
            <span></span>
            <label>E-mail</label>
        </div>

        <div class="txt_field">
            <input type="password" name="password"  required/>
            <span></span>
            <label>geslo</label>
        </div>

        <div class="txt_field">
            <input type="password" name="re-password"  required/>
            <span></span>
            <label>Ponovi geslo</label>
        </div>

        <div class="txt_field submit">
            <input type="submit" value="vnos">
        </div>
    
    </form>
</div>
</body>
</html>

<?php

$servername = "localhost";
$username = "root";
$DBname="matura_projektnogomet";

$conn=mysqli_connect($servername,$username,"",$DBname);

if(!empty($_GET["uporabnik"]) && !empty($_GET["password"]) && !empty($_GET["re-password"])){
    
$user="'".$_GET['uporabnik']."'";
$password=$_GET['password'];
$repassword=$_GET['re-password'];
$mail=$_GET["email"];

$password=md5($password);

$q="INSERT INTO user (uporabnik,geslo,email) VALUES ($user,'$password','$mail')";

if(strlen($_GET["password"])<8){
echo "Geslo mora vsebovati vsaj 8 znakov";
}

if($repassword==$_GET["password"] && strlen($_GET["password"])>=8)
    {
        if(mysqli_query($conn,$q))
        {
            echo "dhfjsdhf";
            $subject="Registracija";
            $body="Registracija uspesna";
            if(mail($mail,$subject,$body)){
                echo "uspesno izvedeno";
            }
            else
            {
                echo "neuspesno";
            }
        }
        else 
        echo "n";
    }
}


    mysqli_close($conn);

?>