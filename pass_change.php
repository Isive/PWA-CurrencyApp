<?php include('Reg_sec.php') ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="style.css">
<link rel="manifest" href="manifest.json" />
<style>

    .dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  width:100%;;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;

  background-color: #f1f1f1;
  min-width: 160px;
  position:relative;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  width:20%;;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}

wrapper{
  width: 100%;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);
}
.wrapper .title{
  height: 90px;
  background-color:rgba(4,170,109,255);
  border-radius: 10%;
  color: #fff;
  font-size: 30px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form{
  padding: 30px 25px 25px 25px;
}
.wrapper form .row{
  height: 45px;
  margin-bottom: 15px;
  position: relative;
}
.wrapper form .row input{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 60px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
}
form .row input:focus{
  box-shadow: inset 0px 0px 2px 2px rgba(26,188,156,0.25);
}
form .row input::placeholder{
  color: #999;
}
.wrapper form .row i{
  position: absolute;
  width: 47px;
  height: 100%;
  color: #fff;
  font-size: 18px;
  background-color:rgba(4,170,109,255);
  border-radius: 5px 0 0 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form .pass{
  margin: -8px 0 20px 0;
}
.wrapper form .pass a{
  font-size: 17px;
  text-decoration: none;
}
.wrapper form .pass a:hover{
  text-decoration: underline;
}
.wrapper form .button input{
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  padding-left: 0px;
  background-color: rgba(20, 52, 157, 0.8); 
  cursor: pointer;
}
form .button input:hover{
  background: #04aa6d;
}
.wrapper form .signup-link{
  text-align: center;
  margin-top: 20px;
  font-size: 17px;
}
.wrapper form .signup-link a{
  color: rgba(20, 52, 157);
  text-decoration: none;
}
form .signup-link a:hover{
  text-decoration: underline;
}

.content {
  border-radius: 5%;
  background-color: rgba(230, 230, 230, 0.7);
  padding:3%;
  width:fit-content;
  height:fit-content;
  margin:auto;
  display: flex;
  flex-direction: column;
  margin-top: 20vh;
}

</style>
</head>
<body>

<?php

  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)) {
    header("Location: login.php");
    exit;
}
?>



<header class="header">

<div class="dropdown"style="float:right;">
<button class="dropbtn">Menu</button>
<div class="dropdown-content">
<a href="index.php"> Strona Główna</a>
<a href="account.php"> Konto</a>
<a href="logout.php" style="background-color:red;color:white;">Logout</a> 
</div>
</div>





</header>


<div class="content" >

<?php
$errors = array(); 
//$id = "";
$_SESSION['loggedin']=true;
$db = mysqli_connect("localhost","root","","freedb_currencyConv");

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['passchange'])) {

    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    $npass = mysqli_real_escape_string($db, $_POST['npass']);
    $rnpass = mysqli_real_escape_string($db, $_POST['rnpass']);
    
    $pass = md5($pass);

    if ($_SESSION['password'] != $pass) {
        array_push($errors, "Błędne hasło!");
      }

      if ($npass != $rnpass) {
        array_push($errors, "Hasła się nie zgadzają!");
      }
   
      if (count($errors) == 0) {
        $npassword = md5($npass);
    $sql = "UPDATE users SET password='$npassword' WHERE id='".$_SESSION['id']."' ";

    if (mysqli_query($db, $sql)) {
     $_SESSION['password']=$npassword;
     
     array_push($errors, "Hasło zmienione");

    } else {
      echo "Błąd przy aktualizacji: " . mysqli_error($conn);
    }
}
}

mysqli_close($db);
?>

<div class="wrapper">
        <div class="title"><span>Zmień hasło</span></div>
        <form action="pass_change.php" method="POST">

        <div class="row">
            <i class="bi bi-person"></i>
            <input type="password" name="pass" placeholder="Stare hasło" >
          </div>

          <div class="row">
            <i class="bi bi-person"></i>
            <input type="password" name="npass" placeholder="Nowe hasło" >
          </div>

          <div class="row">
            <i class="bi bi-person"></i>
            <input type="password" name="rnpass" placeholder="Powtórz nowe hasło" >
          </div>

         
          <?php include('errors.php'); ?>
        
          <div class="row button">
            <input type="submit" name="passchange" value="Zaktualizuj" style = "color:white;cursor:pointer;background-color:rgba(4,170,109,255);border-radius:25px;padding:1%;margin-bottom:1%;">
          </div>
    
        </form>
      </div>
</div>

  <footer class = footer>
    &copy; Copyright 2023, Rzeszów | Eryk Świątoniowski

  </footer>


</body>
</html>
