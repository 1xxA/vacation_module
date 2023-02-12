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

    public function add() {
        $query = 'INSERT INTO ' . $this->table . ' (name, vacation_days) VALUES (:name, :vacation_days);';
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->vacation_days = htmlspecialchars(strip_tags($this->vacation_days));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':vacation_days', $this->vacation_days);

        if($stmt->execute()) {
            return true;
        } 
        printf("Error: %s.\n", $stmt->error);
        return false;

    }


    public function update() {
        $query = 'UPDATE ' . $this->table . 
        ' SET name=:name,
            vacation_days=:vacation_days 
            WHERE id=:id;';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->vacation_days = htmlspecialchars(strip_tags($this->vacation_days));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':vacation_days', $this->vacation_days);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;


        
    }




}