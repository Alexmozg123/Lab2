<?php 
require_once '../config/connect.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Vedomost1</title>
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
		<button type=""><font face="title1">Назад</button>
	</form>

	<center>
	<H1 style="margin-left:20px;">Оборотная ведомость по квартирам на 2022 год</H1>

	<table>
		<tr>
			<th>&nbsp Квартира &nbsp</th>
			<th>&nbsp Входное cальдо &nbsp</th>
			<th>&nbsp Январь &nbsp</th>
			<th>&nbsp Февраль &nbsp</th>
			<th>&nbsp Март &nbsp</th>
			<th>&nbsp Апрель &nbsp</th>
			<th>&nbsp Май &nbsp</th>
			<th>&nbsp Июнь &nbsp</th>
			<th>&nbsp Июль &nbsp</th>
			<th>&nbsp Август &nbsp</th>
			<th>&nbsp Сентябрь &nbsp</th>
			<th>&nbsp Октябрь &nbsp</th>
			<th>&nbsp Ноябрь &nbsp</th>
			<th>&nbsp Декабрь &nbsp</th>
			<th>&nbsp Исходное сальдо &nbsp</th>
		</tr>
		<?php
		$houses = mysqli_query($connect, query: "SELECT DISTINCT payments.num_apartment from `payments`");
		$houses = mysqli_fetch_all($houses);
		foreach($houses as $h) {
			$saldo_vx = mysqli_query($connect, query: "SELECT saldo_vx.saldo_vx from saldo_vx
			WHERE (saldo_vx.num_apartment = $h[0])");
			$saldo_vx = mysqli_fetch_all($saldo_vx);
			foreach($saldo_vx as $sv){
				echo '
				<tr>
				<td>&nbsp' . $h[0] . '</td>
				<td>&nbsp' . $sv[0] . '</td>
				';

				for ($i = 1; $i <= 8; $i++) {
					echo '
						<td>&nbsp0<br>&nbsp0<br>&nbsp0</td>
					';
				}
			}

			for ($i=9; $i <= 12; $i++){
				$ved = mysqli_query($connect, query: 
					"SELECT charges.charge, payments.payment, saldo.saldo from `payments`, `charges`, `saldo`
					where (payments.month = $i) and (payments.year = 2022)
					and (charges.month = $i) and (charges.year = 2022)
					and (saldo.month = $i) and (saldo.year = 2022)
					and (payments.num_apartment = $h[0]) and (charges.num_apartment = $h[0]) and (saldo.num_apartment = $h[0])")
				or die ("Ошибка получения запроса из таблиц payments, charges, saldo");
				$ved = mysqli_fetch_all($ved);
	
				foreach($ved as $v){
					if($i==9){
						echo '
							<td>&nbsp' . $v[0] . '&nbsp<br>&nbsp' . $v[1] . '&nbsp<br>&nbsp' . $vv[0] = $v[0]-$v[1]+$sv[0] . '&nbsp</td>
						';
						}
						if ($i==10){
							echo'
							<td>&nbsp' . $v[0] . '&nbsp<br>&nbsp' . $v[1] . '&nbsp<br>&nbsp' . $vv[1] = $v[0]-$v[1]+(int)$vv[0]. '&nbsp</td>
							';
						}
						if ($i==11){
							echo'
							<td>&nbsp' . $v[0] . '&nbsp<br>&nbsp' . $v[1] . '&nbsp<br>&nbsp' . $vv[2] = $v[0]-$v[1]+(int)$vv[1]. '&nbsp</td>
							';
						}
						if ($i==12){
							echo'
							<td>&nbsp' . $v[0] . '&nbsp<br>&nbsp' . $v[1] . '&nbsp<br>&nbsp' . $vv[3] = $v[0]-$v[1]+(int)$vv[2]. '&nbsp</td>
							';
						}
					}
					
					if ($i == 12) {
						echo '<td>&nbsp' . $vv[3] . '&nbsp</td>';
					}
				}
			}
		?>
	</table>
   </menu>
  </center>
 </body>
</html>