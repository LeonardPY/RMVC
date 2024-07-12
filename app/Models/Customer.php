<?php

namespace App\Models;

use PDO;
use PDOException;

class Customer extends Model
{
    public function getById($id)
    {
        try {
            $stmt = $this->model->prepare("SELECT * FROM customers WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching customer: " . $e->getMessage();
            return null;
        }
    }

}
