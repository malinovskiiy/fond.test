<?php require "header.php" ?>
<div class="page-wrapper py-5">
    <div class="pt-5 d-flex align-items-center">
        <main class="form-signin w-100 m-auto">
            <form action="/database/auth/Login.php" method="POST">
                <img class="mb-4" src="/assets/img/site_logo.png" alt="">
                <h1 class="h3 mb-3 fw-normal">Авторизация</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="email">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                        name="password">
                    <label for="floatingPassword">Пароль</label>
                </div>

                <button class="btn btn-primary w-100 py-2 my-3" type="submit">Войти</button>
                <?php if (isset($_SESSION['login_error'])): ?>
                    <small class="text-danger">
                        <?php echo $_SESSION['login_error'] ?>
                    </small>
                <?php endif ?>
                <p class="mt-3 mb-3 text-body-secondary">Нет аккаунта? <a href="/register.php">Регистрация</a></p>
            </form>
        </main>
    </div>
</div>