<?php

$servername = "localhost";

$username = "root"; 

$password = getenv('DB_PASSWD'); 

$dbname = getenv('DB_NAME'); 

$GLOBALS['conn'] = new mysqli($servername, $username, $password, $dbname);

if ($GLOBALS['conn']->connect_error) {

    die("Connection failed: " . $GLOBALS['conn']->connect_error);

}
?> 