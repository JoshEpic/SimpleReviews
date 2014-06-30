<?php


class createConnection
{
    var $host="localhost";
    var $username="root";
    Var $password="root";
    var $database="reviews";
    var $myconn;

    function connectToDatabase()
    {

        $conn= mysql_connect($this->host,$this->username,$this->password);

        if(!$conn)
        {
            die ("Cannot connect to the database");
        }

        else
        {

            $this->myconn = $conn;

        }

        return $this->myconn;

    }

    function selectDatabase()
    {
        mysql_select_db($this->database);

        if(mysql_error())
        {

            echo "Cannot find the database ".$this->database;

        }

    }

    function closeConnection()
    {
        mysql_close($this->myconn);

    }

}

?>