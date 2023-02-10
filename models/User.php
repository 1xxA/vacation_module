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

    public function read_single() {
        $query = 'SELECT id, name, vacation_days FROM ' . $this->table . ' WHERE id=:id LIMIT 1;';

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->vacation_days = $row['vacation_days'];

    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id=:id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        } 

        printf("Error: %s.\n", $stmt->error);
        return false;

    }

}