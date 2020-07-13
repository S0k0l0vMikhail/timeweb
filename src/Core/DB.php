<?php

namespace App\Core;

/**
 * Класс подключения к БД
 */
class DB
{
    private $server = 'database:3306';
    private $dbName = 'timeweb';
    private $username = 'timeweb';
    private $pwd = 'timeweb';

    private static $db; // в данном свойстве будем хранить объект DB класса
    private $connection;

    private function __construct()
    {
        $dsn = "mysql:dbname=$this->dbName;host=$this->server;charset=UTF8";
        try {
            $this->connection = new \PDO($dsn, $this->username, $this->pwd);
        } catch (\PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }

    public static function getDB()
    {
        if (self::$db == null) self::$db = new DB();
        return self::$db;
    }

    public function getAll($sql)
    {
        $statement = $this->connection->query($sql);
        if (!$statement) return false;
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function nonSelectQuery($sql, $params)
    {
        $statement = $this->connection->prepare($sql);
        if (!$statement) return false;
        return $statement->execute($params);
    }

    public function paramsGetAll($sql, $params)
    {
        $statement = $this->connection->prepare($sql);
        if (!$statement) return false;
        $statement->execute($params);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function paramsGetOne($sql, $params)
    {
        $statement = $this->connection->prepare($sql);
        if (!$statement) return false;
        $statement->execute($params);
        return $statement->fetch(\PDO::FETCH_ASSOC);
        //print_r($statement->fetch(\PDO::FETCH_ASSOC));
    }
}
