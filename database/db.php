<?php

class Database 
{
  private $con;

  public function connect () {
    include_once('constants.php');

    $this->con = new Mysqli(HOST, USER, PASS, DB);

    if($this->con) {
      return $this->con;
    }

    return 'DATABASE_CONNECTION_FAILED';

  /*   $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  $cleardb_server = $cleardb_url['host'];
  $cleardb_username = $cleardb_url['user'];
  $cleardb_password = $cleardb_url['pass'];
  $cleardb_db = substr($cleardb_url['path'], 1);

  $active_group = 'default';
  $active_record = TRUE;

  $db['default']['hostname'] = $cleardb_server;
  $db['default']['username'] = $cleardb_username;
  $db['default']['password'] = $cleardb_password;
  $db['default']['database'] = $cleardb_db;
  $db['default']['dbdriver'] = 'PDO_MySQL';
  $db['default']['dbprefix'] = '';
  $db['default']['pconnect'] = TRUE;
  $db['default']['db_debug'] = TRUE;
  $db['default']['cache_on'] = FALSE;
  $db['default']['cachedir'] = '';
  $db['default']['char_set'] = 'utf8';
  $db['default']['dbcollat'] = 'utf8_general_ci';
  $db['default']['swap_pre'] = '';
  $db['default']['autoinit'] = TRUE;
  $db['default']['stricton'] = FALSE;

  $this->con = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

  if($this->con) {
    return $this->con;
  } */
  }
}

//$db = new Database();

//$db->connect();

?>