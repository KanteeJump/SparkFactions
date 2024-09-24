<?php

declare(strict_types=1);

namespace kanteejump\database;

use kanteejump\SparkFactions;
use PDO;

class ProfileDataBase
{
    private PDO $pdo;

    public function __construct()
    {
        $file = SparkFactions::getInstance()->getDataFolder() . "profiles.db";

        if (!file_exists($file)) {
            touch($file);
        }

        $this->pdo = new PDO("sqlite:" . $file);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
