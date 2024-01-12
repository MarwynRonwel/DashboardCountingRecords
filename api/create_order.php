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
    $name = $_POST['productName'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if ($name) {
        // Select the Products table inventory
        $inventoryQuery = "SELECT inventory FROM Products WHERE productName = '$name'";
        $inventory = mysqli_query($conn, $inventoryQuery);

        if ($inventory) {
            $row = mysqli_fetch_assoc($inventory);
            $currentInventory = $row['inventory'];

            // Minus the ordered quantity to the inventory 
            $updatedInventory = $currentInventory - $quantity;

            // Update the Products inventory to the minus inventory 
            $result = "UPDATE Products SET inventory = $updatedInventory WHERE productName = '$name'";
            mysqli_query($conn, $result);
        }

        $sql = "INSERT INTO Sales (productName, quantitySold, price) VALUES('$name', $quantity, $price)";
        $result = $conn->query($sql);

        if ($result === TRUE) {
            echo "Record added successfully";
            header("Location: ../Dashboard.php");
            $conn->close();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $conn->close();
} else {
    header("Location: ../Dashboard.php");
}
