<?php

// Controllers

use controllers\FruitController;

// Index

$router->get('/{calories}', [FruitController::class, 'index']);

// CRUD

// Create
$router->get('/create', [FruitController::class, 'create']);
$router->post('/', [FruitController::class, 'store']);

// Read
$router->get('/show/{id}', [FruitController::class, 'show']);

// Update
$router->get('/edit/{id}', [FruitController::class, 'edit']);
$router->patch('/{id}', [FruitController::class, 'update']);

// Delete
$router->delete('/{id}', [FruitController::class, 'destroy']);