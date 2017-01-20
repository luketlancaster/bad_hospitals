<?php

namespace BadHospitals;

require __DIR__ . '/../vendor/autoload.php';

use ParagonIE\EasyDB\Factory;

class DatabaseStorage
{
    private $db;
    
    public function __construct(
        $dsn,
        $username,
        $password
    )
    {
        $this->db = Factory::create(
            $dsn,
            $username,
            $password
        );
    }

    public function get() {
        return $this->db;
    }

}
