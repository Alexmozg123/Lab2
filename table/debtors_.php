<?php 
require_once '../config/connect.php';
?>

<!doctype html>
<html>
  <head>
	<meta charset=“UTF-8”>
	<title>DataBase Turnover Statement</title>
  </head>
  <style>
        th, td {
            padding: 10px;
        }

        th {
            background: green;
            color: white;
        }

        td {
            background: blue;
            color: white;
        }
    </style>
  <body>
  	<form action="../Menu.php">
		<button type=""><font face="Consolas">Назад</button>
	</form>
	<center>
	<H1 style="margin-left:20px;">Сводка по категориям должников на 02.03.2023</H1>
	<H3 style="margin-left:20px;">Статистика начала фиксироваться в базе данных с сентября 2022 года</H3>
	
	
	<table>
		<tr>
			<th rowspan="2">&nbspКвартира&nbsp</th>
			<th rowspan="2">&nbspНачислено&nbsp<br>&nbspза последний месяц&nbsp<br>&nbsp(декабрь 2022)&nbsp</th>
			<th rowspan="2">&nbspСальдо&nbsp</th>
			<th colspan="4">&nbspЗадолженность&nbsp</th>
		</tr>
		
		<tr>
			<th>&nbsp1 месяц&nbsp</th>
			<th>&nbsp2 месяца&nbsp</th>
			<th>&nbsp3 месяца&nbsp</th>
			<th>&nbspСвыше 3&nbsp<br>&nbspмесяцев&nbsp</th>
		</tr>
		
		<?php	
		$DebtorsApartments = mysqli_query($connect, query: 
				"SELECT DISTINCT saldo.num_apartment from saldo
				where (saldo.saldo > 0) and (saldo.month = 12) and (saldo.year = 2022)")
			or die ("Ошибка получения таблицы saldo");
		$DebtorsApartments = mysqli_fetch_all($DebtorsApartments)
			or die ("Ошибка получения массива DebtorsApartments");
		
		foreach ($DebtorsApartments as $aa) {
			
			echo '
				<tr>
					<td>&nbsp' . $aa[0] . '&nbsp</td>
			';
			$info = mysqli_query($connect, query: 
					"SELECT charges.charge, saldo.saldo from `charges`, `saldo`
					where (charges.month = 12) and (charges.year = 2022)
					and (saldo.month = 12) and (saldo.year = 2022)
					and (charges.num_apartment = $aa[0]) and (saldo.num_apartment = $aa[0])")
				or die ("Ошибка получения запроса из таблиц charges, saldo");
					
			$info = mysqli_fetch_all($info)
				or die ("Ошибка получения массива info");
				
			
			foreach ($info as $in) {
				echo '
					<td>&nbsp' . $in[0] . '&nbsp</td>
					<td>&nbsp' . $in[1] . '&nbsp</td>
				';
			}
			
			$category = mysqli_query($connect, query: 
					"CALL GetCategory($aa[0]);")
				or die ("Ошибка получения запроса хранимой процедуры");
					
			$category = mysqli_fetch_all($category)
				or die ("Ошибка получения массива category");
				
			for ($i = 1; $i <= 4; $i++) {
				foreach ($category as $c) {
					if ($i == $c[0]) {
						echo '
							<td>&nbsp' . $in[1] . '&nbsp</td>
						';
					}
					if ($i != $c[0])
					{
						echo '
							<td></td>
						';
					}
				}
			}
			echo '
				</tr>
			';
		}
		?>
	</table>
  </menu>
  <center>
 </body>
</html>