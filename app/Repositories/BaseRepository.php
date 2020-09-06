<?php

namespace App\Repositories;

use Illuminate\Database\Connection;

abstract class BaseRepository
{
    protected Connection $connection;
    protected string $table;

    /**
     * BaseRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
