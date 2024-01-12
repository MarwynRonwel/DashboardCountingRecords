<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="p-5">
    <nav>
        <h1 class="text-3xl"> Dashboard and Counting Records by <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-red-400 font-semibold">Group 8</span>
        </h1>
    </nav>
    <p>Displays</p>
    <div class="grid grid-cols-3 gap-y-4 gap-x-8 px-20 py-10">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "Dashboard";
        $conn = mysqli_connect($servername, $username, $password, $database);

        $result = $conn->query("SELECT * FROM Products");

        while ($row = $result->fetch_assoc()) {
            $stockValue = $row['price'] * $row['inventory'];
            $deleteUrl = "./api/delete_stock.php?id=" . $row['id'];
            echo "<div class='border rounded-lg px-5 py-3'>
                                <h2 scope='row' class='text-2xl font-medium text-gray-900'>
                                    {$row['productName']}
                                </h2>
                        
                                <p class='pt-3 text-gray-400 text-sm'>
                                    {$row['category']}
                                </p>

                                ";

            if ($row['inventory'] === "0") {
                echo "
                    <p class='text-gray-500 text-sm mt-5 line-through'>
                        Stock {$row['inventory']}
                    </p>
                    <div class='flex items-center border-t pt-2'>
                            <p class='text-sm text-red-500 font-medium'>Sold out</p>
                        </div>
                    </div>";
            } else {
                echo "
                    <p class='text-gray-500 text-sm mt-5'>
                        Stock {$row['inventory']}
                    </p>
                    <div class='flex justify-between items-center border-t pt-2'>
                                <p class='text-sm text-gray-600 italic font-medium'>
                                    ₱ {$row['price']}
                                </p>
                            <a href='Dashboard.php' class='text-sm underline hover:text-blue-400'>Buy</a>
                        </div>
                    </div>";
            }
        };
        ?>
        <!-- <a href="Dashboard.php">Dashboard</a>
        <a href="Dashboard.php">Dashboard</a>
        <a href="Dashboard.php">Dashboard</a> -->
    </div>
</body>

</html>