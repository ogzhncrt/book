<?php

class Database {
    
    public $conn;

    /**
     * @author Oğuzhan Cerit
     * 
     * This function provides connection 
     * to the provide`and return the database object.
     *
     * @param no-param
     *
     * @since 0.0.1
     *
     */
    public function set_connection(){
  
        $this->conn = null;
  
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }


    private $host     = "localhost";
    private $db_name  = "bookapi";
    private $username = "root";
    private $password = "";
}

?>