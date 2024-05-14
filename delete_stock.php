<?php

	var_dump($_POST);

	/*if (isset($_POST['widget_id'])) {
		echo $_POST['widget_id'];



	}*/


?>


<!DOCTYPE html>
<html>
<head>
	<title>Your Companies</title>

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

		#submit {
			color: white;
			margin-left: 1%;
			width: 14%;
			background-color: blue;
			border-radius: 10px;
		}

		#delete-all {
			color: white;
			margin-left: 1%;
			width: 14%;
			border-radius: 10px;
			background-color: red;

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
			display: none;

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


		</ul>


		<h1>Delete Stock</h1>



	</div>

	<div id = "footer">Stock Markets 101 &copy;</div>



	</body>

</html>
