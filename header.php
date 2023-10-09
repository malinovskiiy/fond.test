<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/fonts/font-stylesheet.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/sign-in.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="./favicon.svg">
    <title>Портал стипендиатов Фонда</title>
    <?php require_once "functions.php"?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3 fixed-top">
        <div class="container">
            <a href="/" class="d-flex align-items-center mb-lg-0 link-body-emphasis text-decoration-none">
                <img src="./assets/img/logo.png"class="bi"/>
              </a>
          <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="nav col-12 col-lg-auto mx-lg-auto my-3 my-lg-0 justify-content-center ">
                <li><a href="/" class="nav-link px-3 link-body-emphasis">Главная</a></li>
                <li><a href="#" class="nav-link px-3 link-body-emphasis">О фонде</a></li>
                <li><a href="#" class="nav-link px-3 link-body-emphasis">Участникам</a></li>
                <li><a href="#" class="nav-link px-3 link-body-emphasis">Новости</a></li>
                <li><a href="#" class="nav-link px-3 link-body-emphasis">Контакты</a></li>
                <li><a href="#" class="nav-link px-3 link-body-emphasis">Архив</a></li>
              </ul>
            <?php if($_SESSION['user']):?>
              <div class="dropdown text-center text-md-end">
                  <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <img src="<?php echo $_SESSION['user']['image']?>" alt="mdo" width="32" height="32" class="rounded-circle me-2">
                    <span class="header-first-name"><?php echo $UserData['first_name']?></span>
                  </a>
                  <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item text-md-end" href="/dashboard">Мой профиль</a></li>
                    <li><a class="dropdown-item text-md-end" href="/edit-profile">Настройки профиля</a></li>
                    <li><a class="dropdown-item text-md-end" href="/edit-complex-rating">Комплексный рейтинг</a></li>
                   
                    
                    
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-md-end" href="/database/auth/Logout">Выйти</a></li>
                  </ul>
              </div>
            <?php else: ?>
              <form action="/login">
                <button type="submit" class="btn btn-primary">Войти</button>
              </form>
              
            <?php endif?>
          </div>
        </div>
    </nav>