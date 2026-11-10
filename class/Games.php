<?php
    require_once 'Db.php';

    class Games{
        private $db;
        public function __construct(){
            $this->db = (new Db())->conn;
        }
        public function getAllGames(){
            $stmt = $this->db->query("SELECT * FROM games");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getGamebyId($id){
            $stmt = $this->db->prepare("SELECT * FROM games WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function addGame($title,$platform,$genre,$stock){
            $stmt = $this->db->prepare("INSERT INTO games(title,platform,genre,stock) 
                                        VALUES(?,?,?,?)");
            return $stmt->execute([$title,$platform,$genre,$stock]);
        }
        public function delGame($id){
            $stmt = $this->db->prepare("DELETE FROM games WHERE id = ?");
            return $stmt->execute([$id]);
        }
        public function updateGame($id,$title,$platform,$genre,$stock){
            $stmt = $this->db->prepare("UPDATE games 
                                        SET title = ?,platform = ?,genre = ?,stock = ?
                                        WHERE id = ?");
            return $stmt->execute([$title,$platform,$genre,$stock,$id]);
        }
        public function updateStock($id,$stock){
            $stmt = $this->db->prepare("UPDATE games SET stock = ? WHERE id = ?");
            return $stmt->execute([$stock,$id]);
        }
    }
?>