<?php

// PDO Database class
// This is part of the refactor of CodingWithReq
// I'm starting with switching to prepared statements
// Through the use of PDO and a Database class
namespace model;

use PDO;

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $pdoInstance;
    private $stmt;
    private $error;
    private $session;

    public function __construct($session) {
        // Set Data Source Name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        $this->session = $session;
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

    // Adding a method to bind the values to the placeholder parameters in the prepared statement
    public function bindValuesToPlaceholder($phParam, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($phParam, $value, $type);
    }

    // Adding an execute method to execute the prepared statement

    public function executeStatement() {
        return $this->stmt->execute();
    }

    // Adding a method for retrieving a single object from DB

    public function retrieveSingleObject() {
        $this->executeStatement();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Adding a method to check for entries in DB
    public function checkIfEntryExists() {
        return $this->stmt->rowCount();
    }

    public function doesUserExist($userName) {
        $this->prepareStatementWithQuerytoDb('SELECT * FROM user WHERE name = :name');

        $this->bindValuesToPlaceholder(':name', $userName);

        $row = $this->retrieveSingleObject();

        if ($this->checkIfEntryExists() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function doesInputUserMatchDbUser($username, $password) {

        $this->prepareStatementWithQuerytoDb('SELECT * FROM user WHERE name = :name');
        $this->bindValuesToPlaceholder(':name', $username);

        if ($this->doesUserExist($username)) {
            $row = $this->retrieveSingleObject();
            $hashedPassword = $row->password;
        } else {
            return false;
        }

        if (password_verify($password, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }

    public function registerNewUser($validatedRegisterInput) {

        $this->data = $validatedRegisterInput;

        // Hashing password
        $hashedPassword = password_hash($this->data->getPassword(), PASSWORD_DEFAULT);

        // Register the user
        $this->prepareStatementWithQuerytoDb('INSERT INTO user (name, password) VALUES (:name, :password)');

        // Bind the values
        $this->bindValuesToPlaceholder(':name', $this->data->getUserName());
        $this->bindValuesToPlaceholder(':password', $hashedPassword);

        // Execute the statement

        if ($this->executeStatement()) {
            return true;
        } else {
            return false;
        }

    }

    public function createNewPost($validatedPostInput) {
        $this->data = $validatedPostInput;

        $this->prepareStatementWithQuerytoDb('INSERT INTO posts(title, userId, body) VALUES (:title, :userId, :body)');

        $this->bindValuesToPlaceholder(':title', $this->data->getTitle());
        $this->bindValuesToPlaceholder(':userId', $this->data->getUserId());
        $this->bindValuesToPlaceholder(':body', $this->data->getBody());

        if ($this->executeStatement()) {
            return true;
        } else {
            return false;
        }
    }

}
