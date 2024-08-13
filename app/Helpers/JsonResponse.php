<?php

namespace App\Helpers;

class JsonResponse {

    public static function encode(mixed $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

}