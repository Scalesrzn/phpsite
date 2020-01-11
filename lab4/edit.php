<?php
$file_path = 'Images/';
if ($_SERVER['REQUEST_METHOD'] == 'GET')   $id = clearData($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST')  $id = clearData($_POST['id']);

$dbh = ibase_connect($host, $user, $pass);
$result = ibase_query($dbh, "SELECT * FROM ITEMS WHERE ID='$id'") or die ("Сбой при доступе к БД: " . ibase_errmsg());
$row = ibase_fetch_row($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['strana']) && !empty($_POST['type']) && !empty($_POST['price']) && !empty($_POST['datepostup']) && !empty($_POST['description']))
	{
		$nametovar = clearData($_POST['nametovar']);
		$total_items = ibase_fetch_row(ibase_query("SELECT COUNT(*) FROM ITEMS WHERE nametovar='$nametovar' AND ID<>'$id'"));
		if ($total_items[0] < 1)
		{
			$strana = clearData($_POST['strana']);
			$type = clearData($_POST['type']);
			$price = clearData($_POST['price']);
			$datepostup = clearData($_POST['datepostup']);
			$description = clearData($_POST['description']);
			if (($nametovar <> $row[1]) or (!empty($_FILES['uploadfile']['name'])))
			{
				if ($nametovar <> $row[1])
				{
					rename($row[7], $file_path . $nametovar . '.jpg');
				}
				if (!empty($_FILES['uploadfile']['name']))
				{
					$tmp_path = 'tmp/';
					$result = imageCheck();
					if ($result == 1)
					{
						$name = resize($_FILES['uploadfile']);
						$uploadfile = $file_path . $name;
						if (@copy($tmp_path . $name, $file_path . $nametovar . '.jpg'))
							unlink($tmp_path . $name);
					}
					else
					{
						echo $result;
						exit;
					}
				}
				$uploadlink = $file_path . $nametovar . '.jpg';
				
				$query = "UPDATE ITEMS SET nametovar='$nametovar',strana='$strana',type='$type',price='$price',datepostup='$datepostup',DESCRIPTION='$description',uploadlink='$uploadlink' WHERE ID='$id'";
			}
			else
			{
				
				$query = "UPDATE ITEMS SET nametovar='$nametovar',strana='$strana',type='$type',price='$price',datepostup='$datepostup',DESCRIPTION='$description' WHERE ID='$id'";
			}
			ibase_query($dbh, $query) or die ("Сбой при доступе к БД: " . ibase_errmsg());
			header("Location: index.php?page=catalog");
		}
		else echo 'Такая косметика уже добавлена';
	}
	else echo 'Полностью заполните форму';	
}

?>

<center><h3>Редактировать товар</h3></center>
<table align='center'>
	<tr><td>
		<form method='POST' action='index.php?page=edit' ENCTYPE='multipart/form-data'>
			<input type='text' hidden name='id' value='<?=$row[0]?>'>
			<table>			
				<tr>
					<td>
						Название
					</td>
					<td>
						<input type='text' required name='nametovar' value='<?=$row[1]?>'>
					</td>
				</tr>
				
				<tr>
					<td>
						Страна производитель:
					</td>
					<td>
						<input type='text' required name='strana' value='<?=$row[2]?>'>
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
						<input type='text' required name='price' value='<?=$row[4]?>' pattern = "\d+(.\d{2})?">
					</td>
				</tr>
				<tr>
					<td>
						Дата поступления
					</td>
					<td>
						<input type='date' required name='datepostup' value='<?=$row[5]?>'>
					</td>
				</tr>
				<tr>
					<td>
						<p>Описание
						</td>
						<td>
							<textarea name='description' required cols='70' rows='10' style='resize:none'><?=$row[6]?></textarea></p>
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
							<center><p><input type='submit' value='Сохранить'></p></center> 
						</td>
					</tr>
				</table>
			</form>
		</td></tr>

	</table>
