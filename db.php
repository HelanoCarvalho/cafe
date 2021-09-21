<?php
$servername = "localhost";
$username = 'root';
$password = '';
$bancodedados = 'pets';

// Create connection
$conn = new mysqli($servername, $username, $password, $bancodedados);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
   
?>

