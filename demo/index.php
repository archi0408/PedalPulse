<?php
include 'db.php';

// Fetch bikes from the database
$stmt = $pdo->query("SELECT * FROM bikes");
$bikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PedalPulse - Bike Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        main {
            padding: 2em;
        }

        .bike-columns {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .bike-link {
            background-color: #333;
            border-radius: 5px;
            text-align: center;
            padding: 10px;
            box-shadow: 0 0 10px rgba(255, 0, 0, 0.3);
            color: #fff;
        }

        .bike-link img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
        }

        .buy-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .buy-buttons a {
            color: #fff;
            background-color: #ff0000;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .buy-buttons a:hover {
            background-color: #ff3333;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        a {
            color: #ff0000;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #ff3333;
        }
    </style>
</head>
<body>
<header>
    <h1>Bike Products</h1>
</header>

<main>
    <section>
        <a href="create.php">Add New Bike</a>
        <div class="bike-columns">
            <?php foreach ($bikes as $bike): ?>
                <div class="bike-link">
                    <img src="<?php echo htmlspecialchars($bike['image']); ?>" alt="<?php echo htmlspecialchars($bike['name']); ?>">
                    <h2><?php echo htmlspecialchars($bike['name']); ?></h2>
                    <p>Price: $<?php echo htmlspecialchars(number_format($bike['price'], 2)); ?></p>
                    <div class="buy-buttons">
                        <a href="edit.php?id=<?php echo $bike['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $bike['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2024 PedalPulse</p>
</footer>
</body>
</html>
