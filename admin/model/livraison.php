<?php 
    require_once 'database.php';

    class livraisonDB {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function  create($nom ,$prenom,$sexe,$adresse,$tel) {
            $sql = "insert into livraison set nom=?,adresselivraison=?,Tel=?,PrenomClt=?,sexe=?";
            $params = array($nom,$adresse,$tel,$prenom,$sexe);
            $this->db->prepareSQL($sql,$params);
        }

        public function read() {
            $sql = "select * 
                    from livraison";
            $req = $this->db->prepareSQL($sql);
            return $this->db->GetDatas($req,false);
        }

         public function readone($id) {
            $sql = "select * 
                    from livraison
                    where id=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->GetDatas($req,true);
        }

        public function delete($id) {
            $sql = "delete 
                    from livraison
                    where id=?";
            $params = array($id);
            $this->db->prepareSQL($sql,$params);
        }

        public function update($id,$nom ,$prenom,$sexe,$adresse,$tel) {
            $sql = "delete 
                    from livraison
                    set nom=?,prenom=?,sex=?,adresse=?,tel=?
                    where id=?";
            $params = array($id,$nom ,$prenom,$sexe,$adresse,$tel);
            $this->db->prepareSQL($sql,$params);
        }

        public function countlivraison($id) {
            $sql = "select count(*)
                    from livraison";
            $req = $this->db->prepareSQL($sql);
            return $this->db->GetDatas($req,true);      
        }
    }
?>