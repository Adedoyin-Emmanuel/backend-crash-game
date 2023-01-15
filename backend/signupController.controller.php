<?php


//signup controller file
require_once("databaseConnector.php");

class SignupController extends DatabaseConnector{
    public function __construct()
    {
        parent::__construct();
    }
}