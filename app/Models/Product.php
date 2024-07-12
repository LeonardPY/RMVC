<?php

namespace App\Models;

use PDO;

class Product extends Model
{
    public function all(): array
    {
        $stmt = $this->model->query('SELECT * FROM products');
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function find($id)
    {
        $stmt = $this->model->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(self::class);
    }

    public function save()
    {
        $stmt = $this->model->prepare('INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)');
        $stmt->execute([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
        ]);
    }

    public function update($data): void
    {
        $stmt = $this->model->prepare('UPDATE products SET name = :name, description = :description, price = :price, image = :image WHERE id = :id');
        $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $data['image'],
            'id' => $this->id,
        ]);
    }

    public function delete()
    {
        $stmt = $this->model->prepare('DELETE FROM products WHERE id = :id');
        $stmt->execute(['id' => $this->id]);
    }


}
