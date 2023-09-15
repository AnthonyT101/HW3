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
	
	<pre>
	<?php
	//opens the first name csv file for reading only.
    	$csvFile = fopen("first_names.csv", "r");
	//checks to see if csvFile doesn't returns false so it can do the while loop
	if ($csvFile !== false) {
	//While loop that reads the CSV file line by line using the fgetcsv function
	//exists and does so until there are no longer anymore lines to read.
        while (($nameData = fgetcsv($csvFile)) !== false) {
	//this just gets the first 10 lines from the csv file
        $firstNames = array_slice($nameData, 0, 25);
        }
	//closes the csv file
        fclose($csvFile);
	}
	
	//creates street name array
	$streetNames = array();
	//opens the street name file
	$streetNamesFile = fopen("street_names.txt", "r");
	if ($streetNamesFile !== false) {
	//While loop that reads the file line by line using the fgets function
	//and does so until there are no longer anymore lines to read.
        while (($line = fgets($streetNamesFile)) !== false) {
	//explode function to find the : and splits it from the string
        $names = explode(":", $line);
	$names = array_map('trim', $names);
	//merges the elements of the array so that the values are appended to the end of the previous one. 
	$streetNames = array_merge($streetNames, $names);
        }
	//closes the file
	fclose($streetNamesFile);
    	}
	
	//creates street type array
	$streetTypes = array();
	//opens the street type file
	$streetTypesFile = fopen("street_types.txt", "r");
	if ($streetTypesFile !== false) {
	//While loop that reads the file line by line using the fgets function
	//and does so until there are no longer anymore lines to read.
        while (($line = fgets($streetTypesFile)) !== false) {
	//explode function to find the : and splits it from the string
        $types = explode("..;", $line);
	//trim white space
	$types = array_map('trim', $types);
	//merges the elements of the array so that the values are appended to the end of the previous one. 
	$streetTypes = array_merge($streetTypes, $types);
        }
	//closes the file
        fclose($streetTypesFile);
    	}
	
	//domain array
	$domain = array();
	//read domain.txt file
	$domainFile = file_get_contents("domains.txt");
	//split domain string into an array using . delimiter
	$domainType = explode(".", $domainFile);
	//iterate through the array and group the adjacent elements
	for ($i = 0; $i < count($domainType); $i += 2) {
	$domain[] = trim($domainType[$i] . "." . $domainType[$i + 1]);
	}
	
	//last name file
	$lastNames = file("last_names.txt");
	//trims whitespace out of lastNames
	$lastNames = array_map('trim', $lastNames);
	
	//counter variable for street type variable
	$counter = 0;
	//random number array for generating random number
	$randNumArr = array();
	
	//Printing Array Variables
	echo "<center><h1>Street Names</h1></center>";
	print_r($streetNames);
	echo "<center><h1>Street Types</h1></center>";
	print_r($streetTypes);
	echo "<center><h1>First Names</h1></center>";
	print_r($firstNames);
	echo "<center><h1>Last Names</h1></center>";
	print_r($lastNames);
	echo "<center><h1>Domains</h1></center>";
	print_r($domain);
	
	//opens a new file to write called customers.txt
	$file = fopen("customers.txt", "w");

	if($file) {
	//for loop that makes the table for the first 25 customer values
	for ($i = 0; $i < 25; $i++) {
	//variable for the street type and domains array and counter
        $streetType = $streetTypes[$counter];
	$domains = $domain[$counter];
	//increments street counter varaible
	$counter++;
	//checks to see if street counter is greater than or equal to street type count
	//and then if so resets it to zero so that street type can have 25 values
        if ($counter >= count($streetTypes) || $counter >= count($domain)){
	$counter = 0;
	}
	//do while that generates a random number and stores it into an array for us to use for street address
	do {
	$randNum = rand(1000, 9999);
        } while (in_array($randNum, $randNumArr));

        //stores the generated random number in the array
        $randNumArr[] = $randNum;
		
	//format the customerData variable
	$customerData = "{$firstNames[$i]}:{$lastNames[$i]}:{$randNum} {$streetNames[$i]} {$streetType}:{$firstNames[$i]}.{$lastNames[$i]}@$domains";
		
	//echos the table values
	echo "<tr>";
	echo "<td>{$firstNames[$i]}</td>";
	echo "<td>{$lastNames[$i]}</td>";
	echo "<td>$randNum {$streetNames[$i]} $streetType</td>";
	echo "<td>{$firstNames[$i]}.{$lastNames[$i]}@$domains</td>";
	echo "</tr>";
		
	//write data with a newline character
	fwrite($file, $customerData . PHP_EOL);
	}
	//close file
	fclose($file);
	}
	?>
	</pre>
	</tbody>
	</table></center>
	<br>
	<center><a href="html.html"> Return back to original page</a></center>
</body>
</html>
