<?php
include 'config.php';

$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];

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
        $sql = "UPDATE employees SET name=?, address=?, salary=? WHERE id=?";

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sssi", $param_name, $param_address, $param_salary, $param_id);

            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;

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
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM employees WHERE id = ?";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("i", $param_id);

            $param_id = $id;

            if($stmt->execute()){
                $result = $stmt->get_result();

                if($result->num_rows == 1){
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    $name = $row["name"];
                    $address = $row["address"];
                    $salary = $row["salary"];
                } else{
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        $stmt->close();
    } else{
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
    <title>Update Record</title>
</head>
<body>
    <h2>Update Employee</h2>
    <p>Please edit the input values and submit to update the employee record.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span><?php echo $name_err; ?></span>
        </div>
        <div>
            <label>Address</label>
            <textarea name="address"><?php echo $address; ?></textarea>
            <span><?php echo $address_err; ?></span>
        </div>
        <div>
            <label>Salary</label>
            <input type="text" name="salary" value="<?php echo $salary; ?>">
            <span><?php echo $salary_err; ?></span>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <div>
            <input type="submit" value="Submit">
            <a href="index.php">Cancel</a>
        </div>
    </form>
</body>
</html>
