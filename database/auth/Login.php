<?php session_start();

// Add database connection
require_once '../DBController.php';

// Create db object
$db = new DBController();

// Get data from login form
$email = mysqli_real_escape_string($db->connection, $_POST['email']);
$password = mysqli_real_escape_string($db->connection, md5($_POST['password']));

// Select user with entered data
$check_user = $db->connection->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'");

// If user exists
if(mysqli_num_rows($check_user) > 0) {

    // Get user
    $user = mysqli_fetch_assoc($check_user);

    // Set session variable 
    $_SESSION['user'] = [
        'id' => $user['id'],
        'image' => $user['image'],
    ];
    
    header('Location: ../../dashboard');
    
} else {

    // Error message
    $_SESSION['login_error'] = 'Неверный пароль или имя пользователя';
    header('Location: ../../login');
};