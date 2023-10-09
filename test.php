<!DOCTYPE html>
<html>
<head>
    <title>Поиск пользователей</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Поиск пользователей</h1>
    <form id="search-form">
        <label for="keywords">Введите ключевые слова через запятую:</label>
        <input type="text" id="keywords" name="keywords" required>
        <input type="submit" value="Искать">
    </form>

    <div id="search-results">
        <!-- Результаты поиска будут здесь -->
    </div>

    <script>
        // Обработчик отправки формы
        $("#search-form").submit(function(event) {
            event.preventDefault(); // Предотвращаем стандартное поведение формы
            var keywords = $("#keywords").val(); // Получаем ключевые слова из поля ввода

            // Выполняем AJAX-запрос к PHP-скрипту
            $.ajax({
                url: "search.php", // Укажите путь к вашему PHP-скрипту
                type: "POST",
                data: { keywords: keywords },
                success: function(response) {
                    // Отображаем результаты поиска в элементе с id "search-results"
                    $("#search-results").html(response);
                }
            });
        });
    </script>
</body>
</html>
