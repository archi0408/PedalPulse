<?php
include 'db.php';

// Fetch all bikes to display
$stmt = $pdo->query("SELECT * FROM bikes");
$bikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike List</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        main {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .bike {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            display: inline-block;
            text-align: center;
            width: calc(33.333% - 20px); /* Adjusts the width to fit three items per row */
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            border-radius: 4px;
            background-color: #fff;
        }

        .bike img {
            max-width: 100%;
            height: auto;
        }

        .bike h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .bike p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .bike a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .bike a:hover {
            text-decoration: underline;
        }

        footer {
            text-align: center;
            padding: 10px;
            background: #333;
            color: #fff;
            margin-top: 20px;
        }

        .notification {
            padding: 10px;
            margin: 20px 0;
            border-radius: 4px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
<header>
    <h1>Bikes List</h1>
</header>

<main>
    <?php
    // Display a notification if the delete operation was successful
    if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
        echo '<div class="notification">Bike deleted successfully.</div>';
    }
    ?>

    <?php if (count($bikes) > 0): ?>
        <?php foreach ($bikes as $bike): ?>
            <div class="bike">
                <h2><?php echo htmlspecialchars($bike['name']); ?></h2>
                <img src="<?php echo htmlspecialchars($bike['image']); ?>" alt="<?php echo htmlspecialchars($bike['name']); ?>">
                <p>Price: $<?php echo number_format($bike['price'], 2); ?></p>
                <a href="edit.php?id=<?php echo $bike['id']; ?>">Edit</a>
                <br>
                <a href="delete.php?id=<?php echo $bike['id']; ?>" onclick="return confirm('Are you sure you want to delete this bike?');">Delete</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No bikes found.</p>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; 2024 Your Company</p>
</footer>
</body>
</html>
