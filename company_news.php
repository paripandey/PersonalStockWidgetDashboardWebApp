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
	//echo $user_records;


	$user_records_results = $mysqli->query($user_records);
	if (!$user_records_results) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$total_results = "SELECT COUNT(*) as count FROM widget_data";
	$total_results_result = $mysqli->query($total_results);
	$company_news = "SELECT all_tickers.TickerName AS ticker, Date_Published, Publisher, Title, URL, Description, Author, Article_Image FROM company_news LEFT JOIN all_tickers ON company_news.Ticker_ID = all_tickers.Ticker_ID";

	if ($total_results_result->fetch_assoc()['count'] != 0) {
		$all_tickers = "(";

		for ($i = 0; $i < $user_records_results->num_rows; $i++) {
			$row = $user_records_results->fetch_assoc();
			$all_tickers = $all_tickers . $row['Ticker_ID'];
			if ($i != $user_records_results->num_rows - 1) {

				$all_tickers = $all_tickers . ", ";
			}
		}

		$all_tickers = $all_tickers . ')';
		$company_news = $company_news . " WHERE company_news.Ticker_ID IN {$all_tickers};";
	}

	else {
		$company_news = $company_news . ";";
	}

	$company_news_result = $mysqli->query($company_news);

	if (!$company_news_result) {
		echo $mysqli->error;
		$mysqli->close();
		exit();
	}

	$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Company News</title>
	<meta charset="utf-8">
	<meta name = "description" content = "This page provides a random recently published news article on each company that the user adds, usually published the day they add the widget, if not the day before. It is not duplicated for duplicate widgets; it is just stored once. It's like a mini news feed and provides information like the article title, article image, publisher, author, and description. Users can read more and click the article in the header for more information on the article. Some articles could talk about multiple stocks, but the stock in question is included in the title.">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<link rel = "stylesheet" href = "shared.css">


	<style>

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
			margin-right: 2%;	
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

		
		#format {
			display: flex;
			margin: 2%;
		}

		img {
			justify-content: center;
			width: 100%;
			border: 2px solid black;
		}

		#part1 {
			width: 38%;
		}

		#part2 {
			width: 60%;
			padding-left: 2%;

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
				<a href = "company_details.php">Company Details</a>
			</li>

			<li>
				<a id = "active-page" href = "company_news.php">Company News</a>
			</li>


		</ul>


		<h1>Company News</h1>


		<?php
			while ($record = $company_news_result->fetch_assoc()) {

				echo "<div class = \"col\">";
				
				echo "<a href = \"{$record['URL']}\"><h2>{$record['Title']} ({$record['ticker']})</h2></a>";
				

				echo "<div id = \"format\">";

				echo "<div id = \"part1\">";
				echo "<img src = \"{$record['Article_Image']}\">";
				echo "</div>";

				echo "<div id = \"part2\">";


				echo "<p><strong>Published by {$record['Publisher']}</strong></p>";
				echo "<p><strong>Date published: {$record['Date_Published']}</strong></p>";
				echo "<p><strong>Author: {$record['Author']}</strong></p>";

				echo "<p><strong>Description: {$record['Description']}</strong></p>";

				echo "</div>";
				echo "</div>";

				echo "</div>";

			}


		?>

	</div>

	<div id = "footer">Stock Markets 101 &copy;</div>

	</body>

</html>


