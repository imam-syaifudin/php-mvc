<?php

namespace App\Core\Database\Connectors;

use PDO;

class Connector {

    protected string  $driver;
    protected array   $config;
    protected string  $dsn;

    public function __construct(string $driver, array $config)
    {
        $this->driver = $driver;    
        $this->config = $config;  
        
        $this->setDsn();
    }

    public function createConnection(): PDO
    {
        $connection = match($this->driver){
            'mysql' => MysqlConnector::connect($this->dsn, $this->config['username'], $this->config['password'] ),
        };

        return $connection;
    }

    public function setDsn()
    {
        $this->dsn = "mysql:host=" . $this->config['host'] . ";dbname=" . $this->config['database'];
    }

}