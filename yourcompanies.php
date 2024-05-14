<?php
		$color = "lightblue";
		$username = "test";
		/*$host = "303.itpwebdev.com";
		/*$user = "paripand_db_user";
		$pass = "itpwebdev303";
		$user = "paripand_new_user";
		$pass = "itp303itp303itp303";
		$db = "paripand_final_project";*/

		$host = "localhost:3306";
		$user = "root";
		$pass = "Banari69";
		$db = "ITP303";

		// DB Connection
		$mysqli = new mysqli($host, $user, $pass, $db);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		//$mysqli->set_charset('utf8');
		//echo "<pre>";

		if (count($_POST) == 0) {

		}

		else if (isset($_POST['delete_all'])) {
			$user_records = "SELECT Ticker_ID FROM widget_data WHERE Username = \"$username\" GROUP BY Ticker_ID;";
			$user_records_result = $mysqli->query($user_records);
			$delete_all = "DELETE FROM widget_data WHERE Username = \"$username\";";

			$delete_all_result = $mysqli->query($delete_all);
			if (!$delete_all_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}

			$check_others = "SELECT Ticker_ID FROM widget_data GROUP BY Ticker_ID;";
			$check_others_result = $mysqli->query($check_others);
			if (!$check_others_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}

			$delete_news = "DELETE FROM company_news";
			$delete_details = "DELETE FROM company_details";
			$delete_tickers = "DELETE FROM all_tickers";


			if ($check_others_result->num_rows != 0) {
				$all_tickers = "(";

				for ($i = 0; $i < $check_others_result->num_rows; $i++) {
					$row = $check_others_result->fetch_assoc();
					$all_tickers = $all_tickers . $row['Ticker_ID'];

					if ($check_others_result->num_rows > 1 && $i != $check_others_result->num_rows - 1) {

						$all_tickers = $all_tickers . ", ";
					}
				}

				$all_tickers = $all_tickers . ')';

				$delete_news = $delete_news . " WHERE Ticker_ID NOT IN $all_tickers;";
				$delete_details = $delete_details . " WHERE Ticker_ID NOT IN $all_tickers;";
				$delete_tickers = $delete_tickers . " WHERE Ticker_ID NOT IN $all_tickers;";
			}

			else {
				$delete_news = $delete_news . ";";
				$delete_details = $delete_details . ";";
				$delete_tickers = $delete_tickers . ";";
			}


			$delete_news_result = $mysqli->query($delete_news);
			if (!$delete_news_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}
			
			$delete_details_result = $mysqli->query($delete_details);
			//echo $delete_details_result->num_rows;
			if (!$delete_details_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}

			$delete_tickers_result = $mysqli->query($delete_tickers);
			//echo $delete_details_result->num_rows;
			if (!$delete_tickers_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}

		}

		else if (isset($_POST['widget_id']) && trim($_POST['widget_id']) != '') {
			$delete_record = "DELETE FROM widget_data WHERE Widget_ID = {$_POST['widget_id']};";
			$delete_record_results = $mysqli->query($delete_record);

			$check_others = "SELECT COUNT(*) as count FROM widget_data WHERE Ticker_ID = {$_POST['ticker_id']};";
			$check_others_result = $mysqli->query($check_others);
			if (!$check_others_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}

			$check_others_result = $check_others_result->fetch_assoc();

			if ($check_others_result['count'] == '0' ) {
				
				$delete_company_news = "DELETE FROM company_news WHERE Ticker_ID = {$_POST['ticker_id']};";
				$delete_company_news_result = $mysqli->query($delete_company_news);

				if (!$delete_company_news_result) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}

				$delete_company_details = "DELETE FROM company_details WHERE Ticker_ID = {$_POST['ticker_id']};";
				$delete_company_details_result = $mysqli->query($delete_company_details);

				if (!$delete_company_details_result) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}

				$delete_ticker = "DELETE FROM all_tickers WHERE Ticker_ID = {$_POST['ticker_id']};";
				$delete_ticker_result = $mysqli->query($delete_ticker);

				if (!$delete_ticker_result) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}
			}
		}

		else if (isset($_POST['widget_id_color']) && trim($_POST['widget_id_color']) != '') {
			$change_color = "UPDATE widget_data SET Color = \"{$_POST['widget_id_cc']}\" WHERE Widget_ID = {$_POST['widget_id_color']};";
			$change_color_result = $mysqli->query($change_color);
			if (!$change_color_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}
		}


		else {

			$ticker_id = 0;
			$ticker_id_result = 0;


			$check_titles = "SELECT COUNT(*) AS count FROM all_tickers WHERE TickerName = \"{$_POST['ticker']}\";";
			$check_titles_result = $mysqli->query($check_titles);
			if (!$check_titles_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}
			$check_titles_result = $check_titles_result->fetch_assoc();


			if ($check_titles_result['count'] == '0') {
				$insert_ticker = "INSERT INTO all_tickers (TickerName) VALUES(\"{$_POST['ticker']}\");";

				$insert_ticker_result = $mysqli->query($insert_ticker);
				if (!$insert_ticker_result) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}


				$ticker_id = "SELECT Ticker_ID FROM all_tickers WHERE TickerName = \"{$_POST['ticker']}\";";

				$ticker_id_result = $mysqli->query($ticker_id);
				if (!$ticker_id_result) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}


				$ticker_id = $ticker_id_result->fetch_assoc()['Ticker_ID'];
				$company_details = "INSERT INTO company_details (Ticker_ID, Company_Name, Primary_Exchange, Currency_Name, Market_Cap, Logo, Location, Description, Homepage, List_Date) VALUES({$ticker_id}, \"{$_POST['company_name']}\", \"{$_POST['primary_exchange']}\", \"{$_POST['currency_name']}\", {$_POST['market_cap']}, \"{$_POST['logo']}\", \"{$_POST['location']}\", \"{$_POST['company_description']}\", \"{$_POST['homepage']}\", \"{$_POST['list_date']}\");";


				$company_details_result = $mysqli->query($company_details);
				if (!$company_details_result) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}


				$company_news = "INSERT INTO company_news (Ticker_ID, Date_Published, Publisher, Title, URL, Description, Author, Article_Image) VALUES ({$ticker_id}, \"{$_POST['date_published']}\", \"{$_POST['publisher']}\", \"{$_POST['title']}\", \"{$_POST['article_url']}\", \"{$_POST['description']}\", \"{$_POST['author']}\", \"{$_POST['article_image']}\");";
				$company_news_result = $mysqli->query($company_news);

				if (!$company_news_result) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}
			}

			else {
				$ticker_id = "SELECT Ticker_ID FROM all_tickers WHERE TickerName = \"{$_POST['ticker']}\";";

				$ticker_id_result = $mysqli->query($ticker_id);
				if (!$ticker_id_result) {
					echo $mysqli->error;
					$mysqli->close();
					exit();
				}

				$ticker_id = $ticker_id_result->fetch_assoc()['Ticker_ID'];
			}



			$widget_data = "INSERT INTO widget_data (Username, Color, Ticker_ID, Date, Open_Price, Close_Price, High_Price, Low_Price, Transactions, Trading_Volume, VWAP) VALUES (\"test\", \"{$_POST['color']}\", ${ticker_id}, \"{$_POST['date']}\", {$_POST['open_price']}, {$_POST['close_price']}, {$_POST['high_price']}, {$_POST['low_price']}, {$_POST['transactions']}, {$_POST['trading_volume']}, {$_POST['vwap']});";

			$widget_data_result = $mysqli->query($widget_data);


			if (!$widget_data_result) {
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}
			
		}


		$user_records = "SELECT Widget_ID, Date, Color, widget_data.Ticker_ID, all_tickers.TickerName AS ticker, Open_Price, Close_Price, High_Price, Low_Price, Transactions, Trading_Volume, VWAP FROM widget_data LEFT JOIN all_tickers ON widget_data.Ticker_ID = all_tickers.Ticker_ID WHERE Username = \"{$username}\";";

		$user_records_results = $mysqli->query($user_records);
		if (!$user_records_results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}


		//$colors = ["lightblue", "orange"];

		/*for ($i = 0; $i < $user_records_results->num_rows; $i++) {
			$user_records_results->data_seek($i);
			var_dump($user_records_results->fetch_assoc());
			//var_dump($user_records_results->fetch_row()['Color']);
		}*/

		//var_dump($user_records_results->fetch_assoc());

		$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Your Stocks</title>
	<meta name = "description" content = "This page displays all widgets that the user has created. It is dynamically populated by PHP based on what the user added or modified to the database. Each widget supports a delete and change color button as shown. Users can both temporarily and permanently make changes, with the former helping them experiment and preview the website before any changes. When editing the color of the widget, it updates in real time to show the user what it would look like. When temporarily removing the widget, the homepage automatically resizes to include 3 widgets in each row and shows what the deletion would look like.">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<link rel = "stylesheet" href = "shared.css">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<style>

		.row {
			/*margin-bottom: 100px;*/
			margin-bottom: 10px;
			
		}

		.col {
			border-radius: 25px;
			margin-left: 10px;
			margin-right: 10px;
			margin-bottom: 10px;
			border: 2px solid rgb(0,0,0,0.2);
		}

		h2 {
			margin-top: 10px;
			margin-left: 2%;
			
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


		#submit {
			color: white;
			margin-left: 1%;
			width: 14%;
			background-color: blue;
			border-radius: 10px;
		}

		#delete-all {
			color: white;
			margin-left: 2%;
			margin-right: 2%;
			margin-top: 10px;
			margin-bottom: 10px;
			border-radius: 15px;
			/*width: 96%;*/
			float: right;
			height: 10%;
			background-color: rgb(450, 0, 0, 0.9);
			width: auto;
			height: auto;
			margin-left: 10px;
		}

		.color_picker {
			margin-top: 10px;
			height: 10%;
			width: 12.5%;
			margin-left: 2%;
			border: 1px solid black;
		}

		.delete {
			color: white;
			margin-left: 2%;
			margin-right: 2%;
			margin-top: 10px;
			margin-bottom: 10px;
			border-radius: 15px;
			float: right;
			height: 10%;
			background-color: rgb(450, 0, 0, 0.9);
		}

		.delete:hover {

			background-color: rgb(255, 0, 0);
		}

		.change_color {
			color: white;
			margin-left: 2%;

			margin-top: 10px;
			margin-bottom: 10px;
			border-radius: 15px;
			float: right;

			height: 10%;
			background-color: rgb(29, 171, 64);
		}

		.change_color:hover {
			background-color: green;
		}


		small {
			color: red;
			visibility: hidden;
		}

		td {
			text-align: center;
			background-color: lightgreen;
		}

		p {
			margin-left: 2%;
		}

		<?php

			for ($i = 0; $i < $user_records_results->num_rows; $i++) {
				$row = $user_records_results;
				$row->data_seek($i);
				$color = $row->fetch_assoc()['Color'];
				echo "#widget_id_{$i} { background-color: $color;}

				#widget_id_{$i}:hover {
					border: 2px solid black;
				}";
			}

			$user_records_results->data_seek(0);
		?>

	
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
				<a href = "add_stock.php">Add Stock</a>
			</li>

			<li>
				<a id = "active-page" href = "yourcompanies.php">Your Stocks</a>
			</li>

			<li>
				<a href = "company_details.php">Company Details</a>
			</li>

			<li>
				<a href = "company_news.php">Company News</a>
			</li>


		</ul>


		<h1>Your Stocks</h1>


		<form id = "delete_all" action = "yourcompanies.php" method = "POST">
			<input id = "delete_all_input" type = "hidden" name = "delete_all" value = "1">
		</form>

	
		<?php
			if ($user_records_results->num_rows > 0) {
				echo "<div class = \"row\">";
				echo "<button id=\"delete-all\">Remove all</button>";
				echo "</div>";
			}

			for ($i = 0; $i < $user_records_results->num_rows; $i = $i + 3) {
				echo "<div class = \"row\">";

				for ($j = 0; $j < 3 && ($i + $j) < $user_records_results->num_rows; $j++) {
					$record = $user_records_results->fetch_assoc();
					$id = $i+$j;
					$widget_id = "widget_id_{$id}";
					echo "<div class = \"col\" id = \"$widget_id\">";
					echo "<h2>{$record['ticker']}</h2>";
					echo "<form id = \"delete_form\" action = \"yourcompanies.php\" method = \"POST\">";
					echo "<input name = \"widget_id\" type = \"hidden\" value = \"{$record['Widget_ID']}\">";
					echo "<input name = \"ticker_id\" type = \"hidden\" value = \"{$record['Ticker_ID']}\">";
					echo "</form>";
					echo "<p>{$record['Date']}</p>";
					echo "<table>";

					echo "<tr>";
					echo "<td class = \"metric\">Open price</td>";
					echo "<td>\${$record['Open_Price']}</td>";
					echo "</tr>";


					echo "<tr>";
					echo "<td class = \"metric\">Close price</td>";
					echo "<td>\${$record['Close_Price']}</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td class = \"metric\">High price</td>";
					echo "<td>\${$record['High_Price']}</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td class = \"metric\">Low price</td>";
					echo "<td>\${$record['Low_Price']}</td>";
					echo "</tr>";


					echo "<tr>";
					echo "<td class = \"metric\">Number of transactions</td>";
					echo "<td>{$record['Transactions']}</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td class = \"metric\">Trading volume</td>";
					echo "<td>{$record['Trading_Volume']}</td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td class = \"metric\">Volume weighted average price</td>";
					echo "<td>\${$record['VWAP']}</td>";
					echo "</tr>";

					echo "</table>";

					//echo "<div id = \"buttons\">";
					echo "<button class = \"delete\">Remove</button>";
					echo "<button class = \"change_color\">Change Color</button>";
					echo "<input class = \"color_picker\" type = \"color\" value = \"{$record['Color']}\"></input>";
					echo "<form id = \"change_color\" action = \"yourcompanies.php\" method = \"POST\">";
					echo "<input id = \"widget_id_cc\" name = \"widget_id_cc\" type = \"hidden\" value = \"\">";
					echo "<input name = \"widget_id_color\" type = \"hidden\" value = \"{$record['Widget_ID']}\">";
					echo "</form>";
					//echo "<div>";

					echo "</div>";
				}

				echo "</div>";

			}


		?>



	</div>

	<div id = "footer">Stock Markets 101 &copy;</div>

	<script>

		function bindRemoveBtns() {

			const buttons = document.querySelectorAll(".delete");

			for (btn of buttons) {
				btn.onclick = function() {
					//widget_ID = this.parentElement.remove();
					if (confirm("Do you want to permanently delete this stock? (OK for YES, Cancel for Temporary Removal)") == true) {
						this.parentElement.querySelector("#delete_form").submit();
						//this.parentElement.remove();
					}

					else {
						if (this.parentElement.parentElement.childElementCount == 1) {

								this.parentElement.parentElement.remove();
						}

						else {
							let grandparent = this.parentElement.parentElement;

							this.parentElement.remove();

							while (grandparent != document.querySelector("footer") && grandparent.nextElementSibling != document.querySelector("footer")) {
								grandparent.appendChild(grandparent.nextElementSibling.children[0]);


								if (grandparent.nextElementSibling.childElementCount == 0) {
									grandparent.nextElementSibling.remove();
								}
							

								grandparent = grandparent.nextElementSibling;;	
							}
						}


					}

					return true;
				}
			}
		}



		function changeColor() {
			const buttons = document.querySelectorAll(".change_color");

			for (btn of buttons) {
				btn.onclick = function() {
					//widget_ID = this.parentElement.remove();

					if (confirm("Do you want to permanently change the color?") == true) {

						let current_color = this.parentElement.querySelector(".color_picker").value;
						this.parentElement.querySelector("#widget_id_cc").value = current_color;
						this.parentElement.querySelector("#change_color").submit();
					}

					return true;
				}
			}

		}

		function updateReal() {
			const color_pickers = document.querySelectorAll(".color_picker");

			for (picker of color_pickers) {

				picker.addEventListener("input", function() {
				  this.parentElement.style.backgroundColor = this.value;
				})
			}

		}

		changeColor();
		updateReal();
		bindRemoveBtns();

	</script>

	<script>


		document.querySelector("#delete-all").onclick = function () {
			if ((confirm("Do you really want to delete all your companies? OK for YES, Cancel for Temporary Removal")) == true) {
				document.querySelector("#delete_all").submit();
			}

			else {
				const all_rows = document.querySelectorAll(".row");

				for (let i = 0; i < all_rows.length; i++) {
					all_rows[i].remove();
				}
			}
		}


	</script>


</body>

</html>
