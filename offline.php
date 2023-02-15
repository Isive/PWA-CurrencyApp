<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Currency Converter</title>
	<link rel="stylesheet" href="style.css">
	
    <link rel="manifest" href="manifest.json" />

	<style>


#container_offline {
	overflow:auto;
    max-height: 30vh;
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

 <header class="header">

<div class="dropdown"style="float:right;">
<button class="dropbtn">Menu</button>
<div class="dropdown-content">
<a href="login.php"> Zaloguj</a>

</div>
</div>

</header>

<div class="content"  >

<div  id="list">
 <table class="d">
 
   <tr>
      <td colspan="3">  <p style="padding:10px 105px;"  class="myText1">CurrencyApp</p> </td>

  </tr>

   </table>
 
 <hr>
 
<table class="d">
<tr>
<p id="p1" style="text-align:center;font-family: Georgia, serif;font-size: 20px;letter-spacing: 2px;word-spacing: 2px;color: #000000;font-weight: 700";></p>
<script>

</script>
</tr>

    <tr>  
      <td > <div id="container_offline"></div></td>
    </tr>


  </table>


</div>

</div>

  <footer class = footer>
    &copy; Copyright 2023, Rzeszów | Eryk Świątoniowski

  </footer>

<script type="text/javascript" src="offline2.js"></script>
<script type="text/javascript" src="service-register.js"></script>
</body>
</html>