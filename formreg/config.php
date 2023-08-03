<?php
// Create a variable to store the database connection

$host = 'localhost';
$dbname = 'records';
$username = 'root';
$password = '';

try {
  // Create a PDO object to connect to the database
  
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

  // Set the PDO error mode to exception
  // This will throw PDOException objects when there are database errors
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Echo a message to confirm that the connection is successful
  echo "Connected successfully to the database.";
} catch (PDOException $e) {
  // Handle any database connection errors
  echo "Connection failed: " . $e->getMessage();
}
?>
