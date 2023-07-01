<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "note_app_db";

    function connect()
    {
        $con = new mysqli($this->servername, $this->username, $this->password, $this->db_name);

        if (!$con) {
            die("Connection failed:" . $con->connect_error);
        } else {
            return $con;
        }
    }
}

?>