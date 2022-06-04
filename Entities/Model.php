<?php

namespace Entities;

use Exceptions\NotFoundException;

abstract class Model
{
    const TABLE = '';
    public int $id;


    public static function findEach(): iterable
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $sql = 'SELECT * FROM ' . static::TABLE;
        return $database->queryEach($sql, static::class, []);
    }

    public static function findAll(): array
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $sql = 'SELECT * FROM ' . static::TABLE;
        return $database->query($sql, static::class, []);
    }

    public static function getById(int|null $id): static|null
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $substitution = [':id' => $id];
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
        $array = $database->query($sql, static::class, $substitution);
        if (!empty($array)) {
            return $array[0];
        }
        if (empty($array) && static::class == 'Entities\News') {
            throw new NotFoundException();
        }
        if (empty($array) && static::class == 'Entities\Author') {
            return null;
        }
    }

    public function isnew(): bool
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $substitution = [':heading' => $this->heading];
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE heading = :heading';
        $array = $database->query($sql, static::class, $substitution);
        if ($array == null) {
            return false;
        }
        if ($array != null) {
            return true;
        }
    }

    public static function deleteById(int $id): bool
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $substitution = [':id' => $id];
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';
        $database->execute($sql, $substitution);
        return true;
    }

    public function insert(): bool
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $keys = [];
        $preparation = [];
        $substitutions = [];

        foreach ($this as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $keys[] = $key;
            $preparation[] = ':' . $key;
            $substitutions[':' . $key] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE
            . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $preparation) . ')';

        $database->execute($sql,  $substitutions);

        $sql = 'SELECT *
        FROM ' . static::TABLE .
            ' ORDER BY id DESC
        LIMIT 1';

        $array = $database->query($sql, static::class, []);
        $this->id = $array[0]->id;
        return true;
    }

    public function update(): bool
    {
        $config = Config::make();
        $database = DataBase::make($config->dsn, $config->login, $config->password);

        $keys = [];
        $preparation = [];
        $substitutions = [];

        foreach ($this as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $keys[] = $key;
            $preparation[] = $key . '= :' . $key;
            $substitutions[':' . $key] = $value;
        }

        $sql = 'UPDATE ' .  static::TABLE . ' SET ' . implode(', ', $preparation) . ' WHERE  `id`=' . $this->id;
        $database->execute($sql,  $substitutions);
        return true;
    }

    public function edit(array $info): void
    {
        foreach ($info as $key => $value) {
            $this->$key = $value;
        }
        $this->update();
        echo 'your record is successfully saved!';
    }
}
