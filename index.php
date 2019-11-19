<?php
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "myDB";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
// 	die("Connection failed: " . $conn->connect_error);
// } 

// $sql = "SELECT id, firstname, lastname FROM MyGuests";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
// 	while($row = $result->fetch_assoc()) {
// 		echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
// 	}
// } else {
// 	echo "0 results";
// }
// $conn->close();


// data can come from database as well
// if you change "Company F requires a scooter or a bike, or a motorcycle and a driver's license and motorcycle insurance."
// to "Company F requires a scooter or a bike, or a motorcycle and a driver's license." it will be true for it as well
$data = "Company A requires an apartment or house, and property insurance.
Company B requires 5 door car or 4 door car, and a driver's license and car insurance.
Company C requires a social security number and a work permit. 
Company D requires an apartment or a flat or a house.
Company E requires a driver's license and a 2 door car or a 3 door car or a 4 door car or a 5 door car.
Company F requires a scooter or a bike, or a motorcycle and a driver's license and motorcycle insurance.
Company G requires a massage qualification certificate and a liability insurance.
Company H requires a storage place or a garage.
Company J doesn't require anything, you can come and start working immediately.
Company K requires a PayPal account.";

$lines = explode("\n", $data);

$suitable = array();

foreach ($lines as $key => $line) {
	// echo $line . "\n";
	if (strpos($line, "doesn't require anything") !== false) {
		$suitable[$key] = $line;
		continue;
	}
	$line2 = substr($line, (strpos($line,"requires")+8));

	$ands = explode("and", $line2);
	if (strpos($line2, "and") !== false) {
		$i = 1;
		$j = 1;
		foreach ($ands as $key2 => $and) {
			// echo "@@@ands" . $and. "\n";
			if ((strpos($and, "bike") !== false) || (strpos($and, "driving license") !== false) || (strpos($and, "driver's license") !== false)) {
				$i++;
			}
			$j++;
		}
		if ($j == $i) {
			$suitable[$key] = $line;
		}
	} else {
		if ((strpos($line2, "bike") !== false) || (strpos($line2, "driving license") !== false) || (strpos($line2, "driver's license") !== false)) {
			$suitable[$key] = $line;
		}
	}
}

echo "<h3>Suitable companies for you:</h3><ul>";
foreach ($suitable as $key => $value) {
	echo "<li>".$value."</li>";
}
echo "</ul>";

?>
