<?php
/*when you have a pure PHP file, you don't need to close the tag of PHP. Preferred practice.*/

$dbServername= "localhost";
$dbUsername= "root";
$dbPassword= ""; //leaving it empty cuz XAMPP does not have a password by default.
$dbName= "practice";

$conn=mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);