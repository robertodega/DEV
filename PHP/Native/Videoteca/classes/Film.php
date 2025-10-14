<?php
    class Film{
        private $conn;
        private $table = 'film';

        public function __construct($conn){
            $this->conn = $conn;
            $this->conn->exec("USE ".DB_NAME."");
        }

        public function getAllFilms(){

            try{
                $query = 'SELECT * FROM '.$this->table.' ORDER BY id DESC';
                $stmt = $this->conn->prepare($query);
                if (!$stmt->execute()) {
                    throw new Exception("Database query failed: " . implode(", ", $stmt->errorInfo()));
                }
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                return "PDO Esception: ".$e->getMessage()."";
            }

        }

        public function addFilm($title, $author, $year, $genre){
            $query = "INSERT INTO " . $this->table . " (title, author, year, genre) VALUES (:title, :author, :year, :genre)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':genre', $genre);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function updateFilm($id, $title, $author, $year, $genre){
            $query = "UPDATE " . $this->table . " SET title = :title, author = :author, year = :year, genre = :genre WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':genre', $genre);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function deleteFilm($id){
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function searchFilm($title){
            $query = "SELECT * FROM " . $this->table . " WHERE title LIKE :title";
            $stmt = $this->conn->prepare($query);
            $title = "%$title%";
            $stmt->bindParam(':title', $title);
            $stmt->execute();
            #   return $stmt;
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getFilmCount(){
            $query = "SELECT COUNT(*) as count FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        }
        public function getFilmByTitle($title){
            $query = "SELECT * FROM " . $this->table . " WHERE title = :title";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getFilmByGenre($genre){
            $query = "SELECT * FROM " . $this->table . " WHERE genre = :genre";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':genre', $genre);
            $stmt->execute();
            #   return $stmt;
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getFilmByAuthor($author){
            $query = "SELECT * FROM " . $this->table . " WHERE author = :author";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':author', $author);
            $stmt->execute();
            #   return $stmt;
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }