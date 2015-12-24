<?php
$servername = "jukeboxprint.com";
$username = "test_dev";
$password = "testuser";
$dbname = "dev_exam";

class Task {
	function __construct($name, $notes){
		$this->name = $name;
        $this->notes = $notes;
        $this->date = "Y/m/d";
	}
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM tasks order by created";

$tasks = $conn->query($sql);
$results = array();
if ($tasks->num_rows > 0) {
    // output data of each row
    while($row = $tasks->fetch_assoc()) {
    	array_push($results,  new Task($row["name"], $row["notes"], $row["created"]));
    }
}
echo json_encode($results);
$conn->close();


?>