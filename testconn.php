<?php
	$servername = "localhost";
	$username = "racer";
	$password = "racer";
	
	try 
	{
		$conn = new PDO("mysql:host=$servername;dbname=races", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully<p>";
		$races_table = $conn->prepare("DESCRIBE races");
		$races_table->execute();
		$race_fields = $races_table->fetchAll(PDO::FETCH_COLUMN);
		$num_race_columns = sizeof($race_fields);
		for ($i = 0; $i < $num_race_columns; $i++) 
		{
				echo ($race_fields[$i]) . "<br>";
		}

		echo "<p>";

		$runner_table = $conn->prepare("DESCRIBE runner");
		$runner_table->execute();
		$runner_fields = $runner_table->fetchAll(PDO::FETCH_COLUMN);
		$num_run_columns = sizeof($runner_fields);
		for ($i = 0; $i < $num_run_columns; $i++) 
		{
				echo ($runner_fields[$i]) . "<br>";
		}

		echo "<p>";

		$stmt_runner = $conn->prepare("select first_name, last_name, runner_email, birthdate from runner");
		$stmt_runner->execute();
		$runners = $stmt_runner->fetchAll();

		echo "<table style='border: 1px solid black'><tr><th>Name</th><th>Email</th><th>Age</th></tr>";
		foreach($runners as $runner)
		{
			$today = strtotime(date('Y-m-d'));
			$birthdate = strtotime($runner['birthdate']);
			$runner_age = ($today - $birthdate)/(60*60*24*365);
			echo "<tr><td>" . $runner['first_name'] . " " . $runner['last_name'] . "</td><td>" . $runner['runner_email'] . "</td><td>" . floor($runner_age) . " years</td></tr>";
		}
		echo "</table>";

		echo "<p>";

		$stmt_runner = $conn->prepare("select first_name, last_name, runner_email, birthdate from runner");
		$stmt_runner->execute();
		$runners = $stmt_runner->fetchAll();

		echo "<table style='border: 1px solid black'><tr><th>Name</th><th>Email</th><th>Age</th></tr>";
		foreach($runners as $runner)
		{
			$today = strtotime(date('Y-m-d'));
			$birthdate = strtotime($runner['birthdate']);
			$runner_age = ($today - $birthdate)/(60*60*24*365);
			echo "<tr><td>" . $runner['first_name'] . " " . $runner['last_name'] . "</td><td>" . $runner['runner_email'] . "</td><td>" . floor($runner_age) . " years</td></tr>";
		}
		echo "</table>";

	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
?>