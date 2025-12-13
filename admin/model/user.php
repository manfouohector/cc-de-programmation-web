<?php 
    require_once 'database.php';

    class UserDB {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function  create($nom ,$prenom,$sexe,$adresse,$tel) {
            $sql = "insert into client set nom=?,adresseClient=?,Tel=?,PrenomClt=?,sexe=?";
            $params = array($nom,$adresse,$tel,$prenom,$sexe);
            $this->db->prepareSQL($sql,$params);
        }

        public function read() {
            $sql = "select * 
                    from client";
            $req = $this->db->prepareSQL($sql);
            return $this->db->GetDatas($req,false);
        }

         public function readone($id) {
            $sql = "select * 
                    from client
                    where id=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->GetDatas($req,true);
        }

        public function delete($id) {
            $sql = "delete 
                    from client
                    where id=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
        }

        public function update($id,$nom ,$prenom,$sexe,$adresse,$tel) {
            $sql = "delete 
                    from client
                    set nom=?,prenom=?,sex=?,adresse=?,tel=?
                    where id=?";
            $params = array($id,$nom ,$prenom,$sexe,$adresse,$tel);
            $req = $this->db->prepareSQL($sql,$params);
        }

        public function getconnexion($email,$password){
            $sql = "select *
                    from client
                    where email=? and password=?";
            $params = array($email,$password);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->GetDatas($req,false);
        }

    }
?>