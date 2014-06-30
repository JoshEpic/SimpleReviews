<?php

require 'reviews.php';

$response =  array();
$new_review = new Reviews();

    if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['rating'])){

    	$post_id = $_REQUEST['post_id'];
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $website = $_REQUEST['website'];
        $rating = $_REQUEST['rating'];
        $review = $_REQUEST['review'];

        $response = $new_review->addNewReview($post_id, $name, $email, $website, $rating, $review);
        echo $response[0];

        }
?>