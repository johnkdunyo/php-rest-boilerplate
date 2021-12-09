<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'restproject_db';
    private $password = '';
    private $username = 'root';
    private $dbConn;


    //db connect
    public function connect() {
        $this->dbConn = null ;

        try {
            $this->dbConn = new PDO("mysql:host=".$this->host . ";dbname=" . $this->db_name, $this->username, $this->password );
            echo "connection to " .$this->db_name ." successful..";

            $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        } catch (PDOException $e){
            echo " connection unsuccesful; " . $e->getMessage();

        }

        return $this->dbConn;
    }


}






?>