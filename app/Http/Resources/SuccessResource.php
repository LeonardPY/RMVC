<?php

namespace App\Http\Resources;

class SuccessResource
{
    static function make(array $data): string
    {
        header('Content-Type: application/json');;
        return json_encode([
            'success' => true,
            'message' => $data['message'] ?? '',
            'data' => $data['data'] ?? [],
        ]);
    }
}