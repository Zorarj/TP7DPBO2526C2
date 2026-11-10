<?php
    require_once 'Db.php';
    require_once 'Games.php';

    class Rentals{
        private $db;
        public function __construct(){
            $this->db = (new Db())->conn;
        }
        public function getAllRental(){
            $stmt = $this->db->query("SELECT rentals.*,members.nickname,games.title
                                    FROM rentals
                                    INNER JOIN members ON rentals.member_id = members.id
                                    INNER JOIN games ON rentals.game_id = games.id");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);   
        }
        public function delRental($id){
        $rental = $this->db->query("SELECT game_id, return_date FROM rentals WHERE id = $id")->fetch();
        
        if (!$rental['return_date']) {
            $game = new Games();
            $gameInfo = $this->db->query("SELECT stock FROM games WHERE id = {$rental['game_id']}")->fetch();
            $game->updateStock($rental['game_id'], $gameInfo['stock'] + 1);
        }
        
        $stmt = $this->db->prepare("DELETE FROM rentals WHERE id = ?");
        return $stmt->execute([$id]);
    }
        public function rentGame($member_id,$game_id){
            $stmt = $this->db->prepare("INSERT INTO rentals(member_id,game_id,rent_date)
            VALUES(?,?,CURDATE())");
            $game = new Games();
            $gameInfo = $this->db->query("SELECT stock FROM games WHERE id = $game_id")->fetch();
            if($gameInfo['stock'] > 0){
                $game->updateStock($game_id,$gameInfo['stock'] - 1);
                return $stmt->execute([$member_id,$game_id]);
            }
            return false;    
        }
        public function returnGame($rental_id){
            $stmt = $this->db->prepare("UPDATE rentals SET return_date = CURDATE() WHERE id = ?");
            $rental = $this->db->query("SELECT game_id FROM rentals WHERE id = $rental_id")->fetch();
            $game = new Games();
            $gameInfo = $this->db->query("SELECT stock FROM games WHERE id = {$rental['game_id']}")->fetch();
            $game->updateStock($rental['game_id'],$gameInfo['stock'] + 1);
            return $stmt->execute([$rental_id]);
        }
    }
?>