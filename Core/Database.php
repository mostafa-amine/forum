<?php

namespace Core;

use PDO;
use Core\Response;

class Database
{
    public PDO $connection;
    public $statement;

    public function __construct(array $config)
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        $this->connection = new PDO(dsn: $dsn, options: [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query(string $query, array $params = null)
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function find(): ?array
    {
        return $this->statement->fetch();
    }

    public function findOrFail(): array
    {
        $result = $this->statement->fetch();

        if (!$result) {
            abort(Response::NOT_FOUND);
        }

        return $result;
    }

    public function all(): array
    {
        return $this->statement->fetchAll();
    }
}
