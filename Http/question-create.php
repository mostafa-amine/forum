<?php

use Core\Database;
use Core\Validator;

require basePath('Core/Validator.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $validator = new Validator;

    $validator->name('content')->value($_POST['content'])->min(1)->required();
    $validator->name('title')->value($_POST['title'])->min(1)->required();

    if (!$validator->passes()) {
        $errors = $validator->getErrors();
    } else {
        $db = new Database(config('database'));
        $db->query('insert into questions (content, user_id, title) values(:content, :user_id, :title)', [
            'content' => $_POST['content'],
            'title' => $_POST['title'],
            'user_id' => 2,
        ]);
        header('Location: ' . '/questions');
    }
}

view('question-create.view.php', [
    'heading' => 'Create Question',
    'errors' => $errors ?? []
]);
