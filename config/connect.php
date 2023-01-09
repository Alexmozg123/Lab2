<?php

$hostname = 'localhost'; 
$username = 'root';
$password = '';
$database = 'PayDB';

$connect = mysqli_connect($hostname, $username, $password, $database);

if(!$connect) {
    die('ERROR!');
}
