<?php

use Core\Database;

$database = new Database(config('database'));

view('questions.view.php', [
    'heading' => 'Questions',
    'questions' => $database->query('select * from questions')->all()
]);
