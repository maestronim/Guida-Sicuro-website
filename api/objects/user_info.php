<?php
class UserInfo{

  // database connection and table name
  private $conn;
  private $table_name = "users";

  // object properties
  public $username;
  public $password;
  public $email;

  // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
  }

  // create user
  function create(){
    // query to insert record
    $query = "INSERT INTO
    " . $this->table_name . "
    SET
    username=:username, password=:password, email=:email";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->email=htmlspecialchars(strip_tags($this->email));

    // bind values
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":email", $this->email);

    // execute query
    if($stmt->execute()){
      return true;
    }

    return false;
  }

  function login() {
    $query = "SELECT username, email, password FROM users WHERE username=:username";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->username=htmlspecialchars(strip_tags($this->username));

    // bind values
    $stmt->bindParam(":username", $this->username);

    // execute query
    $stmt->execute();

    return $stmt;
  }

  function check() {
    $query = "SELECT * FROM users WHERE username=:username";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->username=htmlspecialchars(strip_tags($this->username));

    // bind values
    $stmt->bindParam(":username", $this->username);

    // execute query
    $stmt->execute();

    return $stmt;
  }
}
?>
