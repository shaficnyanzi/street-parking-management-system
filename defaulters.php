<!DOCTYPE html>
<html>
<head>
	<title>WHO REFUSED TO PAY</title>
</head>
<body>
	<h1>WHO REFUSED TO PAY</h1>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		h1 {
			text-align: center;
			color: #333;
			margin-top: 50px;
		}

		form {
			width: 50%;
			margin: 0 auto;
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
		}

		label {
			display: block;
			margin-bottom: 10px;
			color: #333;
		}

		input[type="text"],
		input[type="number"] {
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: none;
			background-color: #f2f2f2;
			box-shadow: inset 0px 0px 5px rgba(0,0,0,0.1);
			width: 100%;
		}

		input[type="submit"] {
			background-color: #333;
			color: #fff;
			padding: 10px 20px;
			border-radius: 5px;
			border: none;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #555;
		}
	</style>

	<script>
		function showAlert() {
			alert("Defaulter added successfully.");
		}
	</script>
	
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="car_type">Car Type:</label>
		<input type="text" name="car_type" id="car" placeholder="Car type" required>

		<label for="number_plate">Number Plate:</label>
		<input type="text" name="number_plate" id="number_plate" placeholder="Number plate">

		<label for="amount_defaulted">Amount Defaulted:</label>
		<input type="number" name="amount_defaulted" id="amount" placeholder="Amount defaulted" required>

        <label for="location">Location:</label>
		<input type="text" name="location" id="location" placeholder="Location" required>
        
		<input type="submit" name="submit" value="Submit" onclick="showAlert()">
	</form>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Get the form data
		$car_type = $_POST["car_type"];
		$number_plate = $_POST["number_plate"];
		$amount_defaulted = $_POST["amount_defaulted"];
        $location = $_POST["location"];

		// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "smart_users";

		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		// Insert the defaulter into the database
		$sql = "INSERT INTO defaulters (car_type, number_plate, amount_defaulted, location) VALUES ('$car_type', '$number_plate', '$amount_defaulted','$location')";
		
		if ($conn->query($sql) === TRUE) {
		    // Do nothing, alert will be shown by JavaScript
        } else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
    ?>
</body>
</html>
