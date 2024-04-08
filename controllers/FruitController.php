<?php

namespace controllers;

use Core\Database;

class FruitController
{
    public function index($calories = null) 
    {
        $db = new Database(require base_path('config.php'));

        $query = 'SELECT * FROM fruits';

        $params = [];

        if ($calories != null) {
            $query .= ' WHERE calories < :calories';
            $params[':calories'] = $calories;
        }

        $fruits = $db->query($query, $params);

        view('fruits/index', [
            'page_title' => 'Fruits',
            'fruits' => $fruits
        ]);
    }

    public function create()
    {
        view('fruits/create', [
            'page_title' => 'Create Post'
        ]);
    }

    public function store()
    {
        $db = new Database(require base_path('config.php'));

        $errors = [];

        $name = trim($_POST['name']);

        $calories = $_POST['calories'];

        if (!Validator::string($title, max: 50, min: 2)) {
            $errors['name'] = 'Name must be between 2 and 50 characters';
        }

        if (!Validator::number($category_id)) {
            $errors['calories'] = 'Calories must be a number';
        }

        if (empty($errors)) {
            $db->insert('fruits', compact('name', 'calories'));

            header('Location: /');

            die();
        }

        view('fruits/create', [
            'page_title' => 'Create Post',
            'errors' => $errors,
            'name' => $name,
            'calories' => $calories
        ]);
    }

    public function show($id)
    {
        $db = new Database(require base_path('config.php'));

        $post = $db->query('SELECT * FROM fruits WHERE id = ?', [$id])->fetch();

        view('fruits/show', [
            'page_title' => $post['title'],
            'fruit' => $fruit
        ]);
    }

    public function edit($id)
    {
        $db = new Database(require base_path('config.php'));

        $post = $db->query('SELECT * FROM fruits WHERE id = ?', [$id])->fetch();

        view('posts/edit', [
            'page_title' => 'Edit Post',
            'fruit' => $fruit
        ]);
    }

    public function update($id)
    {
        $db = new Database(require base_path('config.php'));

        $errors = [];

        $name = trim($_POST['name']);

        $calories = $_POST['calories'];

        if (!Validator::string($title, max: 50, min: 2)) {
            $errors['name'] = 'Name must be between 2 and 50 characters';
        }

        if (!Validator::number($category_id)) {
            $errors['calories'] = 'Calories must be a number';
        }

        if (empty($errors)) {
            $db->update('fruits', $id, compact('name', 'calories'));

            header('Location: /');

            die();
        }

        view('fruits/edit', [
            'page_title' => 'Edit Post',
            'errors' => $errors,
            'name' => $name,
            'calories' => $calories
        ]);
    }

    public function destroy($id)
    {
        $db = new Database(require base_path('config.php'));

        $db->delete('fruits', $id);

        header('Location: /');
    }
}