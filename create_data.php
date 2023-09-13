<!DOCTYPE html>

<!-- Author: Anthony, Malachi, Sami
Date: 9/11/2023
File: Homework3
Purpose: Homework #3
-->

<html>
<head>
	<title> PHP HW3</title>
	<link rel="stylesheet" type="text/css" href="sample.css">
</head>
	<body style="background-color: gray;">
		<center><h1>Data processed.</h1></center>
		<center><table>
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Address</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
		<?php
			//opens the csv first name file for reading only.
            $csvFile = fopen("first_names.csv", "r");

			//checks to see if csvFile doesn't returns false so it can do the while loop
            if ($csvFile !== false) {
			//While loop that reads the CSV file line by line using the fgetcsv function
			//exists and does so until there are no longer anymore lines to read.
                while (($nameData = fgetcsv($csvFile)) !== false) {
					//this just gets the first 10 lines from the csv file
                    $firstNames = array_slice($nameData, 0, 10);
                }
				//closes the csv file
                fclose($csvFile);
            }
				//variables of the given files
				$lastNames = file("last_names.txt");
				$streetNames = file("street_names.txt");
				$streetTypes = file("street_types.txt");
				$domains = file("domains.txt");

				//for loop that makes the table for the first 10 times in the first name file and last name file
				for ($i = 0; $i < 10; $i++) {
					echo "<tr>";
					echo "<td>{$firstNames[$i]}</td>";
					echo "<td>{$lastNames[$i]}</td>";
					echo "</tr>";
				}
		?>
		</tbody>
		</table></center>
	<br>
	<center><a href="html.html"> Return back to original page</a></center>
	</body>
</html>
