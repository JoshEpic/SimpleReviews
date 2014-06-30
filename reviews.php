<?php

set_include_path(dirname(__FILE__)."/../");

require 'db/connection.php';
require_once 'db/messages.php';
$connection =  new createConnection();
$response =  array();

class Reviews
{ 
    /**
     * 
     * @global createConnection $connection
     * @param type $firstName
     * @param type $lastName
     * @param type $age
     * @return type
     */
    public function addNewReview($post_id,$name,$email,$website,$rating,$review)
    {
        global $connection;
        $connection->connectToDatabase();
        $connection->selectDatabase();

        try {
            $insertQuery = "INSERT INTO review(post_id, name, email, website, rating, review) VALUES ('$post_id', '$name', '$email', '$website', '$rating', '$review')";

                if (!mysql_query($insertQuery)){
                    $response[0]= 'Error occured while inserting data';
                    $response[1]= Message::Error;
                    $connection->closeConnection(); // closing the connection
                 }
                else{
                    $response[0]= 'Successfully added to the database';
                    $response[1]= Message::Success;
                    $connection->closeConnection(); // closing the connection
                }

            return $response;
        } catch (Exception $exc) {
                    $response[0]= $exc->getTraceAsString();
                    $response[1]= Message::Error;
                    $connection->closeConnection(); // closing the connection
                    return $response;
        }

    }

    public function getReviews($post_id)
    {
        global $connection;
        $connection->connectToDatabase();
        $connection->selectDatabase();

            $selectQuery = "SELECT * FROM review WHERE post_id='$post_id'";
            $result = mysql_query($selectQuery);

            return $result;

    }

}
?>