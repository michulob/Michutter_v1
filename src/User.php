<?php

class User {
  private $id;
  private $email;
  private $username;
  private $hashedPassword;
  private $salt;

  public function __construct(){
    $this->id = -1;
    $this->email = '';
    $this->username = '';
    $this->hashedPassword = '';
    $this->salt = '';
  }

  public function setEmail(PDO $conn, $newEmail){
    $result = $conn->query('SELECT id FROM users WHERE email="'.$newEmail.'"');
    $emailB = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
    if ($result->rowCount() > 0){
      $_SESSION['e_email']="Istnieje już taki email";
    }elseif (empty($newEmail)){
      $_SESSION['e_email'] = "Podaj maila";
    }elseif(!filter_var($emailB, FILTER_VALIDATE_EMAIL) || $emailB!=$newEmail){
      $_SESSION['e_email'] = "Podany e-mail jest nieprawidłowy";
    }else{
      $this->email = $emailB;
    }
  }

  public function setUsername($newUsername){
    if (strlen($newUsername)<41 && strlen($newUsername)>1){
      $this->username = $newUsername;
    }else{
      $_SESSION['e_username'] = "Nick ma mieć min 1 max 40 znakow !";
    }
  }

  public function setPassword($newPassword, $newPasswordV){
      if (empty($newPassword) || empty($newPasswordV)){
        $_SESSION['e_pass']="Podaj hasło i je powtórz";
      }elseif ((strlen($newPassword)<8) || (strlen($newPassword)>20)){
        $_SESSION['e_pass']="Hasło musi posiadać od 8 do 20 znaków";
      }elseif ($newPassword!=$newPasswordV){
        $_SESSION['e_pass']="Podane hasła nie są takie same";
      }elseif (!ctype_alnum($newPassword)){
        $_SESSION['e_pass'] = "Hasło może zawierać tylko litery alfabetu angielskiego oraz cyfry";
      }else{
        $this->setSalt();
        $this->hashedPassword = hash('sha256', $newPassword.$this->salt);
      }
  }

  public function setSalt(){
    $string = '';
    for($i=0; $i<6; $i++){
      $rand = rand(0,2);
      switch($rand){
        case(0): $string .= chr(rand(ord('0'),ord('9')));break;
        case(1): $string .= chr(rand(ord('A'),ord('Z')));break;
        case(2): $string .= chr(rand(ord('a'),ord('z')));break;
      }
    }
    $this->salt = $string;
  }

  public function getId (){
    return $this->id;
  }
  public function getEmail (){
    return $this->email;
  }
  public function getUsername (){
    return $this->username;
  }
  public function getPassword (){
    return $this->hashedPassword;
  }
  public function getSalt (){
    return $this->salt;
  }

  public function saveToDB (PDO $conn){
    if ($this->id == -1){
      $sql = 'INSERT INTO users VALUES (NULL, ?,?,?,?)';
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute([$this->email,
                                $this->username,
                                $this->hashedPassword,
                                $this->salt]);
      if ($result){
        $this->id = $conn->lastInsertId();
        return TRUE;
      }
    }else{
      $sql = 'UPDATE users SET  username="'.$this->username.'",
                                hashed_password="'.$this->hashedPassword.'",
                                email="'.$this->email.'",
                                salt="'.$this->salt.'"
                          WHERE id='.$this->id.'';
      $result = $conn->query($sql);
      if ($result){
        return TRUE;
      }
    }
    return FALSE;
  }

  public static function loadUserById(PDO $conn, $id){
    $sql = 'SELECT * FROM users WHERE id=?';
    $result = $conn->prepare($sql);
    $result->execute([$id]);
    if ($result==TRUE && $result->rowCount()==1){
      $row = $result->fetch(PDO::FETCH_ASSOC);

      $loadedUser = new User();
      $loadedUser->id = $row['id'];
      $loadedUser->email = $row['email'];
      $loadedUser->username = $row['username'];
      $loadedUser->hashedPassword = $row['hashed_password'];
      $loadedUser->salt = $row['salt'];

      return $loadedUser;
    }
    return NULL;
  }

  public static function loadAllUsers(PDO $conn){
    $sql = 'SELECT * FROM users';
    $result = $conn->query($sql);
    if($result==TRUE && $result->rowCount()>0){
      $ret = [];
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $loadedUser = new User();
        $loadedUser->id = $row['id'];
        $loadedUser->email = $row['email'];
        $loadedUser->username = $row['username'];
        $loadedUser->hashedPassword = $row['hashed_password'];
        $loadedUser->salt = $row['salt'];

        $ret[] = $loadedUser;
      }
      return $ret;
    }
    return NULL;
  }

  public function delete(PDO $conn){
    if($this->id!=-1){
      $sql = "DELETE FROM users WHERE id=$this->id";
      $result = $conn->query($sql);
      if($result){
        $this->id = -1;
        return TRUE;
      }
      return FALSE;
    }
    return TRUE;
  }

}

?>
