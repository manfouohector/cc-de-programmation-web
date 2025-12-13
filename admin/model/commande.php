<?php 
    require_once 'database.php';

    class commandeDB {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function  create($nom ,$prenom,$sexe,$adresse,$tel) {
            $sql = "insert into commande set nom=?,adressecommande=?,Tel=?,PrenomClt=?,sexe=?";
            $params = array($nom,$adresse,$tel,$prenom,$sexe);
            $this->db->prepareSQL($sql,$params);
        }

        public function read() {
            $sql = "select * 
                    from commande";
            $req = $this->db->prepareSQL($sql);
            return $this->db->GetDatas($req,false);
        }

         public function readone($id) {
            $sql = "select * 
                    from commande
                    where id=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
            return $this->db->GetDatas($req,true);
        }

        public function delete($id) {
            $sql = "delete 
                    from commande
                    where id=?";
            $params = array($id);
            $req = $this->db->prepareSQL($sql,$params);
        }

        public function update($id,$nom ,$prenom,$sexe,$adresse,$tel) {
            $sql = "delete 
                    from commande
                    set nom=?,prenom=?,sex=?,adresse=?,tel=?
                    where id=?";
            $params = array($id,$nom ,$prenom,$sexe,$adresse,$tel);
            $this->db->prepareSQL($sql,$params);
        }

        public function countCommande($id) {
            $sql = "select count(*)
                    from commande";
            $req = $this->db->prepareSQL($sql);
            return $this->db->GetDatas($req,true);      
        }
    }
?>