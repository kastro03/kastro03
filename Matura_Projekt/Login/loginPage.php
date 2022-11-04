<?php
session_start();
$message="";
if(count($_GET)>0) {
    $geslo=$_GET["password"];
    $geslo=md5($geslo);
    $con = mysqli_connect('localhost','root','','matura_projektnogomet') or die('Unable To connect');
    $result = mysqli_query($con,"SELECT * FROM user WHERE uporabnik='" . $_GET["user"] . "' and geslo = '$geslo'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
    $_SESSION["id"] = $row['userID'];
    $_SESSION["name"] = $row['uporabnik'];
    } else {
     $message = "Napačno geslo ali uporabnik";
    }
}
if(isset($_SESSION["id"])) {
header("Location:http://localhost/Matura_Projekt/home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginPage.css">
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Montserrat'>
    <title>Prijava</title>
</head>
<body>
<div class="center">
    <h1>Prijava</h1>
    
<form>
        
    <div class="txt_field">
            <input type="text" name="user" required/>
            <span></span>
            <label>Uporabnik</label>
        </div>

        <div class="txt_field">
            <input type="password" name="password" required/>
            <span></span>
            <label>Geslo</label>
        </div>

        <div class="txt_field submit">
            <input type="submit" value="PRIJAVA"/>
            </div>

            <div class="txt_field signUp">
                Nov uporabnik?<br>
                <a href="http://localhost/Matura_Projekt/SignUp/signUp.php">Registriraj se</a>
            </div>

            <div class="txt_field pozGeslo">
               <a href="pozabljenoGeslo.php">POZABLJENO GESLO</a>
            </div>
        
        <div class="message"><?php if($message!="") { echo $message; } ?></div>
</form>
</div>
</body>
</html>