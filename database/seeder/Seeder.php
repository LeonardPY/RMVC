<?php
readonly class Seeder
{
    public function __construct(
        private PDO $pdo
    )
    {
    }

    public function run(): void
    {
        $this->seedTableAdmin();
        $this->seedTableCustomers();
        $this->seedTableProducts();
    }

    public function seedTableAdmin(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO admin (username, password) VALUES (:username, :password)");

        $stmt->execute([
            ':username' => 'admin',
            ':password' => 'admin123',
        ]);
    }

    public function seedTableCustomers(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO customers (first_name, last_name, phone_number, address) VALUES (:first_name, :last_name, :phone_number, :address)");

        $customers = [
            ['first_name' => 'John', 'last_name' => 'Doe', 'phone_number' => '1234567890', 'address' => '123 Main St'],
            ['first_name' => 'Jane', 'last_name' => 'Doe', 'phone_number' => '0987654321', 'address' => '456 Elm St'],
        ];

        foreach ($customers as $customer) {
            $stmt->execute([
                ':first_name' => $customer['first_name'],
                ':last_name' => $customer['last_name'],
                ':phone_number' => $customer['phone_number'],
                ':address' => $customer['address'],
            ]);
        }

    }

    public function seedTableProducts(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)");

        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'price' => 19.99,
                'image' => 'image1.jpg'
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'price' => 29.99,
                'image' => 'image2.jpg'
            ],
        ];

        foreach ($products as $product) {
            $stmt->execute([
                ':name' => $product['name'],
                ':description' => $product['description'],
                ':price' => $product['price'],
                ':image' => $product['image'],
            ]);
        }
    }
}