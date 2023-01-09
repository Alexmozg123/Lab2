<?php 
require_once '../config/connect.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Charges</title>
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
        <table>
            <tr>
                <th>id</th>
                <th>account</th>
                <th>apartment</th>
                <th>payment</th>
                <th>month</th>
                <th>year</th>
            </tr>

            <?php
                $payments = mysqli_query($connect, query: "SELECT * FROM `payments`");
                $payments = mysqli_fetch_all($payments);
                foreach ($payments as $payment){
                    ?>
                    <tr>
                        <td><?=$payment[0]?></td>
                        <td><?=$payment[1]?></td>
                        <td><?=$payment[2]?></td>
                        <td><?=$payment[3]?></td>
                        <td><?=$payment[4]?></td>
                        <td><?=$payment[5]?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        <h1>Добавить новые данные</h1>
        <form action="../function/AddPayments.php" method="post">
            <p>Начисления</p>
            <input type="number" name="payments">
            <p>Месяц</p>
            <input type="number" name="month"> 
            <p>Год</p>
            <input type="number" name="year">
            <p>Charges_id</p>
            <input type="number" name="charges_id">
            <button type="submit">Добавить</button>
        </form>
    </center>
    </body>
</html>