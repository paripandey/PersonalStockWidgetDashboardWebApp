
<!DOCTYPE html>
<html>
<head>
	<title>Add Stock</title>
	<meta charset="utf-8">
	<meta name = "description" content = "This page is a key page that helps users add a stock to their homepage. They must search for the company's ticker symbol (can be found on Google) and input a valid date, whose description is on the project summary but basically should be a weekday, in the last 2 years, not the current date, and not a holiday (e.g., Christmas). The user doesn't have to enter a date and a color, but they have the choice to, and defaults of the previous weekday and lightblue are used, respectively.">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<link rel = "stylesheet" href = "shared.css">


	<style>

		.row {
			/*margin-bottom: 100px;*/
			margin-bottom: 20px;
			
		}

		.col {
			background-color: lightblue;
			border-radius: 25px;
			margin-left: 10px;
			margin-right: 10px;
			border: 2px solid lightblue;

		}

		h2 {
			margin-top: 10px;
			margin-left: 2%;
			
		}

	
		.col:hover {
			border: 2px solid black;
		}

		.col:hover button{
		}

		table {
			background-color: white;
			text-align: center;
			width: 96%;
			margin-left: 2%;
			margin-right: 2%;
		}

		td {
			border: solid black 1px;
			background-color: lightgreen;
		}

		tr {
			border: solid black 1px;
		}



		.metric {
			background-color: lightyellow;
			width: 60%;
		}

		.form-group {
			width: 100%;
			display: flex;
			margin-bottom: 13px;
		}

		#input {
			width: 90%;

		}

		#date {
			margin-left: 1%;

		}

		#color {
			margin-left: 1%;
			width: 5%;
		}

		#submit {
			color: white;
			margin-left: 1%;
			width: 9%;
			background-color: blue;
			border-radius: 10px;
		}


		button {
			color: white;
			margin-left: 2%;
			margin-right: 2%;
			margin-top: 10px;
			margin-bottom: 10px;
			border-radius: 15px;
			width: 96%;
			height: 10%;
			background-color: rgb(450, 0, 0, 0.9);
		}

		button:hover {

			background-color: rgb(255, 0, 0);
		}

		small {
			color: red;
			visibility: hidden;
		}

		td input {
			text-align: center;
			border: none;
			background-color: lightgreen;
		}

		#invisible {


		}


	
	</style>

</head>

