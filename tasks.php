<?php
require 'secret.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// get request data
$request = json_decode(file_get_contents("php://input"), true);
$name = $request['name'];
$notes = $request['notes'];
$id = $request['id'];

$result = "Failed";
try {
  // handle each methods
  switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
      // insert the new task
      $sql = "INSERT INTO tasks (name, notes, created)
              VALUES ('$name', '$notes', NOW())";

      if ($conn->query($sql) === TRUE) {
        $result = "Success";
      }
      break;

    case 'PUT':
      // update the task
      $sql = "UPDATE tasks SET name = '$name', notes = '$notes' WHERE id = '$id'";

      if ($conn->query($sql) === TRUE) {
        $result = "Success";
      }
      break;

    case 'DELETE':
      // update active to 0  !!do not DELETE!!
      parse_str($_SERVER["QUERY_STRING"], $qs);
      $id = $qs['id'];

      $sql = "UPDATE tasks SET active = 0 WHERE id =  '$id'";

      if ($conn->query($sql) === TRUE) {
        $result = "Success";
      }
      break;

    case 'GET':
      // select tasks which is active in the order they were created
      $sql = "SELECT id, name, notes, DATE_FORMAT(created, '%M %D, %Y') AS created
              FROM tasks WHERE active = 1 order by created";

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
      $result = "unexpected method";
      break;
  }

} catch (Exception $e) {
  echo $e;
} finally {
  $conn->close();
  echo $result;
}

?>
