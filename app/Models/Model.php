<?php

namespace App\Models;


use App\Providers\Database;
use PDO;

class Model extends Database
{
    protected $table;

    public static function all()
    {
        return self::getModelInstance()->prepare('SELECT * FROM ' . self::getModelInstance()->table)
            ->execute()
            ->fetchAll();
    }

    public function get($columns = ['*'])
    {
        return self::getModelInstance()->prepare('SELECT ' . implode(',', $columns) . ' FROM ' . self::getModelInstance()->table)
            ->execute()
            ->fetchAll();
    }

    public static function find($id)
    {
        try {
            $query = self::getModelInstance()->prepare('SELECT * FROM ' . self::getModelInstance()->table . ' WHERE id=' . $id)
                ->setFetchMode(PDO::FETCH_CLASS, static::class)
                ->execute()
                ->fetch();

            if ( ! $query) {
                throw new \Exception("No query results for model [" . static::class . "]");
            }

            return $query;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    private function getModelInstance()
    {
        return (new static());
    }
}