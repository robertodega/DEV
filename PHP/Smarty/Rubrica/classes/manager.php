<?php
class Manager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getData($table, $searchText = '')
    {
        $query = "SELECT * FROM $table";
        if ($searchText != 'everything') {
            $query .= " WHERE subject LIKE :searchText OR username LIKE :searchText OR password LIKE :searchText";
        }
        $stmt = $this->conn->prepare($query);
        if ($searchText != 'everything') {
            $searchText = '%' . $searchText . '%';
            $stmt->bindParam(':searchText', $searchText);
        }
        
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching data: " . $e->getMessage());
        }
    }

    public function addData($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        try {
            $stmt = $this->conn->prepare($query);
            foreach ($data as $key => &$value) {
                $stmt->bindParam(":$key", $value);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error adding data: " . $e->getMessage());
        }
    }

    public function getDataByValue($table, $value)
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new Exception("Invalid table name.");
        }
        $query = "SELECT * FROM `$table` WHERE subject LIKE :value OR username LIKE :value OR password LIKE :value";
        try {
            $stmt = $this->conn->prepare($query);
            $searchValue = '%' . $value . '%';
            $stmt->bindParam(':value', $searchValue, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching data by value: " . $e->getMessage());
        }
    }

    public function deleteData($table, $id)
    {
        $query = "DELETE FROM $table WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error deleting data: " . $e->getMessage());
        }
    }

    public function updateData($table, $id, $data)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE $table SET $set WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($query);
            foreach ($data as $key => &$value) {
                $stmt->bindParam(":$key", $value);
            }
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error updating data: " . $e->getMessage());
        }
    }

}
