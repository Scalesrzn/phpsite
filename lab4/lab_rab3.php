<h1> Индивидуальное задание </h1>
<table class="contant">
	<tr>
		<td class="content_td">
			<table>
				<h3>Тестирование</h3>
				<form action="index.php?page=lab3" method="post">
					<div>
						<p><strong>Вопрос №1:</strong> Тело цикла заключается между служебными словами</p>
						<p><input type="radio" name="loopbody" value="for .... do" checked="checked">for .... do</p>
						<p><input type="radio" name="loopbody" value="to ..... do"> to ..... do</p>
						<p><input type="radio" name="loopbody" value="begin ..... end"> begin ..... end</p>
						<p><input type="radio" name="loopbody" value="begin ..... do"> begin ..... do</p>
					</div>
					<div>
						<p><strong>Вопрос №2:</strong> Сколько в одном байте бит?</p>
						<p><input type="text" name="byte_of_bit" placeholder="введите ответ" /></p>
					</div>
					<div>
						<p><strong>Вопрос №3:</strong> Какое расширение у исполняемых файлов?</p>
						<p><input type="radio" name="expansion" value="exe, doс" checked="checked" > exe, doс</p>
						<p><input type="radio" name="expansion" value="bak, bat"> bak, bat</p>
						<p><input type="radio" name="expansion" value="exe, com, bat"> exe, com, bat</p>
					</div>

					<div>
						<p><strong>Вопрос №4:</strong> По какому протоколу происходит взаимодействие клиента с сервером при работе на WWW?</p>
						<p><input type="radio" name="protocol" value="URL" checked="checked"> URL</p>
						<p><input type="radio" name="protocol" value="HTTP"> HTTP</p>
						<p><input type="radio" name="protocol" value="HTML"> HTML</p>
					</div>

					<div>
						<p><strong>Вопрос №5:</strong> Что относится к операционной системе?</p>
						<p><input type="checkbox" name="opersyst1" value="MS DOS"> MS DOS</p>
						<p><input type="checkbox" name="opersyst2" value="Windows"> Windows</p>
						<p><input type="checkbox" name="opersyst3" value="Norton Commander"> Norton Commander</p>
					</div>

					<div>
						<p><strong>Вопрос №6:</strong> Введите аббревиатуру название модели взаимодействия открытых систем</p>
						<p><input type="text" name="model" placeholder="введите сюда ответ" /></p>
					</div>

					<div class="element">
						<p><input type="submit" name = "doGo" value="отправить результаты ответов" /></p>
					</div>
				</form>
			</table>
		</td>
	</tr>
</table>

<?php
if (isset($_REQUEST['doGo'])) {
	$Loopbody = $_POST['loopbody'];
	$Byte_of_bit = $_POST['byte_of_bit'];
	$Expansion = $_POST['expansion']; 
	$Protocol = $_POST['protocol'];
	$Model = $_POST['model'];
	$Opersyst1 = @$_POST['opersyst1'];
	$Opersyst2 = @$_POST['opersyst2'];
	$Opersyst3 = @$_POST['opersyst3'];
	$result = 0; 

	if ($Loopbody == "begin ..... end") $result += 1;
	if ($Expansion == "exe, com, bat") $result += 1;
	if ($Byte_of_bit == "8") $result += 1;
	if ($Protocol == "HTTP") $result += 1;
	if ($Model == "OSI") $result += 1;

	$subresult = 0; 
	if ($Opersyst1 != '') $subresult++;
	if ($Opersyst2 != '') $subresult++;
	if ($Opersyst3 != '') $subresult--;
	if ($subresult == 2) $result += 1;

	echo "<center>Вы прошли тест на <strong>$result правильных ответов из 6</strong></center>";

}
?>

<?php
if (isset($_REQUEST['doGo'])) { ?>
		<h3>Правильные ответы</h3>
		<table border="1">
			<tr>
				<th>Вопрос №1 </th>
				<td>begin ..... end</td>
			</tr>
			<tr>
				<th>Вопрос №2 </th>
				<td>8</td>
			</tr>
			<tr>
				<th>Вопрос №3 </th>
				<td>exe, com, bat</td>
			</tr>
			<tr>
				<th>Вопрос №4 </th>
				<td>HTTP</td>
			</tr>
			<tr>
				<th>Вопрос №5 </th>
				<td>MS DOS, Windows</td>
			</tr>
			<tr>
				<th>Вопрос №6 </th>
				<td>OSI</td>
			</tr>
		</table> 
<?php } ?>
