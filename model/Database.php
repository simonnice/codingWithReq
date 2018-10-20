<?php

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

    public function executeStatement(): bool {
        return $this->stmt->execute();
    }

    public function retrieveSingleObject() {
        $this->executeStatement();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function retrieveMultipleObjects() {
        $this->executeStatement();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function checkIfEntryExists(): int {
        return $this->stmt->rowCount();
    }

    public function doesUserExist($userName): bool {
        $this->prepareStatementWithQuerytoDb('SELECT * FROM user WHERE name = :name');

        $this->bindValuesToPlaceholder(':name', $userName);

        $row = $this->retrieveSingleObject();

        if ($this->checkIfEntryExists() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function doesInputUserMatchDbUser($username, $password): bool {

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

    public function getUserIdFromDB($userName): int {
        $this->prepareStatementWithQuerytoDb('SELECT * FROM user WHERE name = :name');
        $this->bindValuesToPlaceholder(':name', $userName);

        $row = $this->retrieveSingleObject();

        return $row->id;
    }

    public function registerNewUser($validatedRegisterInput): bool {

        $this->data = $validatedRegisterInput;

        $hashedPassword = password_hash($this->data->getPassword(), PASSWORD_DEFAULT);

        $this->prepareStatementWithQuerytoDb('INSERT INTO user (name, password) VALUES (:name, :password)');

        $this->bindValuesToPlaceholder(':name', $this->data->getUserName());
        $this->bindValuesToPlaceholder(':password', $hashedPassword);

        if ($this->executeStatement()) {
            return true;
        } else {
            return false;
        }

    }

    public function createNewPost($validatedPostInput): bool {
        $this->data = $validatedPostInput;

        $this->prepareStatementWithQuerytoDb('INSERT INTO posts(title, user_id, body) VALUES (:title, :user_id, :body)');

        $this->bindValuesToPlaceholder(':title', $this->data->getTitle());
        $this->bindValuesToPlaceholder(':user_id', $this->data->getUserId());
        $this->bindValuesToPlaceholder(':body', $this->data->getBody());

        if ($this->executeStatement()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($userId, $postId) {
        $this->prepareStatementWithQuerytoDb('DELETE FROM posts WHERE user_id = :user_id AND id = :id ');

        $this->bindValuesToPlaceholder(':user_id', $userId);
        $this->bindValuesToPlaceholder(':id', $postId);

        if ($this->executeStatement()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPosts($id): array{
        $this->prepareStatementWithQuerytoDb('SELECT * FROM posts WHERE user_id = :userId');

        $this->bindValuesToPlaceholder(':userId', $id);

        $result = $this->retrieveMultipleObjects();

        return $result;
    }

}
