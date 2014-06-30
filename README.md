SimpleReviews
=============

A Simple PHP Reviews Solution

Simple Reviews is very easy to get up and running. Fllow the steps below to install and start recieveing reviews on you website!

Import review.sql to create the reviews Database Table
Update /db/connection.php with your MySQL info
```php
    var $host="localhost";
    var $username="root";
    Var $password="root";
    var $database="reviews";
```
Add a page id to the top of the page you want to add a review to

```php
<?php 
  $post_id = 2;
?>
```
Include review_form.php in your page wherever you want the reviews / review form to appear
```php
  <?php require('review_form.php'); ?>
```
Save your files!
