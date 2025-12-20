<?php
require_once 'database.php';

    class LivreurDB {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function  create($nom_lv ,$prenom_lv,$tel,$statut) {
        $sql = "insert into livreur set nom_lv=?,Tel=?,PrenomLvr=?,statut=?";
        $params = array($nom_lv,$tel,$prenom_lv,$statut);   
        $this->db->prepareSQL($sql,$params);
    }

    public function read() {
        $sql = "select * 
                from livreur";
        $req = $this->db->prepareSQL($sql);
        return $this->db->GetDatas($req,false);
    }

     public function readone($id) {
        $sql = "select * 
                from livreur
                where id=?";
        $params = array($id);
        $req = $this->db->prepareSQL($sql,$params);
        return $this->db->GetDatas($req,true);
    }

    public function delete($id) {
        $sql = "delete 
                from livreur
                where id=?";
        $params = array($id);
        $this->db->prepareSQL($sql,$params);
    }

    public function update($id,$nom_lv ,$prenom_lv,$tel,$statut) {
        $sql = "update 
                livreur
                set nom_lv=?,prenom_lv=?,tel=?,statut=?
                where id=?";
        $params = array($nom_lv ,$prenom_lv,$tel,$statut,$id);
        $this->db->prepareSQL($sql,$params);
    }
    public function countlivreur() {
        $sql = "select count(*)
                from livreur";
        $req = $this->db->prepareSQL($sql);
        return $this->db->GetDatas($req,true);      
    }
}

?>