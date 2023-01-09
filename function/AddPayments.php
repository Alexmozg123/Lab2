<?php

require_once '../config/connect.php';

$payments =  $_POST['payments'];
$month = $_POST['month'];
$year = $_POST['year'];
$charges_id = $_POST['charges_id'];

mysqli_query($connect, query: "INSERT INTO Payments (id, payments, month, year, charges_id) VALUES (NULL,'$payments','$month', '$year','$charges_id')"); 

header('Location: http://bd/table/payments.php?');