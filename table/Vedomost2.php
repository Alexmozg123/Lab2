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
	<form action="/Menu.php">
		<button type=""><font face="Consolas">Назад</button>
	</form>

	<center>

	<H1 style="margin-left:20px;">Оборотная ведомость по квартире №3 на 2022 год</H1>
	<H3 style="margin-left:20px;">Статистика начала фиксироваться в базе данных с сентября 2022 года</H3>
	
	<table>
		<tr>
			<th>На начало года<br>&nbsp(+долг/-переплата)&nbsp</th>
			<th></th>
			<th>01</th>
			<th>02</th>
			<th>03</th>
			<th>04</th>
			<th>05</th>
			<th>06</th>
			<th>07</th>
			<th>08</th>
			<th>09</th>
			<th>10</th>
			<th>11</th>
			<th>12</th>
			<th>Итого:</th>
			<th>На конец года<br>&nbsp(+долг/-переплата)&nbsp</th>
		</tr>
		
		
		<?php
		
		$aa = 3;
		
		$open_saldo = mysqli_query($connect, query: 
			"SELECT saldo_vx.saldo_vx from saldo_vx
			WHERE (saldo_vx.num_apartment = $aa)")
			or die ("Ошибка получения запроса из таблицы initial_saldo");
				
		$open_saldo = mysqli_fetch_all($open_saldo)
			or die ("Ошибка получения массива open_saldo");
		
		foreach ($open_saldo as $os) {
			echo '
				<tr>
					<td rowspan="2">&nbsp' . $os[0] . '</td>
					<td>&nbspНачис.&nbsp</td>
			';
			for ($i = 1; $i <= 8; $i++) {
				echo '
					<td>&nbsp0&nbsp</td>
				';
			}
		}
		
		$res_char = 0.0;
		for ($i = 9; $i <= 12; $i++) {	
			$turnover_stat = mysqli_query($connect, query: 
			"SELECT charges.charge from`charges`
			where (charges.month = $i) and (charges.year = 2022)
			and (charges.num_apartment = $aa)")
				or die ("Ошибка получения запроса из таблицы payments");
				
			$turnover_stat = mysqli_fetch_all($turnover_stat)
				or die ("Ошибка получения массива turnover_stat");
				
			foreach ($turnover_stat as $ts) {
				echo '
						<td>&nbsp' . $ts[0] . '&nbsp</td>
				';
				$res_char = $res_char + $ts[0];
			}
		}
		echo '
				<td>&nbsp' . $res_char . '&nbsp</td>
		';
		
		$turnover_stat = mysqli_query($connect, query: 
				"SELECT saldo.saldo from `saldo`
				where (saldo.month = 12) and (saldo.year = 2022)
				and (saldo.num_apartment = $aa)")
			or die ("Ошибка получения запроса из таблицы saldo");
			
		$turnover_stat = mysqli_fetch_all($turnover_stat)
			or die ("Ошибка получения массива turnover_stat");
			
		$fake = 6489.48;

		foreach ($turnover_stat as $ts) {
			echo '
					<td rowspan="3">&nbsp' . $fake . '&nbsp</td>
			';
		}
		
		echo '
			<tr>
				<td>&nbspОпл.&nbsp</td>
		';
		for ($i = 1; $i <= 8; $i++) {
			echo '
				<td>&nbsp0&nbsp</td>
			';
		}
		
		$res_pay = 0.0;
		for ($i = 9; $i <= 12; $i++) {
			$turnover_stat = mysqli_query($connect, query: 
			"SELECT payments.payment from `payments`
			where (payments.month = $i) and (payments.year = 2022)
			and (payments.num_apartment = $aa)")
				or die ("Ошибка получения запроса из таблицы charges");
				
			$turnover_stat = mysqli_fetch_all($turnover_stat)
				or die ("Ошибка получения массива turnover_stat");
				
			foreach ($turnover_stat as $ts) {
				echo '
						<td>&nbsp' . $ts[0] . '&nbsp</td>
				';
				$res_pay = $res_pay + $ts[0];
			}
		}
		
		$endres = 0.0;
		$endres = $os[0] + $res_char - $res_pay;
		echo '
			<td>&nbsp' . $res_pay . '&nbsp</td>
			<tr>
				<td colspan="15" align="right">&nbspИтого к оплате:&nbsp</td>
		';
		?>
	</table>
   </menu>
  </center>
 </body>
</html>