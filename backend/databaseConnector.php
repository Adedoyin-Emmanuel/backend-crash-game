<?php


// database controller file


class DatabaseConnector
{
    protected $databaseName = "crash_game";
    protected $databasePassword = "crash_game";
    protected $serverName = "localhost";
    protected $userName = "root";

    public function __construct()
    {
         $this->databaseName = "crash_game";
         $this->databasePassword = "crash_game";
         $this->serverName = "localhost";
         $this->userName = "root";
    
        try {
                $this->conn= new mysqli($this->serverName,$this->userName,$this->databasePassword,$this->databaseName);
        } catch (Exception $e) {
           die("An error occured ".$e->getMessage());
        }
        
        
    }
}
