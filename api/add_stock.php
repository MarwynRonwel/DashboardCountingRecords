<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dashboard";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO Products (productName, category, price, inventory) VALUES('$name', '$category', $price, $quantity)";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Record added successfully";
        header("Location: ../Dashboard.php");
        $conn->close();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: ../Dashboard.php");
}
