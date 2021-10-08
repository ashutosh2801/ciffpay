<?php
class DB {

  private $host = 'localhost';
  private $dbname = 'ciffi';
  private $username = 'root';
  private $password = '';
  private $conn;
  
    public function __construct() {
      $this->connect();
    }

    private function connect()  {
      try  {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_errno) {
          throw new Exception("Failed to connect to MySQL: " . $conn->connect_error);
        }
      }
      catch(Exception $e) {
        echo $e->getMessage();
      }
    }

    public function query($sql) {
      return  $this->conn->query($sql);
    }

    public function single_row($tbl, $where) {
      $sql = "SELECT * FROM $tbl";
      if($where) {
        $sql.= " WHERE $where";
      }
      $query = $this->conn->query($sql);
      return $query->fetch_assoc();
    }

    public function multiple_row($tbl, $where) {
      $sql = "SELECT * FROM $tbl";
      if($where) {
        $sql.= " WHERE $where";
      }
      $query = $this->conn->query($sql);
      return $query->fetch_all();
    }

    private function close() {
      $this->conn->close();
    }
}
?>