<?php

require_once '../config/connect.php';

$charges =  $_POST['charges'];
$month = $_POST['month'];
$year = $_POST['year'];
$houses_id = $_POST['houses_id'];

mysqli_query($connect, query: "INSERT INTO Charges (id, charges, month, year, houses_id) VALUES (NULL,'$charges','$month', '$year','$houses_id')"); 

header('Location: http://bd/table/charges.php?');