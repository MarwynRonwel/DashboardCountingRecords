<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dashboard";
$conn = mysqli_connect($servername, $username, $password, $database);

$id = $_GET['id'];

if (!isset($id) || !is_numeric($id)) {
    die("Invalid ID");
}

$sql = "DELETE FROM Products WHERE id = $id";

if ($conn->query($sql) === true) {
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
header('Location: ../Dashboard.php');
