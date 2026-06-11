<?php
//forms

// super globals
// $_GET
// $_POST
// $_FILE
// $_SESSION
// $_GLOBALS
// $_COOKIE

// $hobbie = "football";

// function print_hobbie()
// {
//     $hobbie = $GLOBALS['hobbie'];
//     // global $hobbie;
//     echo "My hobbie is $hobbie";
// }

// print_hobbie();

$username = $_POST['username']; // document.getElementById('username')

if (isset($_POST['show_username'])) {
    echo $username; // Username: Daniel
    // Email: dan@gmail.com
    // Password: 123456
    // Gender: Male
    if (empty($username)) {
        echo "Username is required";
        // exit();
        // die();
        return;
    }
    if (strlen($username) < 4) {
        echo "Username must be at least 4 characters";
    }
}

// complete the validations 
// EMAIL_FILTER_VAR => to validate the email
// compare passwords
// password must be > 8
// password must have int, str, char...
// all input fields are mandatory
// implement the trim also
// password_hash => hash your password using this function and echo all your information including the hashed password
// after the validation,   navigate the user to login.php
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
    <!-- php: server side language -->
    <!-- javascript: client side language -->
    <!-- <div>
        <input id="name" type="text">
     </div> -->
    <form action="processform.php" method="post">
        <h3>Register</h3>
        <input name="username" type="text" placeholder="Enter your name"> <br><br>
        <input name="email" type="text" placeholder="Enter your Email"> <br><br>
        <input name="password" type="text" placeholder="*********"> <br><br>
        <input name="c_password" type="text" placeholder="*********"> <br><br>
        <button name="show_username">Show username</button>
    </form>
</body>

</html>