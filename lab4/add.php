<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['nametovar']) && !empty($_POST['strana']) && !empty($_POST['type']) && !empty($_POST['price']) && !empty($_POST['datepostup']) && !empty($_POST['description']))
	{
		$nametovar = clearData($_POST['nametovar']);
		$dbh = ibase_connect($host, $user, $pass);
		$total_items = ibase_fetch_row(ibase_query("SELECT COUNT(*) FROM ITEMS WHERE nametovar='$nametovar'"));
		if ($total_items[0] < 1)
		{
			$strana = clearData($_POST['strana']);
			$type = clearData($_POST['type']);
			$price = clearData($_POST['price']);
			$datepostup = clearData($_POST['datepostup']);
			$description = clearData($_POST['description']);
			if (!empty($_FILES['uploadfile']['name']))
			{
				$tmp_path = 'tmp/';
				$file_path = 'Images/';
				$result = imageCheck();
				if ($result == 1)
				{
					$name = resize($_FILES['uploadfile']);
					$uploadfile = $file_path . $name;
					if (@copy($tmp_path . $name, $file_path . $nametovar . '.jpg'))
						$uploadlink = $file_path . $nametovar . '.jpg';
					unlink($tmp_path . $name);
				}
				else
				{
					echo $result;
					exit;
				} 
			}
			$query = "INSERT INTO ITEMS (nametovar,strana,type,price,datepostup,DESCRIPTION,uploadlink) VALUES ('$nametovar','$strana','$type','$price','$datepostup','$description','$uploadlink')";
			ibase_query($dbh, $query) or die ("Сбой при доступе к БД: " . ibase_errmsg());
			header("Location: index.php?page=catalog");
		}
		else echo 'Такая косметика уже добавлена';
	}
	else echo 'Полностью заполните форму';
}
?>



<center><h3>Добавить товар</h3></center>
<table align='center'>
	<tr><td>
		<form method='POST' action='index.php?page=add' ENCTYPE='multipart/form-data'>
			<table>
				<tr>
					<td>
						Название
					</td>
					<td>
						<input type='text' required name='nametovar'>
					</td>
				</tr>
				
				<tr>
					<td>
						Страна производитель:
					</td>
					<td>
						<input type='text' required name='strana'>
					</td>
				</tr>
				<tr>
					<td>
						Бренд
					</td>
					<td>
						<select size='3' multiple required name='type'>
							<option value='Bioqua'>Bioqua</option>
							<option value='Imagess'>Imagess</option>
							<option value='Lador'>Lador</option>
						</select>
					</td>
				</tr>
				<tr>  
					<td>
						Цена
					</td>
					<td>
						<!--<input type='text' required name='cena'>  -->
						<input type='number_format' required name='price'  pattern = "\d+(.\d{2})?">
					</td>
				</tr>
				<tr>
					<td>
						Дата поступления
					</td>
					<td>
						<input type='date' required name='datepostup'>
					</td>
				</tr>
				<tr>
					<td>
						<p>Описание
						</td>
						<td>
							<textarea name='description' required cols='70' rows='10' style='resize:none'></textarea>
						</td>
					</tr>
					<tr>
						<td>
							Изображение
						</td>
						<td>
							<input type='file' accept=".jpg" name='uploadfile'>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<center><p><input type='submit' value='Добавить'></p></center> 
						</td>
					</tr>
				</table>

			</form>
		</td></tr>
	</table>



