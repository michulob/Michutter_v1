<?php

class Message{
  private $id;
  private $idN;
  private $idO;
  private $text;
  private $readed;
  private $sendDate;

  public function __construct(){
    $this->id = -1;
    $this->idN = '';
    $this->idO = '';
    $this->text = '';
    $this->readed = '';
    $this->sendDate = '';
  }

  public function getId(){
    return $this->id;
  }
  public function getIdN(){
    return $this->idN;
  }
  public function getIdO(){
    return $this->idO;
  }
  public function getText(){
    return $this->text;
  }
  public function getReaded(){
    return $this->readed;
  }
  public function getSendDate(){
    return $this->sendDate;
  }

  public function setIdN($idN){
    $this->idN = $idN;
  }

  public function setIdO($idO){
    $this->idO = $idO;
  }

  public function setText($text){
    if(strlen($text)>0 && strlen($text)<=900){
      $this->text = htmlentities($text);
    }else{
      $_SESSION['e_text']="Treść może mieć max 900 znaków i conajmniej jeden znak";
    }
  }

  public function setReaded(){
    if($this->readed==''){
      $this->readed = 0;
    }elseif($this->readed==0){
      $this->readed = 1;
    }
  }

  public function setSendDate(){
      $this->sendDate = date('Y-m-d H:i:s');
  }

  public static function loadMessageById(PDO $conn, $id){
    $sql = 'SELECT * FROM messages WHERE id=?';
    $result = $conn->prepare($sql);
    $result->execute([$id]);
    if ($result==TRUE && $result->rowCount()==1){
      $row = $result->fetch(PDO::FETCH_ASSOC);

      $loadedMessage = new Message();
      $loadedMessage->id = $row['id'];
      $loadedMessage->idN = $row['idN'];
      $loadedMessage->idO = $row['idO'];
      $loadedMessage->text = $row['text'];
      $loadedMessage->readed = $row['readed'];
      $loadedMessage->sendDate = $row['sendDate'];

      return $loadedMessage;
    }
    return NULL;
  }

  public static function loadAllMessagesByIdO(PDO $conn, $idO){
    $sql = "SELECT * FROM messages WHERE idO=$idO";
    $result = $conn->query($sql);
    if($result==TRUE && $result->rowCount()>0){
      $ret = [];
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $loadedMessage = new Message();
        $loadedMessage->id = $row['id'];
        $loadedMessage->idN = $row['idN'];
        $loadedMessage->idO = $row['idO'];
        $loadedMessage->text = $row['text'];
        $loadedMessage->readed = $row['readed'];
        $loadedMessage->sendDate = $row['sendDate'];

        $ret[] = $loadedMessage;
      }
      return $ret;
    }
    return NULL;
  }

  public function saveToDB(PDO $conn){
    if ($this->id == -1){
      $sql = 'INSERT INTO messages VALUES (NULL, ?,?,?,?,?)';
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute([$this->idN,
                                $this->idO,
                                $this->text,
                                $this->readed,
                                $this->sendDate]);
      if ($result){
        $this->id = $conn->lastInsertId();
        return TRUE;
      }
    }else{
      $sql = 'UPDATE messages SET readed="'.$this->readed.'" WHERE id='.$this->id.'';
      $result = $conn->query($sql);
      if ($result){
        return TRUE;
      }
    }
    return FALSE;
  }

  public function delete(PDO $conn){
    if($this->id!=-1){
      $sql = "DELETE FROM messages WHERE id=$this->id";
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
