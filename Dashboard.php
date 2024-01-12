<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Record</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="p-5 md:p-20">
        <div>
            <h1 class="text-lg font-semibold mb-8">Dashboard</h1>
            <?php include "CountingRecords.php"; ?>

            <!-- Fetch Dashboard Products -->
            <section>
                <div class="flex justify-between">
                    <h1 class="text-sm font-semibold my-2">In stock</h1>
                    <a href="AddStockForm.php" class="font-medium text-sm text-gray-600 hover:text-gray-800 duration-300 my-2">Add stock</a>
                </div>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "Dashboard";
                $conn = mysqli_connect($servername, $username, $password, $database);

                $result = $conn->query("SELECT * FROM Products");

                if ($result->num_rows > 0) {
                    echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Unit price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    In stock
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stock value
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Action</span>
                                </th>
                            </tr>
                        </thead>'; {
                        while ($row = $result->fetch_assoc()) {
                            $stockValue = $row['price'] * $row['inventory'];
                            $deleteUrl = "./api/delete_stock.php?id=" . $row['id'];
                            echo "<tbody>
                                <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                                <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                        {$row['id']}
                                    </th>
                                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                        {$row['productName']}
                                    </th>
                                    <td class='px-6 py-4'>
                                        {$row['category']}
                                    </td>
                                    <td class='px-6 py-4'>
                                    ₱{$row['price']}
                                    </td>
                                    <td class='px-6 py-4'>
                                        {$row['inventory']}
                                    </td>
                                    <td class='px-6 py-4'>
                                    ₱{$stockValue}
                                    </td>
                                    <td class='px-6 py-4 text-right'>
                                        <a href='EditStock.php?id={$row['id']}' class='font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2'>Edit</a>
                                        <a href='$deleteUrl' class='font-medium text-red-600 dark:text-red-500 hover:underline'>Remove</a>
                                    </td>
                                </tr>
                            </tbody>";
                        }
                    }

                    echo '</table>
                </div>';
                }
                ?>
            </section>





            <!-- For Sales table  -->
            <section class="mt-8">
                <div class="flex justify-between">
                    <h1 class="text-sm font-semibold my-2">Sales</h1>
                    <a href="OrderForm.php" class="font-medium text-sm text-gray-600 hover:text-gray-800 duration-300 my-2">Add order</a>
                </div>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "Dashboard";
                $conn = mysqli_connect($servername, $username, $password, $database);

                $result = $conn->query("SELECT * FROM Sales");
                if ($result->num_rows > 0) {
                    echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Order ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity sold
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Unit price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Action</span>
                                </th>
                            </tr>
                        </thead>'; {
                        while ($row = $result->fetch_assoc()) {
                            $totalPrice = $row['quantitySold'] * $row['price'];
                            $confirmedUrl = './api/confirmed_order.php?id=' . $row['id'];
                            $deleteUrl = "./api/delete_order.php?productName=" . $row['productName'] . "&id=" . $row['id'];
                            echo "<tbody>
                                <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                        {$row['id']}
                                    </th>
                                    <td class='px-6 py-4'>
                                        {$row['productName']}
                                    </td>
                                    <td class='px-6 py-4'>
                                        {$row['quantitySold']}
                                    </td>
                                    <td class='px-6 py-4'>
                                    ₱{$row['price']}
                                    </td>
                                    <td class='px-6 py-4'>
                                    ₱{$totalPrice}
                                    </td>
                                    <td class='px-6 py-4 text-right'>
                                        <a href='$deleteUrl' class='font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2'>Remove</a>
                                        <a href='$confirmedUrl' class='font-medium text-green-600 dark:text-green-500 hover:underline'>Confirmed</a>
                                    </td>
                                </tr>
                            </tbody>";
                        }
                    }

                    echo '</table>
                </div>';
                }
                ?>
            </section>

            <!-- Successfull ordered table -->
            <section class="mt-8">

                <h1 class="text-sm font-semibold my-2">Paid Order</h1>

                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "Dashboard";
                $conn = mysqli_connect($servername, $username, $password, $database);

                $result = $conn->query("SELECT * FROM Ordered");
                if ($result->num_rows > 0) {
                    echo '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Order ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity sold
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total income
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date of transaction
                                </th>
                            </tr>
                        </thead>'; {
                        while ($row = $result->fetch_assoc()) {
                            $totalPrice = $row['quantitySold'] * $row['price'];

                            $timestamp = new DateTime($row['date']);
                            $formattedDate = date('Y-m-d H:i:s', strtotime($row['date']));
                            echo "<tbody>
                                <tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                        {$row['id']}
                                    </th>
                                    <td class='px-6 py-4'>
                                        {$row['productName']}
                                    </td>
                                    <td class='px-6 py-4'>
                                        {$row['quantitySold']}
                                    </td>
                                    <td class='px-6 py-4'>
                                        ₱{$totalPrice}
                                    </td>
                                    <td class='px-6 py-4'>
                                        {$formattedDate}
                                    </td>
                                </tr>
                            </tbody>";
                        }
                    }
                    echo '</table>
                </div>';
                }
                ?>
            </section>
        </div>
    </main>

</body>

</html>