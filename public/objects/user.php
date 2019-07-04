<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $fullname;
    public $username;
    public $password;
    public $type;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // search products
    function search($keywords){
    
        // select all query
        $query = "SELECT u.id,	u.fullname,	u.username,	u.password  FROM
                    " . $this->table_name . " u
                WHERE
                    u.fullname LIKE ? OR u.username LIKE ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function searchById(){
        // query to read single record
        $query = "SELECT * FROM
                    " . $this->table_name . " u
                WHERE
                    u.id = ?
                LIMIT
                    0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
        //if there is a record then return true
        if ( $stmt->rowCount() == 1 ){
            return true;
        }
        return false;

    }

    // read products
    function readAll(){
    
        // select all query
        $query = "SELECT * FROM  " . $this->table_name;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // used when filling up the update product form
    function verifyUserAndPass(){
    
        // query to read single record
        $query = "SELECT * FROM
                    " . $this->table_name . " u
                WHERE
                    u.username = ? AND  u.password = ? ";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);

        // execute query
        $stmt->execute();

        //if there is a record then return true
        if ( $stmt->rowCount() == 1 ){
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row["id"];
            $this->fullname = $row["fullname"];
            $this->type = $row["type"];
            return true;
        }
        return false;
    }


    // create user - by default is a normal user
    function create(){
    
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " (fullname, username, password, type)
                    VALUES( :fullname, :username, :password, 'user')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize "desinfectar"
        $this->fullname=htmlspecialchars(strip_tags($this->fullname));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
    
        // bind values
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
    
        // execute query
        if($stmt->execute()){
            return true;
        }    
        return false;
        
    }

    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET 
                    fullname=:fullname, username=:username, password=:password
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize "desinfectar"
        $this->fullname=htmlspecialchars(strip_tags($this->fullname));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind values
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":id", $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    /*
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    */
}