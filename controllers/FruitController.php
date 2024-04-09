<?php

namespace controllers;

use Core\Database;
use Core\Validator;

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

        if (!Validator::string($name, min: 2, max: 50)) {
            $errors['name'] = 'Name must be between 2 and 50 characters';
        }

        if (!Validator::number($calories)) {
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
            'fruit' => compact('name', 'calories')
        ]);
    }

    public function show($id)
    {
        $db = new Database(require base_path('config.php'));

        $fruit = $db->query('SELECT * FROM fruits WHERE id = :id', [':id' => $id])->fetch();

        view('fruits/show', [
            'page_title' => $fruit['name'],
            'fruit' => $fruit
        ]);
    }

    public function edit($id)
    {
        $db = new Database(require base_path('config.php'));

        $fruit = $db->query('SELECT * FROM fruits WHERE id = :id', [':id' => $id])->fetch();

        view('fruits/edit', [
            'page_title' => 'Edit a Fruit',
            'fruit' => $fruit
        ]);
    }

    public function update($id)
    {
        $db = new Database(require base_path('config.php'));

        $errors = [];

        $name = trim($_POST['name']);

        $calories = $_POST['calories'];

        if (!Validator::string($name, max: 50, min: 2)) {
            $errors['name'] = 'Name must be between 2 and 50 characters';
        }

        if (!Validator::number($calories)) {
            $errors['calories'] = 'Calories must be a number';
        }

        if (empty($errors)) {
            $db->update('fruits', $id, compact('name', 'calories'));

            header('Location: /show?id=' . $id);

            die();
        }

        view('fruits/edit', [
            'page_title' => 'Edit Post',
            'errors' => $errors,
            'fruit' => compact('name', 'calories', 'id')
        ]);
    }

    public function destroy($id)
    {
        $db = new Database(require base_path('config.php'));

        $db->delete('fruits', $id);

        header('Location: /');
    }
}