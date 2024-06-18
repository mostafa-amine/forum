<?php

use Core\Database;

$questionId = $_GET['id'];

$database = new Database(config('database'));

$userId = 2;

$question = $database->query('select * from questions where id = :id', [
    'id' => $questionId
])->findOrFail();

authorise($question['user_id'] === $userId);

view('question.view.php', [
    'heading' => 'Question Details',
    'question' => $question
]);
