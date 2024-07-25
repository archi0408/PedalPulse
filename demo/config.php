<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'archi0408');
define('DB_PASSWORD', 'archii05');
define('DB_DATABASE', 'demo');


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
