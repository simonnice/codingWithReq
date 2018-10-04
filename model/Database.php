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

    public function __construct() {
        // Set Data Source Name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try {
            $this->pdoInstance = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    // method to prepare a statement with query to the database
    public function prepareStatementWithQuerytoDb($sql) {
        $this->stmt = $this->pdoInstance->prepare($sql);
    }

    // Adding a method to bind the values to the placeholders in the prepared statement
    public bindValuesToPlaceholdeValues($phValue, $value, $type = null) {
        if(is_null($type)) {
            switch(true){
                case is_int($value)
                $type = PDO::PARAM_INT;
                break;

                case is_bool($value)
                $type = PDO::PARAM_BOOL;
                break;

                
            }
        }
    }


}
