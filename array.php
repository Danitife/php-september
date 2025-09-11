<?php
// Array is mutable
// Array is indexed
$courses = ["Html", "Css", "JavaScript", "Php", "Python"];
echo "My best course is $courses[0]";
echo $courses[1];
echo $courses[2];
echo $courses[3];

$courses[2] = "Bootstrap";
print_r($courses);

// echo My best course is Html
// echo My best course is Css
// echo My best course is JavaScript

// array_push()
array_push($courses, "Firebase", "React");

// To avoid repetition, that's when we introduce loop
// for ($i = 0; $i < count($courses); $i++) {
//     $element = $courses[$i];
//     // echo "<h1>" . "My favourite course is " . $element . "<h1/>";
//     echo "<h1> My favourite course is $element <h1/>";
//     // echo '<h1> My favourite course is $element <h1/>'; --------Wrong
// }

// $interesting_course = "$cources[2] is interesting";
// $interesting_course2 = '$course[2] is interesting';

// $my_name = "Daniel";

// $sentence = 'My name is $my_name';
// $sentence2 = "My name is $my_name";
// echo $sentence . "<br />";
// echo $sentence2 . "<br />";

foreach ($courses as $element) {
    echo "<h1> My favourite course is $element <h1/>";
}
//----------CONTIUE---------
// $a = 0;
// while ($a <= 10) {
//     if ($a == 5) {
//         $a++;
//         continue;
//     }
//     echo $a;
//     $a++;
// }

//----------CONTIUE---------

//----------BREAK---------
$b = 0;
while ($b <= 10) {
    if ($b == 5) {
        break;
    }
    echo "<h1>$b</h1>";
    $b++;
}


//----------BREAK---------
// 

// for each
// while loop
// Using for loop Echo all the courses using this format => My favourite course is ..... & it must be in an h1 tag
// Write a function that adds an element to your array
// addCourse("Node")
// addCourse("Laravel")

// local variables
// global variables

$my_list = [];

function addToArray($item)
{
    global $my_list;
    array_push($my_list, $item);
}
addToArray("treeeee"); // 0, 1
addToArray("Sl'ee'p"); // 1, 1
addToArray('C"od"e'); // 2, 1
// echo $loc;

print_r($my_list);

// array_splice($my_list, 1, 1);

// unset($my_list[0]); removes from an array and will not reindex it

print_r($my_list);

$dark_mode = false;

$hobbies = [];

function addHobbies($hobbie)
{
    global $hobbies;
    array_push($hobbies, $hobbie);
}
addHobbies("Singing");
addHobbies("Reading");
addHobbies("Swiming");
addHobbies("Spending");
function removeHobbie($idx)
{
    global $hobbies;
    array_splice($hobbies, $idx, 1);
}
function editHobbie($idx, $newVal)
{
    global $hobbies;
    $hobbies[$idx] = $newVal;
}

editHobbie(2, "Sleep")
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        <?php
        foreach ($hobbies as $hobby) {
            echo "<li> $hobby </li>";
        }
        ?>
    </ul>
    <h1><?php echo $my_list[0]; ?></h1>
    <h1><?php echo $my_list[1]; ?></h1>
    <?php if ($dark_mode) {
        echo "<div style='width: 200px; height: 200px; background-color: black;'></div>";
    } else {
        echo "<div style='width: 200px; height: 200px; background-color: blue;'></div>";
    } ?>


    <!-- Create an empty list of hobbies -->
    <!-- $hobbies = [] -->

    <!-- Write a function that adds hobbies to the array -->
    <!-- function addHobbies($hobbie){
    Your code goes here...
} -->
    <!-- addHobbies("singing") -->

    <!-- Write a function that removes an item from the list -->
    <!-- function removeHobbie($hobb){
    Your code goes here...
} -->
    <!-- Write a function that will change the value of your array(edit) -->
    <!-- function editHobbie($index, $value){
    your code goes here
} -->

    <!-- Display the items in your array inside of a list in a ul tag inside your html -->

</body>

</html>