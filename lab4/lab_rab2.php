<h1> Индивидуальное задание </h1>
<table class="contant">
	<tr>
		<td class="content_td">
			<table>
				<h3> Определить количество букв "а", "Н" и "к" в строке </h3>
				<form action="index.php?page=lab2" method = "post">
					<b>Введите строку: </b>
					<input type="text" name="Stroka" ><br>
					<input type=submit  style = "margin: 20px 0 0 200px; 
					"name="Enter_do" value="Посчитать">
				</form>
				<?php
				if (isset($_POST['Enter_do']))
				{
					if ($_POST['Stroka'] !== '') {
						$ch_c = ($_POST['Stroka']);
						$count_a = SimvolInString($ch_c ,'а');
						$count_Н = SimvolInString($ch_c ,'Н');
						$count_к = SimvolInString($ch_c ,'к');
					}
				}
				?>
				<tr>
					<td>
						<p>число букв а: </p>
					</td>
					<td>
						<?php if (isset($_POST['Enter_do']) && ($_POST['Stroka'] !== ''))  echo $count_a ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>число букв Н: </p>
					</td>
					<td>
						<?php if (isset($_POST['Enter_do'])  && ($_POST['Stroka'] !== '')) echo $count_Н ?>
					</td>
				</tr>
				<tr>
					<td>
						<p>число букв к: </p>
					</td>
					<td>
						<?php if (isset($_POST['Enter_do'])  && ($_POST['Stroka'] !== '')) echo $count_к ?>
					</td>
				</tr>
			</table>
			<table>
				<h3>Имитация функции count </h3>
				<form action="index.php?page=lab2" method = "post">
					<b>Введите строку: </b>
					<input type="text" name="StrokaCount" ><br>
					<input type=submit style = "margin: 20px 0 0 200px;" name="Enter_do_Count" value="Посчитать">
				</form>

				<?php
				if (isset($_POST['Enter_do_Count']))
				{
					if ($_POST['StrokaCount'] !== '') {

						$ch_c = ($_POST['StrokaCount']);

						$count_str = My_Count($ch_c);
					}
				}	
				?>
				<tr>
					<td>
						<p>число символов: </p>
					</td>
					<td>
						<?php if (isset($_POST['Enter_do_Count']) && ($_POST['StrokaCount'] !== ''))  echo $count_str ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>
