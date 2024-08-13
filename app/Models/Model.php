<?php


namespace App\Models;

use PDO;
use Exception;
use PDOStatement;
use App\Core\Config;
use App\Helpers\Str;
use App\Core\Database\Connectors\Connector;
use PDOException;

abstract class Model
{
    protected PDO          $connection;
    protected string       $table;
    protected PDOStatement $statement;
    protected array        $columns;
    protected string       $primaryKey = 'id';
    protected $record;

    public function __construct()
    {
        $this->setConnection();
        $this->setTable();
        $this->setColumn();
    }

    private function setConnection(): self
    {
        // Get Config Database from config/database.php
        $driver  = Config::getConfig('database.connection');
        $config  = Config::getConfig("database.$driver");

        // Create Connector
        $connector = new Connector($driver, $config);

        // Create Connection
        $this->connection  = $connector->createConnection();

        return $this;
    }

    private function setTable(): self
    {
        $this->table = $this->table ?? $this->getTableName();
        return $this;
    }

    private function setColumn()
    {
        $getColumns    = $this->query("DESCRIBE {$this->table}")->get(PDO::FETCH_COLUMN);
        array_shift($getColumns);

        $this->columns = $getColumns;
    }

    public function getTableName(): string
    {
        $getModelName = explode("\\", get_class($this));
        return Str::camelToSnakeString(end($getModelName));
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    private function query(string $query): self
    {
        $this->statement = $this->connection->prepare($query);
        return $this;
    }

    public static function raw(string $query): self
    {
        return (new static)->query($query);
    }

    public function get(int $options = PDO::FETCH_OBJ)
    {
        $this->statement->execute();
        $this->record = $this->statement->fetchAll($options);

        if (!$this->record && count($this->record) !== 0) {
            throw new Exception("No Query Result for model : " . get_class($this));
        }
        return $this->record;
    }

    public function first(int $options = PDO::FETCH_OBJ)
    {
        $this->statement->execute();
        $this->record = $this->statement->fetch($options);

        if (!$this->record) {
            throw new Exception("No Query Result for model : " . get_class($this));
        }
        return $this->record;
    }

    public static function all()
    {
        $instance = new static();
        return $instance->query("SELECT * FROM {$instance->table}")->get();
    }

    public static function find(int $id)
    {
        $instance = new static();

        $instance->query("SELECT * FROM {$instance->table} WHERE id = $id");
        $instance->first();

        return $instance;
    }

    public static function create(array $data)
    {
        $instance = new static();
        $columns  = $instance->columns;
        $sql = "INSERT INTO {$instance->table} (" . Str::arrToString($columns, ", ") . ") VALUES (" . ":" . Str::arrToString($columns, ", :") . ")";

        $instance->query($sql);
        $instance->statement->execute($data);

        return $instance->find($instance->connection->lastInsertId());
    }

    public function update(array $data): bool
    {
        $sql = "UPDATE {$this->table} SET " . Str::repeatFromArray(array_keys($data), ", ");
        $updateState = str_replace("SELECT * FROM $this->table", $sql, $this->statement->queryString);

        $this->query($updateState);
        $this->statement->execute($data);

        return $this->statement->rowCount() > 0;
    }

    public function delete(): bool
    {
        $deleteStatement = str_replace("SELECT *", "DELETE", $this->statement->queryString);

        $this->query($deleteStatement);
        $this->statement->execute();

        return $this->statement->rowCount() > 0;
    }
}
