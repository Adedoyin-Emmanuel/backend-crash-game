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
            $this->statement->bind_param("s",$this->username);
            $this->statement->execute();

            $this->result = $this->statement->get_result();

            if(!$this->result){
                return "An error occured".$this->conn->error;
            }

            if($this->result->num_rows == 1){
                $this->user_row = $this->result->fetch_assoc();
                //compare passwords

                if(password_verify($this->password,$this->user_row["password"])){
                    return true;
                }else{
                    return "invalid credentials";
                }
            }else{
                return "user does not exist";
            }

        }
    }
}