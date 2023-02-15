var offline_rates = JSON.parse(window.localStorage.getItem('keys'));
var last_date = JSON.parse(window.localStorage.getItem('date'));
				var myTable = "<table class='d'>";
				var licznik=0;
				for (var key in offline_rates) 
				{
					
					if(licznik%2==0){
						myTable += "<tr>";
						myTable += `<td style="text-align:center;background-color:white;border: solid 1px black; padding:0 5px 0 0;"><p style="font-family: Georgia, serif;font-size: 20px;letter-spacing: 2px;word-spacing: 2px;color: #000000;font-weight: 700";>${key}</p>${offline_rates[key]}</td>`;
					}
					else{
					myTable += `<td style="text-align:center;background-color:white;border: solid 1px black; padding:0 5px 0 0;"><p style="font-family: Georgia, serif;font-size: 20px;letter-spacing: 2px;word-spacing: 2px;color: #000000;font-weight: 700";>${key}</p>${offline_rates[key]}</td>`;
					myTable += "</tr>";
					}
					
					licznik++;
				}
				myTable += "</table>";
				document.getElementById("container_offline").innerHTML = myTable;
				document.getElementById("p1").innerHTML = last_date + "| EUR";