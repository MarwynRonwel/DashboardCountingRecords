<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Dashboard";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM Products WHERE id = $id");
    $row = $result->fetch_assoc();

    $category = $conn->query("SELECT DISTINCT category FROM Products");
    $categories = $category->fetch_all(MYSQLI_ASSOC);

    echo "<section class='flex justify-center'>
          <form action='./api/edit_stock.php' method='post' class='p-20'>
              <h1 class='text-lg font-bold text-gray-600'>Update: #{$row['id']} item</h1>
              <input type='hidden' name='id' id='id' value='{$row['id']}' />
              <div class='mb-5 mt-2'>
                  <label for='name' class='text-sm font-semibold text-gray-700 my-2'>Product Name</label>
                  <input type='text' name='name' id='name' placeholder='Product name' value='{$row['productName']}' class='block border border-gray-700 py-1.5 pl-1.5 pr-5 rounded-md'>
              </div>

            <div class='my-5'>
                  <label for='category' class='text-sm font-semibold text-gray-700 my-2'>Select category</label>
                  <select name='category' id='category' class='block border border-gray-700 py-1.5 pl-1.5 pr-5 rounded-md'>";

    foreach ($categories as $category) {
        $categoryValue = $category['category'];
        $selected = ($row['category'] == $categoryValue) ? 'selected' : '';
        echo "<option value='$categoryValue' $selected>$categoryValue</option>";
    }

    echo "</select>
              </div>

    <div class='my-5'>
                  <label for='price' class='text-sm font-semibold text-gray-700 my-2'>Price</label>
                  <input type='number' name='price' id='price' placeholder='Price' class='block border border-gray-700 py-1.5 pl-1.5 pr-5 rounded-md' value='{$row['price']}'>
              </div>

              <div class='my-5'>
                  <label for='inventory' class='text-sm font-semibold text-gray-700 my-2'>Quantity</label>
                  <input type='number' name='inventory' id='inventory' placeholder='How many?' class='block border border-gray-700 py-1.5 pl-1.5 pr-5 rounded-md' value='{$row['inventory']}'>
              </div>
  
              <div class='my-10 flex justify-between items-center'>
                  <button class='bg-blue-200 py-1.5 px-3.5 rounded-md font-medium text-sm' type='submit'>Update</button>
                  <a href='Dashboard.php'>Cancel</a>
              </div>
          </form>
      </section>";

    $conn->close();
    ?>
</body>

</html>