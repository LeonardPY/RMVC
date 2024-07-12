<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Resources\SuccessResource;
use App\Models\Product;
use App\RMVC\Route\Route;
use App\RMVC\View\View;

class ProductController extends Controller
{
    public function index(): string
    {
        $products = Product::query()->all();

        return SuccessResource::make([
            'data' => $products
        ]);
    }

    public function show($id): string
    {
        $product = Product::query()->find($id);
        return View::view('products.show', compact('product'));
    }

    public function create(): string
    {
        return View::view('products.create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = new Product();
            $product->name = $_POST['name'];
            $product->description = $_POST['description'];
            $product->price = $_POST['price'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $imagePath = basename($image['name']);
                $targetPath = __DIR__ . '/../../public/images' . $imagePath;
                if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                    $product->image = $imagePath;
                } else {
                    echo "Failed to upload image.";
                    return;
                }
            } else {
                echo "No image uploaded.";
                return;
            }

            $product->save();

            Route::redirect('/products');
        } else {
        }
    }


    public function edit($id)
    {
        $product = Product::query()->find($id);
        return View::view('products.edit', compact('product'));
    }

    public function update(int $id, Request $request)
    {
        $data = $request->json();

        $product = Product::query()->find($id);

        $product->update($data);

        return SuccessResource::make([
            'data' => Product::query()->find($id),
        ]);
    }

    public function destroy($id)
    {
        $product = Product::query()->find($id);
        $product->delete();
        Route::redirect('/products');
    }
}
