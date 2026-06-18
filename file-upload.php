<?php


include "connectdb.php";
if (isset($_POST['upload'])) {
    $file_name = $_FILES['picture']['name'];
    $file_size = $_FILES['picture']['size'];
    $file_type = $_FILES['picture']['type'];

    echo $file_name;
    echo "<br>";
    echo $file_size;
    echo "<br>";
    echo $file_type;

    $dir = "images/";
    $file = $dir . basename($_FILES['picture']['name']);
    // if ($file) {
    //     move_uploaded_file($_FILES['picture']['tmp_name'], $file);
    //     echo "File upladed successfully";
    // } else {
    //     echo "Error uploading file";
    // }

    // if (move_uploaded_file($_FILES['picture']['tmp_name'], $file)) {
    //     $profile_update_query = "UPDATE users SET profile_picture='$file' WHERE email='$email'";
    //     $resp = mysqli_query($conn, $profile_update_query);
    //     if ($resp) {
    //         echo "File uploaded successfully";
    //     }
    // } else {
    //     echo "Error uploading file";
    // }
}

// for ($i = 1; $i <= 20; $i++) {
//     $rooms_query = "INSERT INTO rooms (id) VALUES ($i)";
//     try {
//         $resp = mysqli_query($conn, $rooms_query);
//         if ($resp) {
//             echo "Done";
//         }
//     } catch (Exception $e) {
//         echo "Error: " . $e->getMessage();
//     }
// }

$fetch_room = "SELECT * FROM rooms";
$rez_query = mysqli_query($conn, $fetch_room);
$resp = mysqli_fetch_all($rez_query, MYSQLI_ASSOC);

print_r($resp)

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
    <form action="file-upload.php" method="post" enctype="multipart/form-data">
        <h2>Upload a picture</h2>
        <input name="picture" type="file">
        <button name="upload">Upload</button>
    </form>

    <h3>Display rooms and bunks</h3>

    <select name="" id="">
        <option value="">Select a room</option>
        <?php foreach ($resp as $room) { ?>
            <option value=""><?php echo $room['id'] ?></option>
        <?php } ?>
    </select>

    <div class="">

        <?php foreach ($resp as $room) { ?>
            <h2>Room <?php echo $room['id'] ?></h2>
            <div class='w-25 py-1 border rounded shadow-md d-flex flex-wrap'>
                <?php foreach (explode(",", $room['bunks']) as $bunk) { ?>
                    <div class=" <?php echo in_array($bunk, explode(",", $room['occupied'])) ? 'bg-secondary' : 'bg-primary' ?>  m-1 w-25">
                        <h1><?php echo $bunk ?></h1>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>


    </div>


</body>

</html>