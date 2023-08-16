<?php

namespace models\base;

use Interfaces\DatabaseWrapper;
use PDO;

class Model implements DatabaseWrapper
{
    private PDO $pdo;

    protected string $table = '';

    public function __construct()
    {
        // Подключение к базе данных SQLite
        $this->pdo = new PDO("sqlite:D:\db\mydatabase.db");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insert(array $tableColumns, array $values): array
    {
        $columns = implode(', ', $tableColumns);
        $rows = [];
        foreach ($values as $value) {
            $formattedValues = array_map(function($item) {
                return $this->pdo->quote($item);
            }, $value);
            $rows[] = "(" . implode(', ', $formattedValues) . ")";
        }
        $rowsString = implode(', ', $rows);
        $sql = "INSERT INTO $this->table ($columns) VALUES $rowsString;";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function update(int $id, array $values): array
    {
        $valuesList = [];
        foreach ($values as $column => $value) {
            $column = $this->pdo->quote($column);
            $value = $this->pdo->quote($value);
            $valuesList[] = "$column = $value";
        }
        $valuesString = implode(', ', $valuesList);
        $sql = "UPDATE $this->table SET $valuesString WHERE id = $id;";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function find(int $id): array
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id;";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM $this->table WHERE id = $id;";
        return !!$this->pdo->query($sql);
    }
}