<?php
$servername = "localhost";
$username = "shu";
$password = "shusql";
$dbname = "dev_exam";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

parse_str($_SERVER["QUERY_STRING"], $qs);
$id = $qs['id'];
$sql = "DELETE FROM tasks WHERE id =  '$id'";

if ($conn->query($sql) === TRUE) {
  echo "success";
  // echo $dataString;
  // echo $id;
} else {

  // echo json_encode($objData['config']);
  echo "error";
  // echo file_get_contents("php://input");
}
$conn->close();
?>
