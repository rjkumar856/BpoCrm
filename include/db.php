<?php
class Database1
{
    private $db_name = "demo_bpo";
    private $username = "demo_users";
    private $password = "D-cku%OGoG&s";
    public $conn;

    public function dbConnection()
    {

        $this->conn = null;    
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

class USER1{
    private $conn;
    public function __construct()
    {
        $database = new Database1();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    
    public function lasdID()
    {
        $stmt = $this->conn->lastInsertId();
        return $stmt;
    }
}
?>