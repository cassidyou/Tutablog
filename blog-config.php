<?php 
session_start();

require_once('includes/Bank.php');
$conn = db_connect("localhost","blogproject","root","");


define('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost/tutaBlog/');



?>


