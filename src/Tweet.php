<?php

class Tweet {
  private $id;
  private $userId;
  private $text;
  private $creationDate;

  public function __construct(){
    $this->id = -1;
    $this->userId = '';
    $this->text = '';
    $this->creationDate = '';
  }

  public function getId(){
    return $this->id;
  }
  public function getUserId(){
    return $this->userId;
  }
  public function getText(){
    return $this->text;
  }
  public function getCreationDate(){
    return $this->creationDate;
  }


  public function setUserId($userId){
    $this->userId = $userId;
  }

  public function setText($newText){
    $text = htmlentities($newText);
    if (strlen($text)<=140){
      $this->text = $text;
    }else{
      $_SESSION['e_tweet']="Tweet za długi";
    }
  }

  public function setCreationDate(){
    $this->creationDate = date('Y-m-d H:i:s');
  }

  public static function loadTweetById(PDO $conn, $id){
    $sql = 'SELECT * FROM tweets WHERE id='.$id.'';
    $result = $conn->query($sql);
    if ($result==TRUE && $result->rowCount()==1){
      $row = $result->fetch(PDO::FETCH_ASSOC);

      $loadedTweet = new Tweet();
      $loadedTweet->id = $row['id'];
      $loadedTweet->userId = $row['userId'];
      $loadedTweet->text = $row['text'];
      $loadedTweet->creationDate = $row['creationDate'];

      return $loadedTweet;
    }
    return NULL;
  }

  public static function loadAllTweetsByUserId(PDO $conn, $userId){
    $sql = "SELECT * FROM tweets WHERE userId=$userId";
    $result = $conn->query($sql);
    if($result==TRUE && $result->rowCount()>0){
      $ret = [];
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $loadedTweet = new Tweet();
        $loadedTweet->id = $row['id'];
        $loadedTweet->userId = $row['userId'];
        $loadedTweet->text = $row['text'];
        $loadedTweet->creationDate = $row['creationDate'];

        $ret[] = $loadedTweet;
      }
      return $ret;
    }
    return NULL;
  }

  public static function loadAllTweets(PDO $conn){
      $sql = 'SELECT * FROM tweets';
      $result = $conn->query($sql);
      if($result==TRUE && $result->rowCount()>0){
        $ret = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
          $loadedTweet = new Tweet();
          $loadedTweet->id = $row['id'];
          $loadedTweet->userId = $row['userId'];
          $loadedTweet->text = $row['text'];
          $loadedTweet->creationDate = $row['creationDate'];

          $ret[] = $loadedTweet;
        }
        return $ret;
      }
      return NULL;
  }

  public function saveToDB(PDO $conn){
    if ($this->id == -1){
      $sql = 'INSERT INTO tweets VALUES (NULL, ?,?,?)';
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute([$this->userId,
                                $this->text,
                                $this->creationDate]);
      if ($result){
        $this->id = $conn->lastInsertId();
        return TRUE;
      }
    }
    return FALSE;
  }

  public function delete(PDO $conn){
    if($this->id!=-1){
      $sql = "DELETE FROM tweets WHERE id=$this->id";
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
