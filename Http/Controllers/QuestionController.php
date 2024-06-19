<?php

namespace Http\Controllers;

use Core\Database;
use Core\Validator;

class QuestionController
{
    public function index()
    {
        $db = new Database(config('database'));

        return view('questions.index', [
            'heading' => 'Questions',
            'questions' => $db->query('select * from questions')->all()
        ]);
    }

    public function create()
    {
        return view('questions.create', [
            'heading' => 'Create Question',
        ]);
    }

    public function store()
    {
        $errors = [];

        $validator = new Validator();

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

        return view('questions.create', [
            'header' => 'Questions',
            'errors' => $errors
        ]);
    }

    public function show()
    {
        $questionId = $_GET['id'];

        $userId = 2;

        $db = new Database(config('database'));

        $question = $db->query('select * from questions where id = :id', [
            'id' => $questionId
        ])->findOrFail();

        authorise($question['user_id'] === $userId);

        return view('questions.show', [
            'heading' => 'Question Details',
            'question' => $question
        ]);
    }
}
