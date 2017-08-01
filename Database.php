<?php

class Database
{
  protected $conn           = null;
  protected $table_name     = null;
  protected $query          = null;
  protected $errors         = array();
  protected $error_template = array('', '');
  protected $auto_commit    = true;

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

  public function validate($column_name, $condition)
  {
    $condition = explode('_', $condition);

    if (count($condition) != 2 && !in_array($this->available_condition)) {
      trigger_error('Validate condition not valid.', E_USER_ERROR);
    } else {
      if (isset($_GET[$column_name])) {
        $value = $_GET[$column_name];
      } elseif (isset($_POST[$column_name])) {
        $value = $_POST[$column_name];
      } else {
        trigger_error('Column name not valid.', E_USER_ERROR);
      }

      if ($condition[0] == 'min' && $value < $condition[1]) {
        $this->set_errors('Minimum length of '.ucwords($column_name).' is '.$condition[1].' characters.', $column_name);
      } elseif ($condition[0] == 'max' && $value > $condition[1]) {
        $this->set_errors('Maximum length of '.ucwords($column_name).' is '.$condition[1].' characters.', $column_name);
      }
    }
  }

  public function set_errors($error_message, $key)
  {
    $this->errors[$key] = $error_message;
  }

  public function get_errors()
  {
    return $this->errors;
  }

  public function has_errors()
  {
    return (!empty($this->errors));
  }

  public function has_error($column_name) {
    return (!empty($this->errors[$column_name]));
  }

  public function show_error($column_name)
  {
    if (isset($this->errors[$column_name])) {
      return $this->error_template[0].' '.trim($this->errors[$column_name]).' '.$this->error_template[1];
    }
  }

  public function set_error_template($first, $second = '')
  {
    $this->error_template[0] = $first;
    $this->error_template[1] = $second;
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
    return mysqli_commit($this->conn)
  }
  
  public function rollback()
  {
    return mysqli_rollback($this->conn)
  }

  public function close()
  {
    return mysqli_close($this->conn);
  }
}
