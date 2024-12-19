<?php
session_start();

// Список всех вопросов и их вариантов ответов
$questions = [
    1 => [
        'question' => 'Что такое HTML?',
        'answers' => ['Язык программирования', 'Язык разметки', 'База данных', 'Протокол сети', 'Операционная система', 'Среда разработки'],
        'correct_answer' => 1
    ],
    2 => [
        'question' => 'Что такое CSS?',
        'answers' => ['Язык разметки', 'Язык программирования', 'Язык стилизации', 'База данных', 'Фреймворк', 'Микросервис'],
        'correct_answer' => 2
    ],
    3 => [
        'question' => 'Какую роль выполняет JavaScript?',
        'answers' => ['Стилизация', 'Разметка', 'Добавление функциональности на клиенте', 'Обработка данных на сервере', 'Хранение данных', 'Обработка HTTP-запросов'],
        'correct_answer' => 2
    ],
    4 => [
        'question' => 'Что такое DOM в контексте веб-разработки?',
        'answers' => ['Структура базы данных', 'Представление документа в памяти', 'Язык программирования', 'Тип данных', 'Маршрутизация запросов', 'Метод авторизации'],
        'correct_answer' => 1
    ],
    5 => [
        'question' => 'Какая задача решается при использовании фреймворков JavaScript?',
        'answers' => ['Повышение безопасности', 'Оптимизация графики', 'Ускорение и упрощение разработки', 'Управление сервером', 'Визуализация данных', 'Тестирование'],
        'correct_answer' => 2
    ],
    6 => [
        'question' => 'Что такое REST API?',
        'answers' => ['Интерфейс для работы с сервером', 'Тип веб-сайта', 'Метод анимации на странице', 'Пользовательский интерфейс', 'Протокол сетевого обмена', 'Метод работы с базами данных'],
        'correct_answer' => 0
    ],
    7 => [
        'question' => 'Какой тег используется для добавления изображений в HTML?',
        'answers' => ['<img>', '<div>', '<section>', '<a>', '<span>', '<picture>'],
        'correct_answer' => 0
    ]
];

$correct_answers = 0;

// Подсчитываем правильные ответы
foreach ($_SESSION['answers'] as $question => $answer) {
    $question_id = array_search($question, array_column($questions, 'question'));
    if ($questions[$question_id]['correct_answer'] == $answer) {
        $correct_answers++;
    }
}

$_SESSION['correct_answers'] = $correct_answers;

// Запись результатов в текстовый файл
$result_text = "Количество правильных ответов: $correct_answers\n";
$result_text .= "Количество неправильных ответов: " . (5 - $correct_answers) . "\n";
$result_text .= "Дата тестирования: " . date("Y-m-d H:i:s") . "\n";

// Сохраняем результат в файл
$file = fopen("results.txt", "a");
fwrite($file, $result_text);
fclose($file);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты квиза</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Ваш результат: <?php echo $correct_answers; ?> из 5</h1>
    <canvas id="resultChart"></canvas>
    <script>
        var ctx = document.getElementById('resultChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Правильные', 'Неправильные'],
                datasets: [{
                    data: [<?php echo $correct_answers; ?>, <?php echo 5 - $correct_answers; ?>],
                    backgroundColor: ['green', 'red']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>
