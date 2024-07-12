<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController
{
    public function index()
    {
        header('Content-Type: application/json');

        $customers = Customer::query()->getById(1);

        return json_encode([
            'customer' => $customers
        ]);
    }
}
