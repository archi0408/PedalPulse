<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
</head>
<body>
    <h1>Employees</h1>
    <a href="create.php">Create New Employee</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM employees";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["salary"] . "</td>";
                echo "<td>";
                echo "<a href='read.php?id=". $row["id"] ."'>Read</a> ";
                echo "<a href='update.php?id=". $row["id"] ."'>Update</a> ";
                echo "<a href='delete.php?id=". $row["id"] ."'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
