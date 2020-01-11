<?php
$file_path = 'Images/';
if ($_SERVER['REQUEST_METHOD'] == 'GET')   $id = clearData($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST')  $id = clearData($_POST['id']);

$dbh = mysqli_connect($host, $user, $pass);
$result = mysqli_query($dbh, "SELECT * FROM ITEMS WHERE ID='$id'") or die ("Сбой при доступе к БД: " );
$row = mysqli_fetch_row($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['brand']) && !empty($_POST['year']) && !empty($_POST['description']))
	{
		$nametovar = clearData($_POST['nametovar']);
		$total_items = mysqli_fetch_row(mysqli_query($dbh,"SELECT COUNT(*) FROM ITEMS WHERE nametovar='$nametovar' AND ID<>'$id'"));
		if ($total_items[0] < 1)
		{
			$brand = clearData($_POST['brand']);
			$year = clearData($_POST['year']);
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
				
				$query = "UPDATE ITEMS SET nametovar='$nametovar',brand='$brand',year='$year',DESCRIPTION='$description',uploadlink='$uploadlink' WHERE ID='$id'";
			}
			else
			{
				
				$query = "UPDATE ITEMS SET nametovar='$nametovar',brand='$brand',year='$year',DESCRIPTION='$description' WHERE ID='$id'";
			}
			mysqli_query($dbh, $query) or die ("Сбой при доступе к БД: " );
			header("Location: index.php?page=catalog");
		}
		else echo 'Такая косметика уже добавлена';
	}
	else echo 'Полностью заполните форму';	
}

?>
	
	<h2 style="margin: 10px 100px 30px 200px;">Редактирование товара</h2>
	<form method='POST' action='index.php?page=edit&id=<?php echo $id; ?>' ENCTYPE='multipart/form-data'>			
		<input type='text' hidden name='id' value='<?=$row[0]?>'>	
		<table>
			<tr>
				<th>Название товара:</th>
				<td><input type='text' name='nametovar' value='<?=$row[1]?>' size="35"></td>
			</tr>
			<tr>
				<th>Бренд:</th> 
				<td><input type='text' name='brand' value='<?=$row[2]?>' size="35"></td>
			</tr >
			<tr>
				<th>Год модели:</th>
				<td><input type='text' name='year' value='<?=$row[3]?>' size='4'>&nbsp;год</td>
			</tr>
			<tr>
				<th>Описание:</th>
				<td><textarea name='description' rows='10' cols='50' style="resize:none;" ><?=$row[4]?></textarea></td>
			</tr>
			<tr>
				<th>Изображение:</th> 
				<td><input type='file' name='uploadfile'></td>
			</tr>
		</table>
		<center><p><input class="btn" type='submit' value='Сохранить'></p></center>
	</form>