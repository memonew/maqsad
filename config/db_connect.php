<?php
$host = 'localhost';
$dbname = 'maqsad_db';  // Replace with your database name
$username = 'root';      // Replace with your database username
$password = '';          // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>