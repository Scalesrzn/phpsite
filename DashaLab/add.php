<?php   
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
	if (!empty($_POST['name']) && !empty($_POST['autors']) && !empty($_POST['year']) && !empty($_POST['description'])) {	if ($_FILES['uploadfile']['tmp_name']) {
		$a = loadImage("add");		
		if (empty($a['mess'])) {
			if (empty($_SESSION['catalog'])) 
				$_SESSION['catalog']=array(array("name"=>clearData($_POST['name']),
					"autors"=>clearData($_POST['autors']),
					"year"=>clearData($_POST['year']),
					"description"=>clearData($_POST['description']),
					"image"=>$a['src']));
			else array_push($_SESSION['catalog'], array("name"=>clearData($_POST['name']),
				"autors"=>clearData($_POST['autors']),
				"year"=>clearData($_POST['year']),
				"description"=>clearData($_POST['description']),
				"image"=>$a['src']));			
				header("Location: index.php?page=catalog");
			exit;
		}
		else { 
			echo $a['mess'];
		}
	}
	else {			
		if (empty($_SESSION['catalog'])) 
			$_SESSION['catalog']=array(array("name"=>clearData($_POST['name']),
				"autors"=>clearData($_POST['autors']),
				"year"=>clearData($_POST['year']),
				"description"=>clearData($_POST['description']),
				"image"=>""));
		else array_push($_SESSION['catalog'], array("name"=>clearData($_POST['name']),
			"autors"=>clearData($_POST['autors']),
			"year"=>clearData($_POST['year']),
			"description"=>clearData($_POST['description']),
			"image"=>""));			
			header("Location: index.php?page=catalog");
		exit;
	}
}
else 
	echo '<font size="5" color="DarkRed"><strong>Не все поля заполнены!</strong></font>';	
}
?>

<h2 style="margin: 10px 100px 30px 200px;">Добавить методическое указание</h2>
<form method='POST' action='index.php?page=add' ENCTYPE='multipart/form-data'>			
	<table>
		<tr>
			<th>Название методич.указания:</th>
			<td><input type='text' name='name' style="width:150%"></td>
		</tr>
		<tr>
			<th>Авторы:</th> 
			<td><input type='text' name='autors' style="width:150%"></td>
		</tr>			 			
		<tr>
			<th>Год издания:</th>
			<td><input type='text' name='year' size='4'>&nbsp;год</td>
		</tr>
		<tr>
			<th>Описание:</th>
			<td><textarea name='description' rows='10' style="resize:none; width:150%"></textarea></td>
		</tr>
		<tr>
			<th>Изображение:</th> 
			<td><input type='file' name='uploadfile' accept='image/jpeg'></td>
		</tr>
	</table>
	<center><p><input type='submit' value='Добавить' name='add' style="margin: 5px 0px 100px 100px"></p></center>
</form>