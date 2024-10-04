<?php
include('db_connection.php');

// Function to sanitize user input
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Add Smartphone
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_smartphone'])) {
    $model_name = sanitize_input($_POST['model_name']);
    $brand = sanitize_input($_POST['brand']);
    $price = sanitize_input($_POST['price']);
    $storage_capacity = sanitize_input($_POST['storage_capacity']);
    $camera_resolution = sanitize_input($_POST['camera_resolution']);
    $battery_capacity = sanitize_input($_POST['battery_capacity']);
    $release_date = sanitize_input($_POST['release_date']);
    $stock_quantity = sanitize_input($_POST['stock_quantity']);
    $description = sanitize_input($_POST['description']);

    // Validate required fields
    if (empty($model_name) || empty($brand) || empty($price) || empty($stock_quantity)) {
        echo "Model Name, Brand, Price, and Stock Quantity are required.<br>";
    } elseif (!is_numeric($price) || $price < 0 || !is_numeric($stock_quantity) || $stock_quantity < 0) {
        echo "Price and Stock Quantity must be non-negative numbers.<br>";
    } else {
        $sql = "INSERT INTO smartphones (model_name, brand, price, storage_capacity, camera_resolution, battery_capacity, release_date, stock_quantity, description, ProductAddedBy)
                VALUES ('$model_name', '$brand', '$price', '$storage_capacity', '$camera_resolution', '$battery_capacity', '$release_date', '$stock_quantity', '$description', 'Om Rajendrabhai Patel')";

        if (mysqli_query($conn, $sql)) {
            echo "New smartphone added successfully.<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Update Smartphone
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_smartphone'])) {
    $id = sanitize_input($_POST['id']);
    $model_name = sanitize_input($_POST['model_name']);
    $brand = sanitize_input($_POST['brand']);
    $price = sanitize_input($_POST['price']);
    $stock_quantity = sanitize_input($_POST['stock_quantity']);

    // Validate required fields
    if (empty($id) || (!is_numeric($id))) {
        echo "A valid Smartphone ID is required.<br>";
    } elseif (!empty($price) && (!is_numeric($price) || $price < 0)) {
        echo "Price must be a non-negative number.<br>";
    } elseif (!empty($stock_quantity) && (!is_numeric($stock_quantity) || $stock_quantity < 0)) {
        echo "Stock Quantity must be a non-negative number.<br>";
    } else {
        $sql = "UPDATE smartphones SET model_name='$model_name', brand='$brand', price='$price', stock_quantity='$stock_quantity', updated_at=NOW() WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "Smartphone updated successfully.<br>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

// Delete Smartphone
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_smartphone'])) {
    $id = sanitize_input($_POST['id']);

    // Validate required fields
    if (empty($id) || !is_numeric($id)) {
        echo "A valid Smartphone ID is required for deletion.<br>";
    } else {
        $sql = "DELETE FROM smartphones WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            echo "Smartphone deleted successfully.<br>";
        } else {
            echo "Error deleting smartphone: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Smartphones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="h1">
    <h1>Admin Portal - Manage Smartphones</h1>
</div>

<!-- Add New Smartphone -->
<div class="login-box">
    <form method="POST">
        <h2>Add New Smartphone</h2>
        <label for="model_name">Model Name:</label>
        <input type="text" name="model_name" required><br>
        <label for="brand">Brand:</label>
        <input type="text" name="brand" required><br>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required><br>
        <label for="storage_capacity">Storage Capacity:</label>
        <input type="text" name="storage_capacity"><br>
        <label for="camera_resolution">Camera Resolution:</label>
        <input type="text" name="camera_resolution"><br>
        <label for="battery_capacity">Battery Capacity:</label>
        <input type="text" name="battery_capacity"><br>
        <label for="release_date">Release Date:</label>
        <input type="date" name="release_date"><br>
        <label for="stock_quantity">Stock Quantity:</label>
        <input type="number" name="stock_quantity" required><br>
        <label for="description">Description:</label>
        <textarea name="description"></textarea><br>
        <input type="submit" name="add_smartphone" value="Add Smartphone">
    </form>
</div>

<div class="login-box2">
    <h2>View All Smartphones</h2>
    <?php
    $sql = "SELECT * FROM smartphones";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "ID: " . $row["id"] . " - Model: " . $row["model_name"] . " - Brand: " . $row["brand"] . " - Price: " . $row["price"] . " - Added By: " . $row["ProductAddedBy"] . "<br>";
        }
    } else {
        echo "No smartphones found.<br>";
    }
    ?>
</div>

<div class="login-box1">
    <h2>Update Smartphone</h2>
    <form method="POST">
        <label for="id">Smartphone ID:</label>
        <input type="number" name="id" required><br>
        <label for="model_name">New Model Name:</label>
        <input type="text" name="model_name"><br>
        <label for="brand">New Brand:</label>
        <input type="text" name="brand"><br>
        <label for="price">New Price:</label>
        <input type="number" step="0.01" name="price"><br>
        <label for="stock_quantity">New Stock Quantity:</label>
        <input type="number" name="stock_quantity"><br>
        <input type="submit" name="update_smartphone" value="Update Smartphone">
    </form>
</div>

<div class="login-box3">
    <h2>Delete Smartphone</h2>
    <form method="POST">
        <label for="id">Smartphone ID:</label>
        <input type="number" name="id" required><br>
        <input type="submit" name="delete_smartphone" value="Delete Smartphone">
    </form>
</div>
</body>
</html>
