<?php

class Comment{
  private $id;
  private $userId;
  private $tweetId;
  private $creationDate;
  private $text;

  public function __construct(){
    $this->id = -1;
    $this->userId = '';
    $this->tweetId = '';
    $this->creationDate = '';
    $this->text = '';
  }

  public function getId(){
    return $this->id;
  }
  public function getUserId(){
    return $this->userId;
  }
  public function getTweetId(){
    return $this->tweetId;
  }
  public function getCreationDate(){
    return $this->creationDate;
  }
  public function getText(){
    return $this->text;
  }

  public function setUserId($userId){
    $this->userId = $userId;
  }

  public function setTweetId($tweetId){
    $this->tweetId = $tweetId;
  }

  public function setText($newText){
    $text = htmlentities($newText);
    if (strlen($text)<=60){
      $this->text = $text;
    }else{
      $_SESSION['e_comment']="Tweet za długi";
    }
  }

  public function setCreationDate(){
    $this->creationDate = date('Y-m-d H:i:s');
  }

  public static function loadCommentById(PDO $conn, $id){
    $sql = 'SELECT * FROM comments WHERE id='.$id.'';
    $result = $conn->query($sql);
    if ($result==TRUE && $result->rowCount()==1){
      $row = $result->fetch(PDO::FETCH_ASSOC);

      $loadedComment = new Comment();
      $loadedComment->id = $row['id'];
      $loadedComment->userId = $row['userId'];
      $loadedComment->tweetId = $row['tweetId'];
      $loadedComment->creationDate = $row['creationDate'];
      $loadedComment->text = $row['text'];

      return $loadedComment;
    }
    return NULL;
  }

  public static function loadAllCommentsByTweetId(PDO $conn, $tweetId){
    $sql = "SELECT * FROM comments WHERE tweetId=$tweetId";
    $result = $conn->query($sql);
    if($result==TRUE && $result->rowCount()>0){
      $ret = [];
      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $loadedComment = new Comment();
        $loadedComment->id = $row['id'];
        $loadedComment->userId = $row['userId'];
        $loadedComment->tweetId = $row['tweetId'];
        $loadedComment->creationDate = $row['creationDate'];
        $loadedComment->text = $row['text'];

        $ret[] = $loadedComment;
      }
      return $ret;
    }
    return NULL;
  }

  public function saveToDB(PDO $conn){
    if ($this->id == -1){
      $sql = 'INSERT INTO comments VALUES (NULL, ?,?,?,?)';
      $stmt = $conn->prepare($sql);
      $result = $stmt->execute([$this->userId,
                                $this->tweetId,
                                $this->creationDate,
                                $this->text]);
      if ($result){
        $this->id = $conn->lastInsertId();
        return TRUE;
      }
    }
    return FALSE;
  }

  public function delete(PDO $conn){
    if($this->id!=-1){
      $sql = "DELETE FROM comments WHERE id=$this->id";
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
