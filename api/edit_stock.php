<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "Dashboard";

$conn = mysqli_connect($servername, $username, $password, $databaseName);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $inventory = $_POST['inventory'];

    $sql = "UPDATE Products SET productName = '$name', category = '$category', price = $price, inventory = $inventory WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    header("Location: ../Dashboard.php");
} else {
    header("Location: ../Dashboard.php");
}
