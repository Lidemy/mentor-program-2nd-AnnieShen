<?php


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mentor_program_db";

$conn = new mysqli($servername, $username, $password, $dbname);


$conn->query("SET NAMES 'UTF8'");
$conn->query("SET time_zone = '+8:00'");


?>