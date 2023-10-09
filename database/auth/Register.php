<?php
session_start();

// Add database connection
require_once '../DBController.php';

// Create db object
$db = new DBController();


// Get data from register form
$first_name = strip_tags($_POST['first_name']);
$last_name = strip_tags($_POST['last_name']);
$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);
$confirm_password = strip_tags($_POST['con-password']);

// Select user with entered data
$email_check_user = $db->connection->query("SELECT * FROM `users` WHERE `email` = '$email'") ?? [];

// Get user
$email_user = mysqli_fetch_assoc($email_check_user);

if(!empty($email_user)){
    $_SESSION['register_error'] = 'User with this email already exists';
    header('Location: ../../index?tab=register');
    exit;
}

// Validate password at least 6 characters in length and must contain at least one number, one uppercase letter, one lowercase letter
$number = preg_match('@[0-6]@', $password);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
 
if(strlen($password) < 6 || !$number || !$uppercase || !$lowercase) {
    $_SESSION['register_error'] = 'Password must be at least 6 characters in length and must contain at least one number, one uppercase letter, one lowercase letter';
    header('Location: ../../register.php');
    exit;
} 


// If passwords matches
if ($password == $confirm_password) {

    // Hash password
    $password = md5($password);

    // Execute query
    $db->connection->query("INSERT INTO `users` (`id`, `email`, `password`, `username`, `role`, `image`, `keywords`, `first_name`, `last_name`, `patronymic`, `date_of_birth`, `involvement_level`, `phone`, `telegram`, `extra_skills`, `research_topic`, `about_text`, `study_place`, `study_city`, `study_level`, `study_year`, `study_institution`, `study_direction`, `study_average_grade`, `study_languages`, `science_degree`, `science_work_topic`, `science_main_achievement`, `science_societies`, `science_other_societies`, `science_ya_expert`, `science_ya_ambassador`) VALUES (NULL, '$email', '$password', NULL, '0', '../../uploads/profile_img/default-user-image.jpg', '[]', '$first_name', '$last_name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");

    // Select user with entered data
    $check_user = $db->connection->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'");

    // Get user
    $user = mysqli_fetch_assoc($check_user);

    $db->connection->query("UPDATE `users` SET `username`='id{$user["id"]}' WHERE `email`='$email' AND `password`='$password'");

    // Set session variable 
    $_SESSION['user'] = [
        'id' => $user['id'],
        'image' => $user['image'],
    ];

    unset($_SESSION['register_error']);

    header('Location: ../../dashboard');
  

} else {

    // Error message
    $_SESSION['register_error'] = "Пароли не совпадают";
    header('Location: ../../register');
}
