<?php
function greetings()
{
    //word_count => return the number of words in a string
    $greet = "Good afternoon Daniel";
    echo str_word_count($greet);
}

greetings();

function fullName($fn, $ln)
{
    $usernname = $fn . " " . $ln;
    // if (str_word_count($usernname) > 2 || str_word_count($usernname) < 2) {
    //     echo "Username must be of two words";
    //     return;
    // }
    if (str_word_count($usernname) !== 2) {
        echo "Username must be of two words";
        return;
    }
    return $usernname;
}
echo fullName("Dev", "Dan");
$savedUser = fullName("Saved", "User");
print_r(explode(" ", $savedUser));

print_r(explode(", ", "Gorrila, is, an, animal"));

//TRIM
$text = "daniel";
echo strlen($text); // Class work print the last character in a string
echo strlen($text) . "Before trim<br/>";
echo strlen(trim($text)) . "After trim<br/>";

// ASSIGNMENT
// Write a function that validates a password
// => Password lenght (Must be more than 8 characters)
// => First letter must be uppercase
// => Last character must be a symbol of your choice
// => Second to the last character must be a number (optional)
// Expected password => Password12# -> Correct password
// Expected password => password12# -> wrong password

// function passwordChecker(){
    // Your code goes here....
// }

// ADDITIONAL ASSIGNMENT
// Write a function that checks for hate word in a sentence

// function checkHateWord(){
    // Your code goes here
// }

// checkHateWord("I hate you") echo "I h**t you
// checkHateWord("I love you") echo "I love you