<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
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
    <form action="processform.php" method="post" class="w-50 p-3 rounded shadow mx-auto mt-4">
        <h3>Register</h3>
        <?php
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-warning'> $_GET[error] </div>";
        }
        ?>
        <input name="username" type="text" placeholder="Enter your name"> <br><br>
        <input name="email" type="text" placeholder="Enter your Email"> <br><br>
        <input name="password" type="text" placeholder="*********"> <br><br>
        <input name="c_password" type="text" placeholder="*********"> <br><br>
        <button name="show_username">Show username</button>
    </form>
</body>

</html>