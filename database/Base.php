<?php

class Base {
  const HOST = "localhost";
  const DB_USERNAME = "root";
  const DB_PASSWORD = "";
  const DB_NAME = "polovni_automobili";
  const PORT = 4306;

  protected $conn;

  public function __construct() {
    $this->conn = mysqli_connect(self::HOST, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME, self::PORT);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function query($sql) {
    return $this->conn->query($sql);
  }

  public function prepare($sql) {
    return $this->conn->prepare($sql);
  }
}

?>