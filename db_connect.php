<?php
/**
 * Created by PhpStorm.
 * User: Taylor
 * Date: 3/27/18
 * Time: 12:05 PM
 */


//DEFINE('DB_USER', 'root');
//DEFINE('DB_PASSWORD', 'root');
//DEFINE('DB_HOST', 'localhost');
//DEFINE('DB_DATABASE', 'cupcakes');

DEFINE('DB_USER', 'tmpugh');
DEFINE('DB_PASSWORD', '400199255');
DEFINE('DB_HOST', 'trevor.butler.edu');
DEFINE('DB_DATABASE', 'tmpugh');



$dbc= @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)
OR DIE ("Could not connect to the database: " . mysqli_connect_error() );