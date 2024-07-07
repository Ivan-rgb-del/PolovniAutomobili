<?php

class Base {
  // KONSTANTE
  const HOST = "localhost";
  const DB_USERNAME = "root";
  const DB_PASSWORD = "";
  const DB_NAME = "polovni_automobili";
  const PORT = 4306;

  // ATRIBUTI
  public $conn;

  // KONSTRUKTOR
  public function __construct() {
    $this->conn = mysqli_connect(self::HOST, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME, self::PORT);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }
}

?>