<?php

use App\Core\Config;
use App\Core\Router;

class Application {


    public function run() : void
    {
        $this->setConfig();
        $this->setRouter();
    }

    private function setConfig() : void
    {
        // Config Init 
        Config::init();
    }

    private function setRouter() : void
    {
        
        // Init Router Setup
        Router::init();

        // Get file routes lists
        require_once '../routes/routes.php';

        // Dispacth Router
        Router::dispatch();
    }

}