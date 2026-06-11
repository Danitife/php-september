<?php
session_start();
if (isset($_SESSION['login_details'])) {
    $saved_info = $_SESSION['login_details'];
    // print_r($saved_info);
}

if (isset($_POST['login'])) {
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    include "connectdb.php";
    // $query = "SELECT email, password FROM users WHERE email='$login_email' AND password='$login_password'";
    $query = "SELECT email, password FROM users WHERE email='$login_email'";
    $resp = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($resp);
    print_r($user);

    if ($user && password_verify($login_password, $user['password'])) {
        session_start();
        $_SESSION['email'] = $login_email;
        $_SESSION['is_loggedIn'] = true;
        header("Location: dashboard.php");
    } else {
        header("Location: login.php?error=Invalid email or password");
    }

    // if ($resp) {
    //     header("Location: dashboard.php");
    // } else {
    //     header("Location: login.php?error=Invalid email or password");
    // }


    // if ($login_email !== $saved_info['email'] || !password_verify($login_password, $saved_info['password'])) {
    //     header("Location: login.php?error=Invalid email or password");
    //     echo "Back to login";
    //     // return;
    // } else {
    //     header("Location: dashboard.php");
    //     echo "Going to the dashboard";
    // }
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
    <form action="login.php" method="post">
        <h3>Login</h3>
        <?php
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-warning'> $_GET[error] </div>";
        }
        ?>
        <input name="login_email" type="email"> <br><br>
        <input name="login_password" type="text"> <br><br>
        <button name="login">Login</button>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
</body>

</html>