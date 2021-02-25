<?php


namespace App\Providers;


use PDO;

class Database
{
    protected $connection;

    protected $statement;

    public function __construct()
    {
        $config = require('../app/config/database.php');
        $driver = $config['connection'];
        $config = $config[$driver];

        try {
            $this->connection = new PDO($driver . ':host=' . $config['HOST'] . ';dbname=' . $config['DB_NAME'], $config['USERNAME'], $config['PASSWORD']);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    private function getConnection()
    {
        return $this->connection;
    }

    protected function prepare($query)
    {
        $this->statement = $this->getConnection()->prepare($query);

        return $this;
    }

    protected function execute()
    {
        $this->statement->execute();

        return $this;
    }

    protected function fetchAll()
    {
        return $this->statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    protected function setFetchMode($option, $class)
    {
        $this->statement->setFetchMode($option, $class);

        return $this;
    }

    protected function fetch()
    {
        return $this->statement->fetch();
    }
}