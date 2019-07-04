<?php
class Database{
 
    // specify your own database credentials
    private $host = "otto.db.elephantsql.com";
    private $db_name = "bwbasrvl";
    private $username = "bwbasrvl";
    private $password = "vu6dsTBKDpntng2xfxDm78VP5IZmvm4a";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>