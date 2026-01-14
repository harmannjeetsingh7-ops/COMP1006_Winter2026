
<?php

// inline Comment


//3. Variables, Data Tyoes, Concatenation, Conditional Statements & Echo
$firstName = "Harmanjeet"; // string
$lastName = "Singh"; // string
$age = 20; // int
$isStudent = true; // boolean

echo "<p>Hello there, my name is " . $firstName . " " . $lastName . "</p>";

if ($isStudent) {
    echo "<p>I am a student and I am " . $age . " years old.</p>";
} else {
    echo "<p> opps I am not a student.</p>";
}
//4. Loosely Typed Language Demo
$num1= 1;
$num2= "10";

function add(int $num1, int $num2) :int {
    return $num1 + $num2;
}
echo "<p>" . add ($num1, $num2) ."</p>";
//5. Strict Types & Types Hints


//6. OOP with PHP 