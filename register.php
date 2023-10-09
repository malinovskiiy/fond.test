<?php require "header.php" ?>
<div class="page-wrapper py-5">
    <div class="pt-5 d-flex align-items-center">
        <main class="form-signin w-100 m-auto">
            <form method="POST" action="./database/auth/Register.php">
                <img class="mb-4" src="/assets/img/site_logo.png" alt="">
                <h1 class="h3 mb-3 fw-normal">Регистрация на портале</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="first_name">
                    <label for="floatingInput">Имя</label>
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                        name="last_name">
                    <label for="floatingInput">Фамилия</label>
                </div>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="Password" name="email">
                    <label for="floatingInput">Email</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingInput" placeholder="Password"
                        name="password">
                    <label for="floatingInput">Пароль</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingInput" placeholder="Password"
                        name="con-password">
                    <label for="floatingInput">Подтвердите пароль</label>
                </div>

                <button class="btn btn-primary w-100 py-2 my-3" type="submit">Зарегистрироваться</button>
                <?php if (isset($_SESSION['register_error'])): ?>
                    <small class="text-danger">
                        <?php echo $_SESSION['register_error'] ?>
                    </small>
                <?php endif ?>
                <p class="mt-3 mb-3 text-body-secondary">Уже зарегистрированы? <a href="/login.php">Войти</a></p>

            </form>
        </main>
    </div>
</div>