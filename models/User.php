<?php

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $name;
    public $vacation_days;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ';';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;

    }



}