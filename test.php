<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "maqsad_db";

try {
    $conn = mysqli_connect($host, $username, $password, $database);

    if ($conn) {
        echo "<h1 style='color: green;'>✅ Database Connection Successful!</h1>";
        echo "<p>Connected to database: <strong>$database</strong></p>";
        
        // Test if users table exists
        $table_check = mysqli_query($conn, "SHOW TABLES LIKE 'users'");
        if(mysqli_num_rows($table_check) > 0) {
            echo "<p style='color: green;'>✅ Users table exists</p>";
            
            // Show table structure
            $result = mysqli_query($conn, "DESCRIBE users");
            echo "<h3>Table Structure:</h3>";
            echo "<table border='1' style='border-collapse: collapse; margin: 10px;'>";
            echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Field'] . "</td>";
                echo "<td>" . $row['Type'] . "</td>";
                echo "<td>" . $row['Null'] . "</td>";
                echo "<td>" . $row['Key'] . "</td>";
                echo "<td>" . $row['Default'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color: red;'>❌ Users table does not exist!</p>";
            echo "<p>Please run this SQL query to create the table:</p>";
            echo "<pre style='background-color: #f4f4f4; padding: 10px;'>";
            echo "CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    role VARCHAR(20) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";
            echo "</pre>";
        }
    }
} catch(Exception $e) {
    echo "<h1 style='color: red;'>❌ Connection Failed!</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<h2>Troubleshooting Steps:</h2>";
    echo "<ol>";
    echo "<li>Make sure XAMPP is running (both Apache and MySQL)</li>";
    echo "<li>Check if the database 'maqsad_db' exists in phpMyAdmin</li>";
    echo "<li>Verify your username and password are correct</li>";
    echo "<li>Ensure you have proper permissions</li>";
    echo "</ol>";
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        line-height: 1.6;
    }
    table {
        margin: 20px 0;
    }
    th, td {
        padding: 8px 15px;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f4f4f4;
    }
    pre {
        background-color: #f4f4f4;
        padding: 15px;
        border-radius: 5px;
        overflow-x: auto;
    }
</style>