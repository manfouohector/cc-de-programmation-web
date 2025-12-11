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
            $db->prepareSQL($sql,$params);
        }

        public function read() {
            $sql = "select * 
                    from client";
            $req = $db->prepareSQL($sql);
            return $db->GetDatas($req,true);
        }
    }
?>