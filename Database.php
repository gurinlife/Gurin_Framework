<?php

class Database
{
  protected $conn        = null;
  protected $table_name  = null;
  protected $query       = null;
  protected $auto_commit = true;
  
  public function __construct($table_name, $auto_commit = true)
  {
    $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Check connection
    if (mysqli_connect_errno()) {
      die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    $this->table_name = $table_name;

    if (!$auto_commit) {
      $this->auto_commit = $auto_commit;
      mysqli_autocommit($this->conn, false);
    }
  }

  public function select($id, $conditions = null)
  {
    $this->set_query("SELECT {$id} FROM {$this->table_name}");

    if (!empty($conditions)) {
      $this->add_query("WHERE {$conditions}");
    }

    $result = $this->run_query();
    $data   = array();

    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
      }
    }

    return $data;
  }

  public function insert($data)
  {
    $this->set_query("INSERT INTO {$this->table_name} (".implode(', ', array_keys($data)).") VALUES (".implode(', ', $data).")");

    return $this->run_query();
  }

  public function set_query($query)
  {
    $this->query = $query;
  }

  public function add_query($query)
  {
    $this->query .= ' '.trim($query);
  }

  public function run_query()
  {
    return mysqli_query($this->conn, $this->query);
  }

  public function commit()
  {
    return mysqli_commit($this->conn);
  }

  public function rollback()
  {
    return mysqli_rollback($this->conn);
  }

  public function close()
  {
    return mysqli_close($this->conn);
  }
}
