<?php

define("DB_NAME", "testphp");
define("DB_HOSTNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

class Connection
{
    public $connect;

    public function __construct()
    {
        $this->connect = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);

        if ($this->createDB()) {
            mysqli_select_db($this->connect, DB_NAME);
            $this->createTBUser();
        }
    }

    public function createDB()
    {
        return mysqli_query($this->connect, "CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    }

    public function createTBUser()
    {
        $query = "CREATE TABLE IF NOT EXISTS user(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL UNIQUE,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL)";

        return mysqli_query($this->connect, $query);
    }
}

?>