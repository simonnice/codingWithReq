<?php

// PDO Database class
// This is part of the refactor of CodingWithReq
// I'm starting with switching to prepared statements
// Through the use of PDO and a Database class

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $pdoInstance;
    private $stmt;
    private $error;
}
