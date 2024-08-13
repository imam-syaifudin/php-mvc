<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class Controller {

    protected function view(string $path, array $data = [])
    {
        $getFilePath = __DIR__ . '/../../resources/views/' . str_replace(".", "/",$path) . '.blade.php';

        if (file_exists($getFilePath)) {
            
            if( count($data) !== 0 ){
                extract($data);
            }

            require $_SERVER['DOCUMENT_ROOT'] . "../../resources/templates/header.php";
            require $getFilePath;
            require $_SERVER['DOCUMENT_ROOT'] . "../../resources/templates/footer.php";

        } else {
            throw new \Exception("View file not found: " . $getFilePath);
        }
    }

    protected function redirect(string $url)
    {
        $response = new RedirectResponse($url);
        $response->send();
    }

}