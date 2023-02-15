var requestURL = 'https://api.exchangerate.host/latest';
var request = new XMLHttpRequest();
var message = null;
var select1 = document.getElementById("select1");
var select2 = document.getElementById("select2");
var select3 = document.getElementById("select3");
var select4 = document.getElementById("select4");
var select5 = document.getElementById("select5");
var output = document.getElementById("output_number");





request.open('GET', requestURL);
request.responseType = 'json';
request.send();

var first_currency="AED";
var second_currency="AED";
var base_currency="AED";
var symbol_currency="AED";
var date_from;
var date_to;

	select1.addEventListener('change', function handleChange(event) {
		first_currency = select1.options[select1.selectedIndex].text;
		console.log(select1.options[select1.selectedIndex].text);
	});

	select2.addEventListener('change', function handleChange(event) {
		second_currency = select2.options[select2.selectedIndex].text;
		console.log(select2.options[select2.selectedIndex].text);
	});

	select4.addEventListener('change', function handleChange(event) {
		base_currency = select4.options[select4.selectedIndex].text;
		console.log(select4.options[select4.selectedIndex].text);
	  });

	select5.addEventListener('change', function handleChange(event) {
		symbol_currency = select5.options[select5.selectedIndex].text;
		console.log(select5.options[select5.selectedIndex].text);
    });

$(document).ready(function() {
$(".select-swap").on('click', function (ev) {
    swaper();
});
});

function swaper () {
	var co=$("#select1").val();
	$("#select1").val($("#select2").val());
	$("#select2").val(co);
	first_currency = select1.options[select1.selectedIndex].text;
	second_currency = select2.options[select2.selectedIndex].text;
}

var invalidChars = [
	"-",
	"+",
	"e",
];



function licz(){
	var input = document.getElementById("input_number").value;

	first_currency = encodeURI(first_currency);
	second_currency = encodeURI(second_currency);
	console.log(first_currency);
	input = encodeURI(input)
	if(input==""){window.alert("Podaj prawidłową wartość");}
	else
	{
		var requestURL4 = `https://api.exchangerate.host/convert?from=`+first_currency+`&to=`+second_currency+`&amount=`+input;
		var request4 = new XMLHttpRequest();
		request4.open('GET', requestURL4);
		request4.responseType = 'json';
		request4.send();

		request4.onload = function() 
		{
			var response4 = request4.response;
			console.log(response4);
			document.getElementById("output_number").value=response4.result;
		}
	}
}


select3.addEventListener('change', function handleChange(event) 
{
currency_choose = select3.options[select3.selectedIndex].text;
currency_choose = encodeURI(currency_choose);
console.log(currency_choose);
var requestURL3 = `https://api.exchangerate.host/latest?base=`+currency_choose;
var request3 = new XMLHttpRequest();
request3.open('GET', requestURL3);
request3.responseType = 'json';
request3.send();

request3.onload = function() 
	{
		var response3 = request3.response;
		console.log(response3.rates);

		var myTable = "<table class='d' style='margin-top:5%;width:100%'>";
		var licznik=0;
		for (var key in response3.rates) 
		{	
			if(licznik%2==0){
				myTable += "<tr>";
				myTable += `<td style="text-align:center;background-color:white;border: solid 1px black; padding:0 5px 0 0;"><p style="font-family: Georgia, serif;font-size: 20px;letter-spacing: 2px;word-spacing: 2px;color: #000000;font-weight: 700";>${key}</p>${response3.rates[key]}</td>`;
			}
			else{
					myTable += `<td style="text-align:center;background-color:white;border: solid 1px black; padding:0 5px 0 0;"><p style="font-family: Georgia, serif;font-size: 20px;letter-spacing: 2px;word-spacing: 2px;color: #000000;font-weight: 700";>${key}</p>${response3.rates[key]}</td>`;
					myTable += "</tr>";

				}
			licznik++;
		}
		myTable += "</table>";
		document.getElementById("container").innerHTML = myTable;
	}
});




request.onload = function() 
{
	var response = request.response;
	var country_list = Object.keys(response.rates);
	console.log(country_list);

	for(var i = 0; i < country_list.length; i++) {
	  var opt = document.createElement('option');
	  opt.innerHTML = country_list[i];
	  opt.value = country_list[i];
	  select1.appendChild(opt);
	}

	for(var i = 0; i < country_list.length; i++) {
	  var opt = document.createElement('option');
	  opt.innerHTML = country_list[i];
	  opt.value = country_list[i];
	  select2.appendChild(opt);
	}
	for(var i = 0; i < country_list.length; i++) {
	  var opt = document.createElement('option');
	  opt.innerHTML = country_list[i];
	  opt.value = country_list[i];
	  select3.appendChild(opt);
	}
	for(var i = 0; i < country_list.length; i++) {
	  var opt = document.createElement('option');
	  opt.innerHTML = country_list[i];
	  opt.value = country_list[i];
	  select4.appendChild(opt);
	}

	for(var i = 0; i < country_list.length; i++) {
	  var opt = document.createElement('option');
	  opt.innerHTML = country_list[i];
	  opt.value = country_list[i];
	  select5.appendChild(opt);
	}
}

