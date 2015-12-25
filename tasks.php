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

// get request data
$dataString = file_get_contents("php://input");
$request = json_decode($dataString, true);
$name = $request['name'];
$notes = $request['notes'];
$id = $request['id'];

$result = "Failed";
try {
  // manage each methods
  switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
      $sql = "INSERT INTO tasks (name, notes, created)
              VALUES ('$name', '$notes', NOW())";
      if ($conn->query($sql) === TRUE) {
        $result = "Success";
      }
      break;

    case 'PUT':
      $sql = "UPDATE tasks SET name = '$name', notes = '$notes' WHERE id = '$id'";
      if ($conn->query($sql) === TRUE) {
        $result = "Success";
      }
      break;

    case 'DELETE':
      parse_str($_SERVER["QUERY_STRING"], $qs);
      $id = $qs['id'];
      $sql = "UPDATE tasks SET active = 0 WHERE id =  '$id'";
      if ($conn->query($sql) === TRUE) {
        $result = "Success";
      }
      break;

    case 'GET':
      $sql = "SELECT * FROM tasks WHERE active = 1 order by created";

      $tasks = $conn->query($sql);
      $results = array();
      if ($tasks->num_rows > 0) {
        // output data of each row
        while($row = $tasks->fetch_assoc()) {
          array_push($results,  $row);
        }
      }
      $result = json_encode($results);
      break;

    default:
      echo "unexpected method";
      break;
  }
} catch (Exception $e) {
  echo $e;
} finally {
  $conn->close();
  echo $result;
}

?>
