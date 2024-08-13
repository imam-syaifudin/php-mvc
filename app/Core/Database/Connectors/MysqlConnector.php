<?php

namespace App\Core\Database\Connectors;

use PDO;

class MysqlConnector {
    
    public static function connect(string $dsn, string $username, string $password): PDO
    {
        try {

            // Init Object PDO
            $pdo = new PDO( dsn: $dsn, username: $username, password: $password );

            // PDO Set Attribute
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            // Return PDO OBJECT CONNECTION
            return $pdo;
        } catch (\Exception $error) {
            die($error->getMessage());
        }
    }

}