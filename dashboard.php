<?php
session_start();
include "connectdb.php";
if (isset($_SESSION['email']) || $_SESSION['is_loggedIn'] == TRUE) {
    $user_details = $_SESSION['login_details'];
    $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email='$email'";
    $resp = mysqli_query($conn, $query);
    $user_details = mysqli_fetch_assoc($resp);
    print_r($user_details);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <main>
        <nav class="navbar">
            <a href="#" class="navbar-brand">Logo</a>
            <ul class="nav">
                <li class="nav-item">
                    <a href="profile.php" class="btn btn-danger">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </li>
            </ul>
        </nav>
        <h1>Welcome to your dashboard <?php echo $user_details['username'] ?></h1>

        <?php
        if ($user_details['is_verified'] == false) {
            echo "<h2>You have not been verified</h2>";
        }
        ?>
    </main>
</body>

</html>