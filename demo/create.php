<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO bikes (name, price, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $image]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Bike</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        header { background-color: #333; color: #fff; padding: 1em; text-align: center; }
        main { padding: 2em; max-width: 600px; margin: auto; background: #fff; border-radius: 8px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 20px; border: none; border-radius: 4px; background: #333; color: #fff; cursor: pointer; }
        button:hover { background: #555; }
    </style>
</head>
<body>
<header>
    <h1>Add New Bike</h1>
</header>

<main>
    <form action="create.php" method="POST">
        <label for="name">Bike Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" required>

        <label for="image">Image URL:</label>
        <input type="text" name="image" id="image" required>

        <button type="submit">Add Bike</button>
    </form>
</main>
</body>
</html>
