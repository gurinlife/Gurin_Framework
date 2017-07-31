<?php

class Database
{
  protected $conn       = null;
  protected $table_name = null;

  public function __construct($table_name)
  {
    $this->conn = mysqli_connect("localhost","sakarioka_blog","s4k4r10k4!@","sakarioka_blog");

    // Check connection
    if (mysqli_connect_errno()) {
      die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    $this->table_name = $table_name;
  }

  public function select($id, $conditions = null)
  {
    $sql = "SELECT {$id} FROM {$this->table_name}";

    if (!empty($conditions)) {
      $sql .= " WHERE {$conditions}";
    }

    $result = mysqli_query($this->conn, $sql);
    $data   = array();

    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
      }
    }

    return $data;
  }

  public function close()
  {
    return mysqli_close($this->conn);
  }
}
