<?php 
    class Database {

        private $dsn;
        private $userName;
        private $password;
        private $pdo;

        public function __construct() {
            $this->dsn = "mysql:host=localhost;dbname=venteBoisson;port=3308;charset=utf8";
            $this->userName = "root";
            $this->password = "";
        }

        public function connectTODb() {
            try {
                $pdo = new PDO($dsn,$userName,$password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                echo "connexon reusiir";
            } catch (Exception $ex) {
                die("Erreur ".$ex->getMessage());
            } 
            return $pdo;
        }

        public function prepareSQL($sql,$params = null) {
            $req = $this->connectTODb()->prepare($sql);
            if(is_null($req)) {
                $req->execute();
            } else {
                $req->execute($params);
            }
            return $req;
        }

        public function GetDatas($req,$one = true) {
            $datas = null;
            if($one == true) {
                $datas = $req->fetch();
            } else {
                $datas = $req->fetchAll();
            }

            return $datas;
        }
    }
?>