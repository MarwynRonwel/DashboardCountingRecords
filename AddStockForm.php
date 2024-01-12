<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="p-20">
        <div class="flex justify-around">


            <form action="./api/add_stock.php" method="post" class="border rounded-lg px-5 py-3">
                <h1 class="text-lg font-bold text-gray-700">Stock Form</h1>
                <!-- Product name  -->
                <div class="my-4">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Product name</label>
                    <input type='text' name='name' id='name' placeholder='Name' class='block w-[320px] rounded-md border-0 py-1.5 pl-2 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6' required>
                </div>

                <!-- Category -->
                <div class="my-4">
                    <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Product category</label>
                    <input type='text' name='category' id='category' placeholder='Category' class='block w-[320px] rounded-md border-0 py-1.5 pl-2 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6' required>
                </div>

                <!-- Unit Price -->
                <div class="my-4">
                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Unit Price (per item)</label>
                    <div class="relative mt-2 rounded-md">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">₱</span>
                        </div>
                        <input type="text" name="price" id="price" class="block w-[320px] rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00" required>
                    </div>
                </div>

                <!-- Order Quantity -->
                <div class="my-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">Order quantity</label>
                        <div class="relative mt-2 rounded-md">
                            <input type="number" name="quantity" id="quantity" class="block w-[320px] rounded-md border-0 py-1.5 pl-2.5 pr-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0" required>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-10">
                    <a href="Dashboard.php" class="text-sm text-gray-500 block">Back to dashboard</a>
                    <button type="submit" class="text-sm font-medium text-gray-700 hover:text-black">Create stock amount</button>
                </div>
            </form>

            <div class="border rounded-lg py-3">
                <p class="text-xl font-semibold px-6">Inventory stock</p>
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
                    echo "<div class='border-b py-4 px-6'>
                                    <p scope='row' class='text-xl font-medium text-gray-900'>
                                        {$row['productName']}
                                    </p>
                        
                                    <div class='flex justify-between items-center gap-x-8 text-sm text-gray-500 italic mt-2'>
                                    <p>
                                    ₱ {$row['price']}
                                    </p>
                                    <p>
                                        Stock: {$row['inventory']}
                                    </p>
                                    </div>
                            </div>";
                }
                ?>
            </div>
        </div>
    </section>
</body>

</html>