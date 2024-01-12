<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Count Records</title>
</head>

<body>
    <section class="flex gap-6 items-center pb-10">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "Dashboard";
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Get the SUM of the inventory
        $productInventory = $conn->query("SELECT SUM(inventory) AS stock FROM Products");
        $products = $productInventory->fetch_assoc();

        // Get the SUM of the price * inventory
        $totalValue = $conn->query("SELECT SUM(price * quantitySold) AS totalValue FROM Sales");
        $total = $totalValue->fetch_assoc();

        $totalIncome = $conn->query("SELECT SUM(price * quantitySold) AS totalValue FROM Ordered");
        $income = $totalIncome->fetch_assoc();

        echo "<div class='h-[125px] w-[250px] p-2.5'>
                <p class='text-orange-500 text-sm font-semibold pb-3'>Inventory Summary</p>
                <p class='font-medium text-gray-600'>{$products['stock']}</p>
                <p class='pt-5 text-xs text-gray-400 font-medium'>Total quantity in Hand</p>
            </div>
            <div class='h-[125px] w-[250px] p-2.5'>
                <p class='text-blue-500 text-sm font-semibold pb-3'>Sales Revenue</p>
                <p class='font-medium text-gray-600'>₱{$total['totalValue']}</p>
                <p class='pt-5 text-xs text-gray-400 font-medium'>Total revenue</p>
            </div>
            <div class='h-[125px] w-[250px] p-2.5'>
                <p class='text-green-500 text-sm font-semibold pb-3'>Income</p>
                <p class='font-medium text-gray-600'>₱{$income['totalValue']}</p>
                <p class='pt-5 text-xs text-gray-400 font-medium'>Total Income</p>
            </div>
           ";
        ?>
    </section>
</body>

</html>