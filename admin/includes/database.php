<?php

require_once('new_config.php');

class Database {

  public $connection;

  function __construct() {
    $this->open_db_connection();
  }

  public function open_db_connection() {
//    $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($this->connection->connect_error) {
      die("Database connection faled badly." . $this->connection->connect_error);
    }
  }

  public function query($sql) {
    $result = $this->connection->query($sql);

    $this->confirm_query($result);

    return $result;
  }

  private function confirm_query($result) {
    if (!$result) {  // Check if $result is false (query failed)
      die("Query Failed: " . $this->connection->error);  // Display the error message
    }
  }

 public function escape_string($string) {
    $escaped_string = $this->connection->real_escape_string($string);
  return $escaped_string;
  }

public  function the_insert_id() {
    return $this->connection->insert_id;

}


}

$database = new Database();
$database->open_db_connection();