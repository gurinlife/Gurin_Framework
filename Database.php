<?php

class Database
{
  protected $conn           = null;
  protected $table_name     = null;
  protected $errors         = array();
  protected $error_template = array('', '');

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

  public function insert($data)
  {
    $sql = "INSERT INTO {$this->table_name} (".implode(', ', array_keys($data)).") VALUES (".implode(', ', $data).")";

    if (mysqli_query($this->conn, $sql)) {

    }
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

  public function set_error_template($first, $second = '')
  {
    $this->error_template[0] = $first;
    $this->error_template[1] = $second;
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

  public function close()
  {
    return mysqli_close($this->conn);
  }
}
