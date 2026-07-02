<?php
// sql injection is the process of writing sql query into your input
// unsanitized input
// wrong logic
include "connectdb.php";

if (isset($_POST['login'])) {
    // $email = $_POST['email'];
    $email = mysqli_real_escape_string($conn, $_POST['email']); // sanitizing text inputs
    // $password = $_POST['password'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $resp = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($resp);
    print_r($user);
    echo "----- User info";
    if ($user) {
        print_r($user);
        // header("Location: dashboard.php");
    } else {
        echo "User information incorrect";
    }

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email=? AND password=?");
    $bind =  mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    $user = mysqli_stmt_execute($stmt);

    if ($user) {
        print_r($user);
        // header("Location: dashboard.php");
    } else {
        echo "User information incorrect";
    }
}

if (isset($_POST['show'])) {
    $htm = $_POST['htm'];

    echo $htm;

    echo htmlspecialchars($htm);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="injection.php" method="post">
        <input type="text" name="htm"> <br>
        <button name="show">Show</button>
    </form>
    <form action="injection.php" method="post">
        <h2>Login</h2>
        <input type="text" name="email"> <br> <br>
        <input type="text" name="password"> <br> <br>
        <button name="login">Login</button>
    </form>
</body>

</html>