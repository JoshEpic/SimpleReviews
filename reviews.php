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
     * Get Post ID $post_id
     * Get Reviewers Name $name
     * Get Reviewers Email $email
     * Get Website $website
     * Get Post Rating $rating
     * Get Review $review
     * 1. Connect To Database Via $connection
     * 2. Insert Gathered Values into Database Table (review)
     * 3. Check if SQL Query Threw any Errors
     * 4. If Error Exists Kill Query and Display Error
     * 5. If no SQL Query Errors, Check If Inserting Data Caused any Errors
     * 6. If Error exists return Error $response 
     * 7. Else If no Errors return Success $response
     * 
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
    
    /**
     * 
     * Get Post ID $post_id
     * 1. Connect To Database Via $connection
     * 2. Run Select Query on Database Table (review) based on $post_id
     * 3. return $result
     * 
     */

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
