<?php
$hostname = "localhost";
$db_name = "hostel_management";
$password = "";
$username = "root";

try {
    $conn = mysqli_connect($hostname, $username, $password, $db_name);
    // $conn = mysqli_connect("localhost", "root", "", "hostel_management");
    if ($conn) {
        echo "Database connected";
    } else {
        echo "Database connection failed";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
