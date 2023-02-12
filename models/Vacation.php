<?php

class Vacation {
    private $conn;
    private $table;

    public $id;
    public $user_id;
    public $date_start;
    public $date_end;
    public $days_of_vacation;

    public function __construct($conn, $table) {
        $this->conn = $conn;
        $this->table = $table;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ';';
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single() {
        $query = 'SELECT id, user_id, date_start, date_end FROM ' . $this->table . ' WHERE id=:id LIMIT 1;';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->user_id = $row['user_id'];
        $this->date_start = $row['date_start'];
        $this->date_end = $row['date_end'];

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
        $query = 'INSERT INTO ' . $this->table . ' (user_id, date_start, date_end) VALUES (:user_id, :date_start, :date_end);';
        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->date_start = htmlspecialchars(strip_tags($this->date_start));
        $this->date_end = htmlspecialchars(strip_tags($this->date_end));

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':date_start', $this->date_start);
        $stmt->bindParam(':date_end', $this->date_end);

        if($stmt->execute()) {
            return true;
        } 
        printf("Error: %s.\n", $stmt->error);
        return false;

    }

    public function count_days_of_vacation() {
        $query = 'SELECT user_id, SUM(DATEDIFF(date_end, date_start)) as days_of_vacation 
        FROM ' . $this->table . ' WHERE user_id = :user_id GROUP BY user_id;';

        $stmt = $this->conn->prepare($query);
        
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bindParam(':user_id', $this->user_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        

        $this->days_of_vacation = ($stmt->rowCount() === 1) ? $row['days_of_vacation'] : 0;

    }

}