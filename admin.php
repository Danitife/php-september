<?php
include "connectdb.php";
session_start();
if (isset($_SESSION['email']) || $_SESSION['is_loggedIn'] == TRUE) {
    $email = $_SESSION['email'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $resp = mysqli_query($conn, $query);
    $user_details = mysqli_fetch_assoc($resp);
    // $user_details = mysqli_fetch_all($resp);
    print_r($user_details);
    if ($user_details['role'] === "user") {
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}


$query = "SELECT * FROM users";
$resp = mysqli_query($conn, $query);
$users = mysqli_fetch_all($resp, MYSQLI_ASSOC);
// print_r($users);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['password'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $user['id'] ?>">Grant Access</a>
                    <a href="edit.php?id=<?php echo $user['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $user['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>