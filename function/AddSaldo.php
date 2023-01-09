<?php

require_once '../config/connect.php';

$saldo =  $_POST['saldo'];
$month = $_POST['month'];
$year = $_POST['year'];
$charges_id = $_POST['charges_id'];

mysqli_query($connect, query: "INSERT INTO Saldo (id, saldo, month, year, charges_id) VALUES (NULL,'$saldo','$month', '$year','$charges_id')"); 

header('Location: http://bd/table/saldo.php?');