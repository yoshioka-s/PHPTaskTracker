$servername = "jukeboxprint.com";
$username = "test_dev";
$password = "testuser";
$dbname = "dev_exam";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$data = file_get_contents("php://input");
$objData = json_decode($data);
$sql = "INSERT INTO tasks (name, notes, created)
VALUES ('Doe', 'Doe', NOW())";

if ($conn->query($sql) === TRUE) {
    echo true;
} else {
    echo false;
}
$conn->close();
