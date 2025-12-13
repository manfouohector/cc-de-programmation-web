<?php 
    require_once 'database.php';

    class PoductDB {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function  create($nom ,$prenom,$sexe,$adresse,$tel) {
            $sql = "insert into produit set nom=?,adresseproduit=?,Tel=?,PrenomClt=?,sexe=?";
            $params = array($nom,$adresse,$tel,$prenom,$sexe);
            $this->db->prepareSQL($sql,$params);
        }

        public function read() {
            $sql = "select * 
                    from produit";
            $req = $this->db->prepareSQL($sql);
            return $this->db->GetDatas($req,false);
        }

         public function readone($id) {
            $sql = "select * 
                    from produit
                    where id=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->GetDatas($req,true);
        }

        public function delete($id) {
            $sql = "delete 
                    from produit
                    where id=?";
            $params = array($id);
            $this->db->prepareSQL($sql,$params);
        }

        public function update($id,$nom ,$prenom,$sexe,$adresse,$tel) {
            $sql = "delete 
                    from produit
                    set nom=?,prenom=?,sex=?,adresse=?,tel=?
                    where id=?";
            $params = array($id,$nom ,$prenom,$sexe,$adresse,$tel);
            $req = $this->db->prepareSQL($sql,$params);
        }

        public function countProduct($id) {
            $sql = "select count(*)
                    from produit";
            $req = $this->db->prepareSQL($sql);
            return $this->db->GetDatas($req,true);      
        }

    }
?>