document.getElementById('date1').valueAsDate = new Date();
document.getElementById('date2').valueAsDate = new Date();
document.getElementById("date1").min = "1999-01-01";
document.getElementById("date2").min = "1999-01-01";
document.getElementById("date1").max = new Date();
document.getElementById("date2").max = new Date();

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10){
  dd='0'+dd
} 
if(mm<10){
  mm='0'+mm
} 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("date1").setAttribute("max", today);
document.getElementById("date2").setAttribute("max", today);

document.getElementById("date1").addEventListener("change", function() {
  date_from = this.value;
  console.log(date_from);
});
  document.getElementById("date2").addEventListener("change", function() {
  date_to = this.value;
  console.log(date_to);
});

var date_array = [];
var value_array = [];
var array_length;

date_from=today;
date_to=today;

function histogram()
{
  var requestURL5 = `https://api.exchangerate.host/timeseries?start_date=`+date_from+`&end_date=`+date_to+`&base=`+base_currency+`&symbols=`+symbol_currency;
  var request5 = new XMLHttpRequest();
  request5.open('GET', requestURL5);
  request5.responseType = 'json';
  request5.send();
  
  request5.onload = function() {
    var response5 = request5.response;
    console.log(response5);

	date_array = [];
	value_array = [];
	
    var myTable2 = "<table class='d'>";
    var licznik1=0;
    for (var key in response5.rates) {
      
      var obj = response5.rates[key];
		 date_array.push(key);
    	for (var key2 in obj) {

			if(licznik1%2==0){
				myTable2 += "<tr>";
				myTable2 += `<td style="text-align:center;background-color:white;border: solid 1px black; padding:0 5px 0 0;"><p style="font-family: Georgia, serif;font-size: 20px;letter-spacing: 2px;word-spacing: 2px;color: #000000;font-weight: 700";>${key}</p>${obj[key2]}</td>`;
			}
			else{
				myTable2 += `<td style="text-align:center;background-color:white;border: solid 1px black; padding:0 5px 0 0;"><p style="font-family: Georgia, serif;font-size: 20px;letter-spacing: 2px;word-spacing: 2px;color: #000000;font-weight: 700";>${key}</p>${obj[key2]}</td>`;			
				myTable2 += "</tr>";
			}
			
			licznik1++;
			value_array.push(obj[key2]);
      }
    }
    myTable2 += "</table>";
    document.getElementById("container2").innerHTML = myTable2;
  
	//var modal = document.getElementById("myModal");
	//var btn = document.getElementById("myBtn");
	//var span = document.getElementsByClassName("close")[0];
	//btn.onclick = function() {modal.style.display = "block";}
	//span.onclick = function() {modal.style.display = "none";}
	//window.onclick = function(event) {if (event.target == modal) {modal.style.display = "none";}}

	var data1 =[];
	for (var i = 0; i < date_array.length; i++) {
	data1.push({
		x: date_array[i],
		y: value_array[i]
	});}
  
  array_length=date_array.length;
  return date_array,value_array,array_length;
  }
  
}


  google.charts.load('current', {
	callback: function () {
	  drawVisualization();
	  $(window).resize(drawVisualization);
	},
	packages:['corechart']
  });





function drawVisualization() 
{
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'data');
	data.addColumn('number', 'kurs');
	var size = Object.keys(data).length;
	for(i = 0; i < array_length; i++)
	  data.addRow([date_array[i], value_array[i]]);
	  var options = {
		  
		  hAxis: {direction:-1, slantedText:true, slantedTextAngle:45,  titleTextStyle: {color: '#333'}},
		  title: 'Kurs waluty',
		  width: $(window).width()*0.85,
		  height: $(window).height()*0.7,
		  
		  
		  
		};
		var container = document.getElementById('chart_div');
		var chart = new google.visualization.LineChart(container);
	  
		chart.draw(data, options);

}


if ("serviceWorker" in navigator) {
	window.addEventListener("load", function() {
	  navigator.serviceWorker
		.register("service-worker.js")
		.then(res => console.log("service worker registered"))
		.catch(err => console.log("service worker not registered", err));
	});
  }

  google.charts.load('current', {
	packages:['corechart']
  }).then(function () {
	$("#myModal").on('shown.bs.modal', function () {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'data');
		data.addColumn('number', 'kurs');
		var size = Object.keys(data).length;
		for(i = 0; i < array_length; i++)
		  data.addRow([date_array[i], value_array[i]]);
		  var options = {
			  
			  hAxis: {direction:-1, slantedText:true, slantedTextAngle:45,  titleTextStyle: {color: '#333'}},
			  title: 'Kurs waluty',
			  width: $(window).width()*0.85,
			  height: $(window).height()*0.75,
			  
			  
			  
			};
			var container = document.getElementById('chart_div');
			var chart = new google.visualization.LineChart(container);
		  
			chart.draw(data, options);
  
	
	});
  });