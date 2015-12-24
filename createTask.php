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

$dataString = file_get_contents("php://input");

$objData = json_decode($dataString, true);
$name = $objData['name'];
$notes = $objData["notes"];
$sql = "INSERT INTO tasks (name, notes, created)
VALUES ('$name', '$notes', NOW())";
$result = "false";
try {
  if ($conn->query($sql) === TRUE) {
    $result = "true";
  } else {
    echo false;
  }

} catch (Exception $e) {
  echo $e;
} finally {
  $conn->close();
  // echo $dataString;
  echo json_encode($objData);
  // echo json_encode($request);
}
?>
