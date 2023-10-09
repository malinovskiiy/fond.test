<?php 
session_start();

unset($_SESSION['user']);
unset($_SESSION['register_error']);
unset($_SESSION['login_error']);

header('Location: ../../index');