<?php

include_once "database.php";

class CommandeDB{
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($adresse_cmd,$statut_cmd,$adresseLiv,$statut) {
        $sql = "insert into commande set adresse_cmd=?,statut_cmd=?,adresseLiv=?,statut=?";
        $params = array( $adresse_cmd,$statut_cmd,$adresseLiv,$statut);
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
        $this->db->prepareSQL($sql,$params);
    }

    public function update($adresse_cmd,$statut_cmd,$adresseLiv,$statut) {
        $sql = "update 
                commande
                set adresse_cmd=?,statut_cmd=?,adresseLiv=?,statut=?
                where id=?";
        $params = array( $adresse_cmd,$statut_cmd,$adresseLiv,$statut);
        $this->db->prepareSQL($sql,$params);
    }
    public function countcmd() {
        $sql = "select count(*)
                from commande";
        $req = $this->db->prepareSQL($sql);
        return $this->db->GetDatas($req,true);      
    }
}
?>