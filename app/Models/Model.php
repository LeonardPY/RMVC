<?php

namespace App\Models;

use PDO;

abstract class Model
{
    protected PDO $model;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->model = $database->getConnection();
    }

    public static function query(): static
    {
        return  new static();
    }
}