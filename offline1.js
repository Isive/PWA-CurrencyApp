window.addEventListener('load', function(e) {
	if (navigator.onLine) {
		var offline = `https://api.exchangerate.host/latest`;
		var request_offline = new XMLHttpRequest();
			
		request_offline.open('GET', offline);
		request_offline.responseType = 'json';
		request_offline.send();
		request_offline.onload = function() 
			{
							
				var response_offline = request_offline.response;
				window.localStorage.setItem('date', JSON.stringify(response_offline.date));
				window.localStorage.setItem('keys', JSON.stringify(response_offline.rates));
				console.log(response_offline);
			}
	} else {
		 console.log('We\'re offline...');
	}
	 }, false);
		  
		 