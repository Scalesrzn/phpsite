<?php
$id = clearData($_GET['id']);	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {		
	if (!empty($_POST['name']) && !empty($_POST['autors']) && !empty($_POST['year']) && !empty($_POST['description'])) {	
		if ($_FILES['uploadfile']['tmp_name']) {				
				$a = loadImage("edit"); // получаем массив , содержащий сообщение в случае ошибки и ссылку на изображение			
				if (empty($a['mess'])) {
					$_SESSION['catalog'][$id] = array("name"=>clearData($_POST['name']),
						"autors"=>clearData($_POST['autors']),
						"year"=>clearData($_POST['year']),
						"description"=>clearData($_POST['description']),
						"image"=>$a['src']);			
					header("Location: index.php?page=catalog");
					exit;
				}
				else { 
					echo $a['mess'];
				}
			}
			else {		
				$src = $_SESSION['catalog'][$id]['image'];
				$_SESSION['catalog'][$id] = array("name"=>clearData($_POST['name']),
					"autors"=>clearData($_POST['autors']),
					"year"=>clearData($_POST['year']),
					"description"=>clearData($_POST['description']),
					"image"=>$src);			
				header("Location: index.php?page=catalog");
				exit;
			}
		}
		else 
			echo '<font size="5" color="DarkRed"><strong>Заполните все поля!</strong></font>';		
	}
	?>
	
	<h2 style="margin: 10px 100px 30px 200px;">Редактирование методич.указаний</h2>
	<form method='POST' action='index.php?page=edit&id=<?php echo $id; ?>' ENCTYPE='multipart/form-data'>			
		<table>
			<tr>
				<th>Название методич.указания:</th>
				<td><input type='text' name='name' value='<?=$_SESSION['catalog'][$id]['name']?>' size="35"></td>
			</tr>
			<tr>
				<th>Авторы:</th> 
				<td><input type='text' name='autors' value='<?=$_SESSION['catalog'][$id]['autors']?>' size="35"></td>
			</tr >
			<tr>
				<th>Год издания:</th>
				<td><input type='text' name='year' value='<?=$_SESSION['catalog'][$id]['year']?>' size='4'>&nbsp;год</td>
			</tr>
			<tr>
				<th>Описание:</th>
				<td><textarea name='description' rows='10' cols='50' style="resize:none;" ><?=$_SESSION['catalog'][$id]['description']?></textarea></td>
			</tr>
			<tr>
				<th>Изображение:</th> 
				<td><input type='file' name='uploadfile'></td>
			</tr>
		</table>
		<center><p><input type='submit' value='Сохранить'></p></center>
	</form>