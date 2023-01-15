<?php


//signup controller file
require_once("databaseConnector.php");

class SignupController extends DatabaseConnector
{
    public function __construct($username, $password)
    {
        parent::__construct();

        $this->username = $username;
        $this->password = $password;
    }


    public function get_username()
    {
        return $this->username;
    }

    public function get_password()
    {
        return $this->password;
    }



    public function custom_input_sanitizer($data)
    {
        $this->data = $data;
        $this->data = trim($data);
        $this->data = stripslashes($data);
        $this->data = htmlspecialchars($data);

        return $this->data;
    }


    public function sanitize_signup_data($username, $password)
    {
        if (empty($username) or empty($password)) {
            return "credentials can't be blank!";
        }

        $this->username = $this->custom_inputs_sanitizer($this->username);
        $this->password = $this->custom_inputs_sanitizer($this->password);


        if (!preg_match("/^[a-zA-Z-' ]*$/", $this->username)) {
            return "Only letters and white space allowed";
        }

        return true;
    }


    public function insert_data($username,$password){
        if(!empty($username) OR !empty($password)){
            $this->options = [
			    'cost' => 12,
			];
           
            $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT, $this->options);
            $this->legit_username = mysqli_real_escape_string($this->conn,strtolower($this->username));
    }
}
}