<body>

	<div id = "main">
		<ul id = "menu">
			<li>
				<a href = "assignment_m2.html">Home</a>
				<!--<ul>
					<li><a href = "#mouthpiece">Parts of the Saxophone</a></li>
					<li><a href = "#history-title">History</a></li>
					<li><a href = "#major-types">The 4 Major Types</a></li>
					<li><a href = "#personal-experience">Personal Experience</a></li>
					<li><a href = "#contact-info">Contact Information</a></li>
				</ul>-->
			</li>
			
			<li>
				<a href = "glossary.html">Glossary</a>
			</li>

			<li>
				<a id = "active-page" href = "add_stock.php">Add Stock</a>
			</li>

			<li>
				<a href = "yourcompanies.php">Your Stocks</a>
			</li>

			<li>
				<a href = "company_details.php">Company Details</a>
			</li>

			<li>
				<a href = "company_news.php">Company News</a>
			</li>


		</ul>


		<h1>Add Stock</h1>

		<form id = "invisible" action = "yourcompanies.php" method = "POST">
			<!--<p>Enter a username.</p>
			<input name = "username" type = "text">-->
			<input name = "date" type = "hidden" value="">
			<input name = "color" type = "hidden" value="">
			<input name = "ticker" type = "hidden" value="">
			<input name = "open_price" type = "hidden" value="">
			<input name = "close_price" type = "hidden" value="">
			<input name = "high_price" type = "hidden" value="">
			<input name = "low_price" type = "hidden" value="">
			<input name = "transactions" type = "hidden" value="">
			<input name = "trading_volume" type = "hidden" value="">
			<input name = "vwap" type = "hidden" value = "">


			<input name = "company_name" type = "hidden" value = "">
			<input name = "primary_exchange" type = "hidden" value = "">
			<input name = "currency_name" type = "hidden" value = "">
			<input name = "market_cap" type = "hidden" value = "">
			<input name = "logo" type = "hidden" value = "">
			<input name = "location" type = "hidden"  value = "">
			<input name = "company_description" type = "hidden" value = "">
			<input name = "homepage" type = "hidden" value = "">
			<input name = "list_date" type = "hidden" value = "">

			<input name = "date_published" type = "hidden" value = "">
			<input name = "publisher" type = "hidden" value = "">
			<input name = "title" type = "hidden" value = "">
			<input name = "article_url" type = "hidden" value = "">
			<input name = "description" type = "hidden" value = "">
			<input name = "author" type = "hidden" value = "">
			<input name = "article_image"type = "hidden" value = "">
		</form>

		<br>


		<p>Add a stock from the New York Stock Exchange (NYSE) or NASDAQ to get started. Choose a date that you're interested in, but make sure it's within the past 2 years, a weekday, not today's date, and not a holiday (when the stock market is closed). Otherwise, the API will throw an error as this information is either unavailable or not for free.</p>

		<p>You can also choose (and later update) the color of your widget (the default is CSS lightblue); have fun!</p>

		<!--<form>-->
			<div class = "form-group">
				<input id = "input" type = "text" placeholder="Enter ticker symbol (e.g., AAPL, GOOGL, TSLA, etc.">
				<input id = "date" type = "date">
				<input id = "color" type = "color" placeholder="#ADD8E6" value = "#ADD8E6">
				<input id = "submit" value = "Add" type = "button">
			</div>

			<div class = "form-group">
				
				<small>Please enter a ticker symbol.</small>

			</div>
		<!--</form>-->

	</div>

	<div id = "footer">Stock Markets 101 &copy;</div>


	<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
	
	<script>


			document.querySelector("#submit").onclick = function() {

				var metric_data = [];

				let fields = document.querySelectorAll("#invisible input");


				for (i = 0; i < fields.length; i++) {
					fields[i].setAttribute('value', '');
					//console.log(fields[i].name);
				}

				let previous_day = 0;

				const time_today = new Date();
				let currentDate = time_today.getDate();
				if (currentDate < 10) {
					currentDate = '0' + currentDate.toString();
				}

				let currentMonth = time_today.getMonth() + 1;
				if (currentMonth < 10) {
					currentMonth = '0' + currentMonth.toString();
				}

				const currentYear = time_today.getFullYear();



				const today = `${currentYear}-${currentMonth}-${currentDate}`;
				//console.log(today);

				if (document.querySelector("#date").value != '' && document.querySelector("#date").value != today) {
					previous_day = document.querySelector("#date").value;
				}

				else {

					let currentDate = new Date();
		 
					// Subtract one day from current time                        
					currentDate.setDate(currentDate.getDate() - 1);
					 
					let day = currentDate.getDay();

					if (day == 6) {
						currentDate = new Date();
						currentDate.setDate(currentDate.getDate() - 3);
					}

					else if (day == 5) {
						currentDate = new Date();
						currentDate.setDate(currentDate.getDate() - 2);
					}

					let date = currentDate.getDate();

					if (date < 10) {
						date = '0' + date;
					}

					let month = currentDate.getMonth() + 1;
					let year = currentDate.getFullYear();

					previous_day = `${year}-${month}-${date}`;
					console.log(previous_day);
				}

				const ticker_symbol = document.querySelector("#input").value.trim().toUpperCase();
				if (ticker_symbol.length == 0) {
					document.querySelector("small").style.visibility = "visible";
					return false;
				}

				else {
					document.querySelector("small").style.visibility = "hidden";

				}

				const api_key = "apiKey=GzbTEJ8XsunsG4V2tVgOneR20NwOWRNW";


				const endpoint1 = "https://api.polygon.io/v2/aggs/ticker/"+ticker_symbol+"/range/1/day/" + previous_day + "/" + previous_day + "?adjusted=true&sort=asc&limit=120&" + api_key;


				$.ajax({
					url: endpoint1,
					dataType: "json",
					success: function(outcome) {
						if (outcome.queryCount == 0) {
							document.querySelector("small").innerHTML = "Unable to find that ticker.";
							document.querySelector("small").style.visibility = "visible";
							return false;
						}

						else {
							//let fields = document.querySelector("#invisible").children;
							metric_data.push(previous_day);
							metric_data.push(document.querySelector("#color").value);
							metric_data.push(outcome.ticker);
							metric_data.push(outcome.results[0]['o']);
							metric_data.push(outcome.results[0]['c']);
							metric_data.push(outcome.results[0]['h']);
							metric_data.push(outcome.results[0]['l']);
							metric_data.push(outcome.results[0]['n']);
							metric_data.push(outcome.results[0]['v']);
							metric_data.push(outcome.results[0]['vw']);

							for (let i = 0; i < metric_data.length; i++) {
								fields[i].setAttribute('value', metric_data[i]);
							}


							const endpoint2 = "https://api.polygon.io/v3/reference/tickers/"+ticker_symbol+"?"+api_key;

							$.ajax({
								url: endpoint2,
								dataType: "json",
								success: function(outcome) {
									const oldArrayLength = metric_data.length;
									metric_data.push(outcome.results['name']);
									metric_data.push(outcome.results['primary_exchange']);
									metric_data.push(outcome.results['currency_name'].toUpperCase());
									metric_data.push(outcome.results['market_cap']);
									metric_data.push(outcome.results['branding']['logo_url']+"?"+api_key);
									const address = outcome.results['address']['city'] + ", " + outcome.results['address']['state'] + " " + outcome.results['address']['postal_code'];
									metric_data.push(address);
									metric_data.push(outcome.results['description']);
									metric_data.push(outcome.results['homepage_url']);
									metric_data.push(outcome.results['list_date']);

							
									for (let i = oldArrayLength; i < metric_data.length; i++) {
										fields[i].setAttribute('value', metric_data[i]);

									}

									const endpoint3 = "https://api.polygon.io/v2/reference/news?ticker="+ticker_symbol+"&"+api_key;

									$.ajax({
										url: endpoint3,
										dataType: "json",
										success: function(outcome) {
											if (outcome.results.length == 0) {
												document.querySelector("small").innerHTML = "Unable to find that ticker.";
												document.querySelector("small").style.visibility = "visible";
												return false;
											}

											else {
												const random_num = Math.floor(Math.random() * outcome.results.length);
												const oldArrayLength = metric_data.length;
												
												metric_data.push(outcome.results[random_num]['published_utc'].substring(0, 10));
												metric_data.push(outcome.results[random_num]['publisher']['name']);
												metric_data.push(outcome.results[random_num]['title']);
												metric_data.push(outcome.results[random_num]['article_url']);
												metric_data.push(outcome.results[random_num]['description']);
												metric_data.push(outcome.results[random_num]['author']);
												metric_data.push(outcome.results[random_num]['image_url']);
									
												for (let i = oldArrayLength; i < metric_data.length; i++) {
													fields[i].setAttribute('value', metric_data[i]);

													//console.log(fields[i].value);
												}

												//document.querySelector("form").submit();
											}

											console.log(document.querySelector("#invisible"));
											//document.querySelector("form").submit();
											//console.log(document.querySelector("#invisible"));
											document.querySelector("#invisible").submit();

										},

										error: function(error) {
											alert("Too many requests!")
											console.log(error)
										}
									})
								},

								error: function(error) {
									alert("Unable to find that ticker.")
									console.log(error);
								}
							})

						}

					},

					error: function(error) {
						alert("Invalid date or ticker.")
						console.log(error);
					}
				})


				return true;
			}
		

	</script>

	<script>

	</script>

	</body>

</html>
