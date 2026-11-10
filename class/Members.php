<?php
    require_once 'Db.php';

    class Members{
        private $db;

        public function __construct(){
            $this->db = (new Db())->conn;
        }
        public function getAllMembers(){
            $stmt = $this->db->query("SELECT * FROM members");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getMemberByid($id){
            $stmt = $this->db->prepare("SELECT * FROM members WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function addMember($nickname,$email,$phone){
            $stmt = $this->db->prepare("INSERT INTO members(nickname,email,phone)
                                        VALUES (?,?,?)");
            return $stmt->execute([$nickname,$email,$phone]);
        }
        public function delMember($id){
            $stmt = $this->db->prepare("DELETE FROM members WHERE id = ?");
            return $stmt->execute([$id]);
        }
        public function updateMember($id,$nickname,$email,$phone){
            $stmt = $this->db->prepare("UPDATE members 
                                        SET nickname = ?,email = ?,phone = ? WHERE id = ?");
            return $stmt->execute([$nickname,$email,$phone,$id]);
        }
    }
?>