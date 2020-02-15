<?php

  class User 
  {
    
    private $con;

    function __construct() {
      include_once('../database/db.php');
      $db = new Database();
      $this->con = $db->connect();
      /* if($this->con) {
        echo "Connected";
      } */
    }

    // Check if user is registered or not
    private function emailExists($email) {
      $pre_stmt = $this->con->prepare('SELECT id FROM users WHERE email = ?');
      $pre_stmt->bind_param('s', $email);
      $pre_stmt->execute() or die($this->con->error);
      $result = $pre_stmt->get_result();

      if($result->num_rows > 0) {
        return "1";
      } else {
        return "0";
      }
    }

    public function createUserAccount ($username, $email, $password, $usertype, $image) {
      if ($this->emailExists($email)) {
        return "EMAIL_EXISTS";
      } else {
        $pass_hash = password_hash($password, PASSWORD_BCRYPT, ["cost"=> 8]);
        $date = date('Y-m-d');
        $notes = "";
        $pre_stmt = $this->con->prepare("INSERT INTO users 
                    (username, email, password, usertype, register_date, last_login, notes, image) 
                    VALUES (?,?,?,?,?,?,?,?)");

        $pre_stmt->bind_param('ssssssss', $username, $email, $pass_hash, $usertype, $date, $date, $notes, $image);

        $result = $pre_stmt->execute() or die($this->con->error);

        if($result) {
          return $this->con->insert_id;
        } else {
          return "SOME_ERROR";
        }

        
      }
    }

    public function userLogin ($email, $password) {
      $pre_stmt = $this->con->prepare('SELECT id, username, password, last_login, usertype, image FROM users WHERE email = ?');
      $pre_stmt->bind_param('s', $email);

      $pre_stmt->execute() or die($this->con->error);
      $result = $pre_stmt->get_result();

      if($result->num_rows < 1) {
        return "NOT_REGISTERED";
      } else {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
          $_SESSION['userid'] = $row['id'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['last_login'] = $row['last_login'];
          $_SESSION['usertype'] = $row['usertype'];

          //Updating user last login time
          $last_login = date("Y-m-d h:m:s");
          $stmt = $this->con->prepare('UPDATE users SET last_login = ? WHERE email = ?');
          $stmt->bind_param('ss', $last_login, $email);

          $result = $stmt->execute() or die($this->con->error);
          if($result) {
            return 1;
          } else {
            return 0;
          }
        } else {
          return "PASSWORD_UNMATCHED";
        }
      } 
    }

  }

 /*  $user = new User();
  echo $user->userLogin("barry@www.com", "secret");
  echo $_SESSION['username']; */

  //echo $user->createUserAccount("barry", "barry@www.com", "secret", "Admin");
?>