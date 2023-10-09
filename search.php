<?php
require 'functions.php';

// Получаем ключевые слова из POST-запроса
$keywords = explode(",",$_POST['keywords']);

// Создаем массив для хранения условий
$conditions = [];

// Подготавливаем условия для каждого ключевого слова
foreach ($keywords as $keyword) {
    $conditions[] = "JSON_CONTAINS(keywords, ?, '$')";
}

// Соединяем условия с помощью оператора "ИЛИ" (OR)
$whereClause = implode(" OR ", $conditions);

// Подготавливаем SQL-запрос
$sql = "SELECT * FROM users WHERE $whereClause";

$stmt = $db->connection->prepare($sql);

// Привязываем значения к параметрам
$param = str_repeat("s", count($keywords));
$stmt->bind_param($param, ...$keywords);


// Выполняем запрос
$stmt->execute();

// Получаем результаты
$result = $stmt->get_result();


// Выводим результаты
while ($row = $result->fetch_assoc()) {
    // Обработка результатов
    echo "User ID: " . $row['id'] . "<br>";
    echo "User Name: " . $row['first_name'] . "<br>";
    echo "User City: " . $row['study_place'] . "<br>";
    echo "User Keywords: " . $row['keywords'] . "<br>";
    echo "Intersections: " . count(array_intersect($keywords, explode(",", str_replace(['[', ']'], '', $row['keywords'])))) . "<br>";
    echo "<hr>";
    // Добавьте другие поля, которые вам нужны
}

// Закрываем соединение
$stmt->close();
?>
