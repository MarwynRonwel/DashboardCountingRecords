<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected'])) {
    $selectedProductIds = $_POST['selected'];

    // Now you can perform the delete operation for the selected product IDs
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Dashboard";
    $conn = mysqli_connect($servername, $username, $password, $database);

    // // Validate and sanitize the IDs to prevent SQL injection
    $safeSelectedProductIds = array_map('intval', $selectedProductIds);
    $safeSelectedProductIdsString = implode(',', $safeSelectedProductIds);

    // // Perform the delete operation
    $deleteQuery = "DELETE FROM Products WHERE id IN ($safeSelectedProductIdsString)";
    $result = $conn->query($deleteQuery);

    if ($result) {
        echo "Selected products deleted successfully";
        header('Location: ../Dashboard.php');
    } else {
        echo "Error deleting selected products: " . $conn->error;
        echo "<a href='../Dashboard.php'>Back to home</a>";
    }

    $conn->close();
} else {
    echo "Invalid request";
}
