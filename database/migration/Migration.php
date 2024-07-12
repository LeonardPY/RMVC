<?php

readonly class Migration
{
    public function __construct(
        private PDO $pdo
    )
    {
    }

    public function run(): void
    {
        $this->createTableAdmin();
        $this->createTableCustomers();
        $this->createTableProducts();
    }

    public function createTableAdmin(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS admin (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            )"
        );
    }

    public function createTableCustomers(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS customers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            phone_number VARCHAR(15) NOT NULL,
            address TEXT NOT NULL
        )");
    }

    public function createTableProducts(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            image TEXT NULL
        )");
    }
}