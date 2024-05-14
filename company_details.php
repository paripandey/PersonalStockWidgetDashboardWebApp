<?php

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

		$mysqli->set_charset('utf8');

		$user_records = "SELECT Ticker_ID FROM widget_data WHERE Username = \"{$username}\" GROUP BY Ticker_ID;";

		$user_records_results = $mysqli->query($user_records);
		if (!$user_records_results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$total_results = "SELECT COUNT(*) as count FROM widget_data";
		$total_results_result = $mysqli->query($total_results);

		$company_details = "SELECT all_tickers.TickerName AS ticker, Company_Name, Primary_Exchange, Currency_Name, Market_Cap, Logo, Location, Description, Homepage, List_Date FROM company_details LEFT JOIN all_tickers ON company_details.Ticker_ID = all_tickers.Ticker_ID";


			if ($total_results_result->fetch_assoc()['count'] != '0') {
				$all_tickers = "(";

				for ($i = 0; $i < $user_records_results->num_rows; $i++) {
					$row = $user_records_results->fetch_assoc();
					$all_tickers = $all_tickers . $row['Ticker_ID'];
					if ($i != $user_records_results->num_rows - 1) {

						$all_tickers = $all_tickers . ", ";
					}
				}

				$all_tickers = $all_tickers . ')';

				$company_details = $company_details . " WHERE company_details.Ticker_ID IN {$all_tickers};";
			}

			else {
				$company_details = $company_details . ";";
			}

		

		$company_details_result = $mysqli->query($company_details);

		if (!$company_details_result) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Company Details</title>
	<meta charset="utf-8">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<meta name = "description" content = "This page provides additional information on each company that the user adds. It is not duplicated for duplicate widgets; it is just stored once. It provides information like the homepage, logo, location, and description of the company, in case the user wants more context. This information is from the API and based on the stock market (NASDAQ or NYSE).">

	<link rel = "stylesheet" href = "shared.css">


	<style>

		.row {
			/*margin-bottom: 100px;*/
			margin-bottom: 20px;
			height: auto;
			
		}

		.col {
			background-color: lightblue;
			border-radius: 25px;
			border: 2px solid lightblue;
			height: auto;
			width: auto;
			margin-bottom: 20px;
		}

		h2 {
			margin-top: 15px;	
			margin-left: 2%;	
		}

		p {
			margin-left: 2%;
			margin-right: 2%;
		}

	
		.col:hover {
			border: 2px solid black;
		}


		table {
			background-color: white;
			text-align: center;
			width: 96%;
			margin-left: 2%;
			margin-right: 2%;
			margin-top: 15px;
			margin-bottom: 15px;
		}

		td {
			padding: 10px;
			border: solid black 1px;
			text-align: center;
			background-color: lightgreen;
		}

		tr {
			border: solid black 1px;
		}

		.metric {
			background-color: lightyellow;
			width: 30%;
		}

		img {
			width: 98%;
			height: auto;
			margin: 1%;
			height: 150px;
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
				<a href = "add_stock.php">Add Stock</a>
			</li>

			<li>
				<a href = "yourcompanies.php">Your Stocks</a>
			</li>

			<li>
				<a id = "active-page" href = "company_details.php">Company Details</a>
			</li>

			<li>
				<a href = "company_news.php">Company News</a>
			</li>


		</ul>


		<h1>Company Details</h1>

		<?php
			while ($record = $company_details_result->fetch_assoc()) {

				echo "<div class = \"col\">";
			
				echo "<a href = \"{$record['Homepage']}\"><h2>{$record['Company_Name']} ({$record['ticker']})</h2></a>";

				echo "<table>";

				echo "<tr>";
				echo "<td class = \"metric\"><strong>Logo:</strong></td>";
				echo "<td><img src = \"{$record['Logo']}\"></td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class = \"metric\"><strong>Location:</strong></td>";
				echo "<td>{$record['Location']}</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class = \"metric\"><strong>List date:</strong></td>";
				echo "<td>{$record['List_Date']}</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class = \"metric\"><strong>Primary exchange:</strong></td>";
				echo "<td> {$record['Primary_Exchange']}</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class = \"metric\"><strong>Currency name:</strong></td>";
				echo "<td>{$record['Currency_Name']}</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class = \"metric\"><strong>Market cap:</strong></td>";
				echo "<td>{$record['Market_Cap']}</td>";
				echo "</tr>";

				echo "<tr>";
				echo "<td class = \"metric\"><strong>Description:</strong></td>";
				echo "<td>{$record['Description']}</td>";
				echo "</tr>";


				echo "</table>";


				echo "</div>";

			}


		?>



	</div>

	<div id = "footer">Stock Markets 101 &copy;</div>

</body>

</html>
