<?php 

namespace App;

use Exception;

class FileSystem extends DB
{
    protected $action;
    protected $rowCount;
    protected $stmt;
    protected $queryString;
    protected $fetchQuery;

    public  function create($user_id,$image) 
    {
        $table = getenv('TABLE_NAME');

        try {
            $this->queryString = "INSERT INTO $table (userID,imagePath)  VALUES (?,?)";
            $this->stmt = parent::pdoConnect()->prepare($this->queryString);
            $this->stmt->bindParam(1, $user_id);
            $this->stmt->bindParam(2, $image);
            $this->action = $this->stmt->execute() or
            die(parent::$error . __LINE__);
            $this->rowCount = $this->stmt->rowCount();
            if ($this->rowCount > 0) {
                return $this->rowCount;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception("Create Query Error: ".$e->getMessage());
        }
    }
  
}