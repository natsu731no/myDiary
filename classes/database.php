<?php

class Database{
    private $server_name = "localhost";
    private $user_name = "root";
    private $pass_word = "";
    private $db_name = "my_diary";
    protected $conn;

    public function __construct(){
        $this->conn = new mysqli($this->server_name, $this->user_name, $this->pass_word, $this->db_name);
        #$this->conn = new mysqli("localhost", "root", "", "the_company");

        if($this->conn->connect_error){
            //if database is not connected
            die("Unable to connect to database " . $this->db_name . " : ". $this->conn->connect_error);
        }
    }
}