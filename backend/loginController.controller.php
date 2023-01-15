<?php

// login controller file


require_once("databaseConnector.php");

final class LoginController extends DatabaseConnector {
    
    public function __construct()
    {
        parent::__construct();
    }


    public function check_credentials($username, $password)
    {
        if(empty($username) OR empty($password)){
            return "Please enter your credentials";
        }

        $this->username = mysqli_real_escape_string($this->conn,strtolower($username));
        $this->password = mysqli_real_escape_string($this->conn,$password);
        $this->db_login_query = "SELECT * FROM crash_gamers WHERE username = ?";

        if($this->statement = $this->conn->prepare($this->db_login_query)){
            
            //bind the parameters 

            
        }
    }
}