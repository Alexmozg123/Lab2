<?php

require_once '../config/connect.php';

$number_person =  $_POST['number_person'];
$house_number = $_POST['house_number'];

mysqli_query($connect, query: "INSERT INTO Houses (id, number_person, house_number) VALUES (NULL,'$number_person','$house_number')"); 

header('Location: http://bd/table/Houses.php?');