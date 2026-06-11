<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$c_password = $_POST['c_password'];
if (empty($username) || empty($email)) {
    // echo "Username is required";
    // exit();
    // die();
    header("Location: register.php?error=All input feilds are required");
    return;
}
if (strlen($username) < 4) {
    echo "Username must be at least 4 characters";
}

if ($password !== $c_password) {
    header("Location: register.php?error=Passwords do not match");
    return;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// initializing the session
session_start();
$user = ["name" => $username, "email" => $email, "password" => $hashed_password];
$_SESSION['login_details'] = $user;

$db_name = "hostel_management";
$password = "";
$username = "root";

include "connectdb.php";

$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
$execute = mysqli_query($conn, $query);
if ($execute) {
    echo "User registered successfully";
    header("Location: login.php");
} else {
    echo "Error: " . mysqli_error($conn);
}




// mysql
// session_storage => A temporary storage
