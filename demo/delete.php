<?php
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    include 'config.php';

    $sql = "DELETE FROM employees WHERE id = ?";
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("i", $param_id);

        $param_id = trim($_GET["id"]);

        if($stmt->execute()){
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    $stmt->close();
    $conn->close();
} else{
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        p {
            color: #555;
        }
        input[type="submit"], a {
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        input[type="submit"] {
            background-color: #d9534f;
            color: #fff;
        }
        input[type="submit"]:hover {
            background-color: #c9302c;
        }
        a {
            background-color: #5bc0de;
            color: #fff;
        }
        a:hover {
            background-color: #31b0d5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Record</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
            <p>Are you sure you want to delete this record?</p>
            <input type="submit" value="Yes">
            <a href="index.php">No</a>
        </form>
    </div>
</body>
</html>
