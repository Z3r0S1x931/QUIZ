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

// Проверка, все ли вопросы заданы
if ($_SESSION['question_counter'] >= 5) {
    header('Location: result.php');
    exit();
}

// Текущий вопрос
$current_question = $_SESSION['questions'][$_SESSION['question_counter']];
$_SESSION['question_counter']++; // Увеличиваем счетчик

// Перемешиваем ответы
shuffle($current_question['answers']);

// Обработка ответа
if (isset($_POST['answer'])) {
    $user_answer = $_POST['answer'];
    $_SESSION['answers'][$current_question['question']] = $user_answer;
}

?>

<form method="POST" action="quiz.php">
    <h2>Вопрос <?php echo $_SESSION['question_counter']; ?></h2>
    <p><?php echo $current_question['question']; ?></p>

    <?php foreach ($current_question['answers'] as $index => $answer) { ?>
        <input type="radio" name="answer" value="<?php echo $index; ?>" required> <?php echo $answer; ?><br>
    <?php } ?>

    <button type="submit">Ответить</button>
</form>
