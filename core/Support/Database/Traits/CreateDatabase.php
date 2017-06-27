<?php

namespace Pluma\Support\Database\Traits;

use Illuminate\Support\Facades\DB;
use PDO;

trait CreateDatabase
{
    protected $database;

    protected $db;

    public function db($database, $username, $password)
    {
        $this->database = $database;

        $connection = config('DB_CONNECTION', env('DB_CONNECTION'));
        $host = config('DB_HOST', env('DB_HOST'));
        // $user = config('DB_USERNAME', env('DB_USERNAME', $username));
        // $password = config('DB_PASSWORD', env('DB_PASSWORD', $password));
        $this->db = new PDO("{$connection}:host={$host}", $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this;
    }

    public function drop()
    {
        $dbname = "`".str_replace("`","``",$this->database)."`";
        $this->db->query("DROP DATABASE IF EXISTS $dbname");

        return$this;
    }

    public function make()
    {
        $dbname = "`".str_replace("`","``",$this->database)."`";
        $q = $this->db->prepare("CREATE DATABASE :schema");
        $this->db->query("CREATE DATABASE IF NOT EXISTS $dbname");
        $this->db->query("USE $dbname");

        return $this;
    }
}
