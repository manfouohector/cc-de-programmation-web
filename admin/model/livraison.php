<?php 
    require_once 'database.php';

    class livraisonDB {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function  create($status,$fraisLivraison,$dateLivraison) {
            $sql = "insert into livraison set status=?,fraisLivraison=?,dateLivraison=?";
            $params = array($status,$fraisLivraison,$dateLivraison);
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

        public function update($status,$fraisLivraison,$dateLivraison) {
            $sql = "delete 
                    from livraison
                    set status=?,fraisLivraison=?,dateLivraison=?
                    where id=?";
            $params = array($status,$fraisLivraison,$dateLivraison);
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