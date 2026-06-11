<?php
include "connectdb.php";
$query = "SELECT * FROM users";
$resp = mysqli_query($conn, $query);
$users = mysqli_fetch_all($resp, MYSQLI_ASSOC);
print_r($users);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>