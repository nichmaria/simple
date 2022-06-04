<?php

namespace Entities;

use PDOException;
use Exceptions\DbException;

class DataBase
{
    public \PDO $dbh;
    public \PDOStatement|false $sth;
    public static DataBase|null $database = null;

    private function __construct()
    {
    }

    public static function make(string $dsn, string $login, string $password): DataBase
    {
        if (DataBase::$database == null) {
            $config = Config::make();
            DataBase::$database = new DataBase($config->dsn, $config->login, $config->password);
            try {
                DataBase::$database->dbh = new \PDO($dsn, $login, $password);
            } catch (PDOException $e) {
                throw new DbException('incorrect parameters for accessing the database');
            }
        }

        return DataBase::$database;
    }

    public function execute(string $sql, array $arr): bool
    {
        $this->sth = $this->dbh->prepare($sql);
        try {
            $this->sth->execute($arr);
        } catch (PDOException $e) {
            throw new DbException('incorrect query to the database');
        }

        return true;
    }

    public function query(string $sql, string $class, array $arr): array
    {
        $this->sth = $this->dbh->prepare($sql);
        try {
            $this->sth->execute($arr);
        } catch (PDOException $e) {
            throw new DbException('incorrect query to the database');
        }

        return $this->sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /*this method only for learning purposes - to apply a generator. then
    this method is used in Model's method FindAll */
    public function queryEach(string $sql, string $class, array $arr): iterable
    {
        $this->sth = $this->dbh->prepare($sql);
        try {
            $this->sth->execute($arr);
        } catch (PDOException $e) {
            throw new DbException('incorrect query to the database');
        }

        function generate($object, $class)
        {
            $object->sth->setFetchMode(\PDO::FETCH_CLASS, $class);
            while ($element = $object->sth->fetch()) {
                yield $element;
            }
        }

        return generate($this, $class);
    }
}
