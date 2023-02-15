<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#317EFB"/>

	<title>Currency Converter</title>
	<link rel="stylesheet" href="style.css">
    <link rel="manifest" href="manifest.json" />
    <link rel="apple-touch-icon" href="/images/icons/192-192.png">
      <meta name="description" content="Autor: Eryk Świątoniowski, Temat: Progresywna aplikacja webowa monitorująca aktualne kursy walut">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-base.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>

.chart {
  align-content: center;
  display: flex;
  justify-content: center;
}

.modal {
  text-align: center;
}

@media screen {
  .modal:before {
    content: " ";
    display: inline-block;
    height: 100%;
    vertical-align: middle;
  }
}

.modal-dialog {
  display: inline-block;
  height: 100%;
  width: 100%;
  text-align: center;
  vertical-align: middle;
}

.modal-footer {
  color: #00b5e6;
  font-size: 25px;
  text-align: center;
}

#myBtn {
	box-shadow:inset 0px 1px 0px 0px #165c16;
	background-color:rgba(4,170,109,255);
	border-radius:6px;
	border:1px solid #2e963e;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	text-decoration:none;
	text-shadow:0px 1px 0px #528009;
    width:100%;
    text-align:center;
    height:100%;
}


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

.strona{
    display: none;
    width: 100%;
    min-height: 100%;

}
.aktywna{
    display: block;
    width:fit-content;
    height:fit-content; 
}

.list  {
  list-style-type:none;
  width:100%;
}

.content {
  border-radius: 5%;
  background-color: rgba(230, 230, 230, 0.7);
  padding:3%;
  width:fit-content;
  height:fit-content;
  block-size: fit-content;
  margin:auto;
  display: flex;
  flex-direction: column;
  margin-top: 20vh;
}

table.d {
  table-layout: auto;
  width: 100%;  
}





</style>

</head>

<body>



<?php
  session_start();

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

<div class="content"  >



<div class="strona aktywna" id="exchange">


  <table class="d">
 
   <tr>
      <td colspan="3">  <p  class="myText1">CurrencyApp</p> </td>

  </tr>

   <tr>
 
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="exchange" class="menu">Przelicznik</a></td>
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="list" class="menu">Lista</a></td>
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="histogram" class="menu">Histogram</a></td> 
    
    </tr>

   </table>
 
 <hr>
 
  <table class="d">
  <tr>
      <td ><h5>Ilość</h5></td>
      <td><h5>Z</h5></td>
      <td></td>
  <td><h5>Na</h5></td>
    </tr>

    <tr>
      <td><input type = "number" id="input_number" placeholder="0" min="0"></td>
  <td><select id="select1"></select></td>
      <td><input id="myButton2" type="button" class="select-swap" name="swap"  value="Zamień"></td>
  <td><select id="select2" style="width:100%;"></select></td>
      
    </tr>


<table class="d">
    <tr>
 <td><h5>Po przeliczeniu: </h5></td>
     <td ><input type = "number" id="output_number" placeholder="0" readonly></td>
     <td><input style="padding: 10px 5px;" id="myButton2" type="button" name="submit" value = "Przelicz" onclick="licz()"></td>
 
    </tr>
</table>

   
  </table>


</div>


<div class="strona" id="list">
 <table class="d">
 
   <tr>
      <td colspan="3">  <p style="padding:10px 105px;"  class="myText1">CurrencyApp</p> </td>

  </tr>

   <tr>
 
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="exchange" class="menu">Przelicznik</a></td>
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="list" class="menu">Lista</a></td>
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="histogram" class="menu">Histogram</a></td> 
    
    </tr>

   </table>
 
 <hr>
 
<table class="d">
    <tr>  
      <td><select id="select3" style="width:100%;"></select></td>
    </tr>

    <tr>  
      <td > <div id="container"></div></td>
    </tr>


  </table>


</div>

<div class="strona" id="histogram">
  <table class="d">
 
   <tr>
      <td colspan="3">  <p style="padding:10px 105px;"  class="myText1">CurrencyApp</p> </td>

  </tr>

   <tr>
 
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="exchange" class="menu">Przelicznik</a></td>
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="list" class="menu">Lista</a></td>
      <td> <a style="padding: 10px 0;" id="myButton2" href="#" data-target="histogram" class="menu">Histogram</a></td> 
    
    </tr>

   </table>
 
 <hr>
 
 <table class="d">
 
   <tr>
      <td ><h5>Z</h5></td>
      <td><h5>Na</h5></td>
    </tr>

 <tr>
       <td><select id="select4" style="width:100%;"></select> </td>
      
      <td><select id="select5" style="width:100%;"></select> </td> 
    </tr>

  

     <tr>
      <td ><h5>Od</h5></td>
      <td><h5>Do</h5></td>
    </tr>

    <tr>
 
      <td><input type="date" style="width:100%;" id="date1" min="2000-01-01" ></td>
      <td><input type="date" style="width:100%;" id="date2" min="2000-01-01" > </td> 
    
    </tr>

    <tr>
 
       <td colspan="3"><input style="padding: 10px 0;" id="myButton2" type="button" name="submit" value = "Sprawdź" onclick="histogram()"></td>
   
    </tr>

  
    <tr>  
      <td colspan="3"> <div id="container2"></div></td>
    </tr>

    <tr>  <td colspan="3"> 
     
     
      
 
   
      <button id="myBtn" class="btn btn-primary" data-toggle="modal" data-target="#myModal" class="myModal">Pokaż wykres</button>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="chart" id="chart_div"></div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

    </td></tr>

  </table>
</div>

</div>


  <footer class = footer>
    &copy; Copyright 2023, Rzeszów | Eryk Świątoniowski

  </footer>

<script src="spa.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>