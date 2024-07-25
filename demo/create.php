<?php
include 'config.php';

$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";
    } else{
        $name = trim($_POST["name"]);
    }

    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter an address.";
    } else{
        $address = trim($_POST["address"]);
    }

    if(empty(trim($_POST["salary"]))){
        $salary_err = "Please enter the salary amount.";
    } else{
        $salary = trim($_POST["salary"]);
    }

    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sss", $param_name, $param_address, $param_salary);

            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            if($stmt->execute()){
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
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
        }
        label {
            margin-top: 10px;
            color: #555;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px;
            color: #fff;
            background-color: #5cb85c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            color: #555;
            text-decoration: none;
        }
        a:hover {
            color: #000;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Employee</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error"><?php echo $name_err; ?></span>
            </div>
            <div>
                <label>Address</label>
                <textarea name="address"><?php echo $address; ?></textarea>
                <span class="error"><?php echo $address_err; ?></span>
            </div>
            <div>
                <label>Salary</label>
                <input type="text" name="salary" value="<?php echo $salary; ?>">
                <span class="error"><?php echo $salary_err; ?></span>
            </div>
            <input type="submit" value="Submit">
            <a href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>
