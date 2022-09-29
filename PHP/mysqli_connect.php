
<?php # Script- mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL, 
// selects the database to use, and sets the encoding.
// This file will be required in many other php files that need db connection.

// Set the database access information as constants:
DEFINE ('DB_USER', 'user30');  //  you should put your username here
DEFINE ('DB_PASSWORD', 'involtini@667'); //  you should put your database password here
DEFINE ('DB_HOST', 'orson.ischool.wisc.edu');
DEFINE ('DB_NAME', 'user30DB3'); //  you should put the database name here. it is usually in the format of yourhawkdi_db.

// Make the connection.@ will make sure the error won't be returned if there is one.
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');
?>