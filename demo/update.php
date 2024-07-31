<?php
include 'db.php';

// Fetch bike details if the ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM bikes WHERE id = ?");
    $stmt->execute([$id]);
    $bike = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the bike was found
    if (!$bike) {
        // Redirect to the index page if the bike is not found
        header('Location: index.php');
        exit;
    }
} else {
    // Redirect to the index page if no ID is provided
    header('Location: index.php');
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("UPDATE bikes SET name = ?, price = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $price, $image, $id]);

    // Redirect to the index page after update
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bike</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        main {
            padding: 2em;
            max-width: 600px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #333;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #555;
        }

        .error {
            color: #ff0000;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .success {
            color: #00ff00;
            font-size: 14px;
            margin-
