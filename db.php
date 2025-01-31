<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'logo';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}

?>