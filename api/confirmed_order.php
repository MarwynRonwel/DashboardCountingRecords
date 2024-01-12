<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dashboard";

$conn = mysqli_connect($servername, $username, $password, $database);

$id = $_GET['id'];

if (!isset($id) || !is_numeric($id)) {
    die("Invalid Id");
}

$result = $conn->query("SELECT * FROM Sales WHERE id = $id");
$row = $result->fetch_assoc();
$prdId = $row['id'];
$prdName = $row['productName'];
$prdQnty = $row['quantitySold'];
$prdPrice = $row['price'];

$sql = "INSERT Into Ordered (id, productName, quantitySold, price) VALUES ($prdId, '$prdName', $prdQnty, $prdPrice)";
$insert = $conn->query($sql);

$delete = $conn->query("DELETE FROM Sales WHERE id = $id");

if ($insert === true && $delete === true) {
    echo 'Records inserted and updated successfully!';
} else {
    echo 'Record failed' . $conn->error;
}

$conn->close();
header('Location: ../Dashboard.php');
