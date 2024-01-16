<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dashboard";
$conn = mysqli_connect($servername, $username, $password, $database);

$id = $_GET['id'];
$prdName = $_GET['productName'];

if (!isset($id) || !is_numeric($id)) {
    die("Invalid ID");
}

$qty = "SELECT quantitySold FROM Sales WHERE id = $id";
$qtySold = mysqli_query($conn, $qty);

$inventory = "SELECT inventory FROM Products WHERE productName = '$prdName'";
$inventoryCount = mysqli_query($conn, $inventory);

if ($inventoryCount && $qtySold) {
    $row = mysqli_fetch_assoc($inventoryCount);
    $currentInventory = $row['inventory'];

    $row = mysqli_fetch_assoc($qtySold);
    $quantitySold = $row['quantitySold'];

    $result = $currentInventory + $quantitySold;
    $totalInventory = "UPDATE Products SET inventory = $result WHERE productName = '$prdName'";
    mysqli_query($conn, $totalInventory);
}

$sql = "DELETE FROM Sales WHERE id = $id";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Record added successfully";
    header("Location: ../Dashboard.php");
    $conn->close();
} else {
    echo "Error updating record: " . $conn->error;
}
header('Location: ../Dashboard.php');
$conn->close();
