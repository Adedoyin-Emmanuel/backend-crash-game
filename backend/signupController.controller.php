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
            $this->date_joined = date("Y-m-d"); 

            #check if the user already exist in the database we don't want duplicate users
		  	$this->user_duplicate_query = "SELECT * FROM crash_game WHERE username = ?";

            if($this->statement = $this->conn->prepare($this->user_duplicate_query)){
                $this->condition = $legit_username;
                #bind the parameters
		  		$this->statement->bind_param("s",$this->condition);

		  		$this->statement->execute();

		  		$this->duplicate_result = $this->statement->get_result();

		  		#error checking
		  		if(!$this->duplicate_result){
		  			return "an error occured".$this->conn->error;

		  		}

                if($this->duplicate_result->num_rows > 0){
                    return "username already exist";
                }else{
                    $this->user_duplicate_query="SELECT * FROM crash_game WHERE username = ?";
                    if($this->statement = $this->conn->prepare($this->user_duplicate_query)){
                        //bind the parameters
                        $this->statement->bind_param("s",$this->legit_username);
                        $this->statement->execute();
                        $this->duplicate_result= $this->statement->get_result();


                        if(!$this->duplicate_result){
                            return "An error occured".$this->conn->error;
                        }

                        if($this->duplicate_result->num_rows > 0){
                            return "username already exist";
                        }else{
                            //insert the data
                            $this->insert_query = "INSERT INTO crash_gamers (username,password,date_joined)";

                            if($this->insert_statement = $this->conn->prepare($this->insert_query)){
                                $this->insert_query->bind("s,s,s",$this->username,$this->password,$this->date_joined);
                                $this->insert_statement->execute();

                                return "Signup successful please login";
                            }else{
                                return "Signup failded, ".$this->conn->error;
                            }
                        }
                    }
                }


            }

    }
}
}