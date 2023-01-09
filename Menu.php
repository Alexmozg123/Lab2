<?php 
require_once 'config/connect.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
</head>
<body>
	<center>
	<H1>
		<font face="title1" color="green">
			Table Database
		</font>
	</H1>
	<form action="../table/charges.php">
		<button type="" style="background-color:green; color:white">
			<font face="title3">
				<H2>Charges</H2>
			</font>
		</button>
	</form>
	<br>
	<form action="../table/Payments.php">
		<button type="" style="background-color:green;; color:white">
			<font face="title5">
				<H2>Payments</H2>
			</font>
		</button>
	</form>
	<br>
	<form action="../table/Saldo.php">
		<button type="" style="background-color:green;; color:white">
			<font face="title4">
				<H2>Saldo</H2>
			</font>
		</button>
	</form>
	<br>
	<form action="../table/Vedomost1.php">
		<button type="" style="background-color:blue; color:white">
			<font face="title5">
				<H2>Turnover sheet 1</H2>
			</font>
		</button>
	</form>
	<br>
	<form action="../table/Vedomost2.php">
		<button type="" style="background-color:blue; color:white">
			<font face="title6">
				<H2>Turnover sheet 2</H2>
			</font>
		</button>
	</form>
	<br>
	<form action="../table/debtors_.php">
		<button type="" style="background-color:blue; color:white">
			<font face="title7">
				<H2>Debtors</H2>
			</font>
		</button>
	</form>
	</center>
</body>
</html>