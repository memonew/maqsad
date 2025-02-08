<?php
session_start();
require '../connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $message = mysqli_real_escape_string($conn, isset($_POST['message']) ? $_POST['message'] : '');
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Create username from email (before @)
    $username = strstr($email, '@', true);
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_query);
    
    if(mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered']);
        exit();
    }
    
    // Insert user data
    $query = "INSERT INTO users (username, password, full_name, email, phone, role, message) 
              VALUES ('$username', '$hashed_password', '$full_name', '$email', '$phone', '$role', '$message')";
    
    if(mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Registration successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>