<?php 
/**
 * root database connection class
 */
namespace App;

use PDO;
use PDOException;

class DB 
{
    public $link;
    public $error;

    public function pdoConnect() 
    {
        try {
            $this->link = new PDO(
                getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS')
            );
            $this->link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->link->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->link;

        } catch (PDOException $e) {
            $this->error = "Database connection error: " . $e->getMessage();
            return $this->error;
        }
    }

}