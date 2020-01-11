<!-- <?php   
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
	if (!empty($_POST['name']) && !empty($_POST['brand']) && !empty($_POST['year']) && !empty($_POST['description'])) {	if ($_FILES['uploadfile']['tmp_name']) {
		$a = loadImage("add");		
		if (empty($a['mess'])) {
			if (empty($_SESSION['catalog'])) 
				$_SESSION['catalog']=array(array("name"=>clearData($_POST['name']),
					"brand"=>clearData($_POST['brand']),
					"year"=>clearData($_POST['year']),
					"description"=>clearData($_POST['description']),
					"image"=>$a['src']));
			else array_push($_SESSION['catalog'], array("name"=>clearData($_POST['name']),
				"brand"=>clearData($_POST['brand']),
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
				"brand"=>clearData($_POST['brand']),
				"year"=>clearData($_POST['year']),
				"description"=>clearData($_POST['description']),
				"image"=>""));
		else array_push($_SESSION['catalog'], array("name"=>clearData($_POST['name']),
			"brand"=>clearData($_POST['brand']),
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
?> -->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['nametovar']) && !empty($_POST['brand']) && !empty($_POST['year']) && !empty($_POST['description']))
	{
		$nametovar = clearData($_POST['nametovar']);
		$dbh = ibase_connect($host, $user, $pass);
		$total_items = ibase_fetch_row(ibase_query("SELECT COUNT(*) FROM ITEMS WHERE nametovar='$nametovar'"));
		if ($total_items[0] < 1)
		{
			$brand = clearData($_POST['brand']);
			$year = clearData($_POST['year']);
			$description = clearData($_POST['description']);

			if (!empty($_FILES['uploadfile']['nametovar']))
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
			$query = "INSERT INTO ITEMS (nametovar,brand,year,DESCRIPTION,uploadlink) VALUES ('$nametovar','$brand','$year','$description','$uploadlink')";
			ibase_query($dbh, $query) or die ("Сбой при доступе к БД: " . ibase_errmsg());
			header("Location: index.php?page=catalog");
		}
		else echo 'Такая косметика уже добавлена';
	}
	else echo 'Полностью заполните форму';
}
?>


<h2 style="margin: 10px 100px 30px 200px;">Добавить товар</h2>
<form class="addtable" method='POST' action='index.php?page=add' ENCTYPE='multipart/form-data'>			
	<table>
		<tr>
			<th>Товар:</th>
			<td><input type='text' name='nametovar' style="width:150%"></td>
		</tr>
		<tr>
			<th>Бренд:</th> 
			<td><input type='text' name='brand' style="width:150%"></td>
		</tr>			 			
		<tr>
			<th>Год модели:</th>
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
	<center><p><input class="btn" type='submit' value='Добавить' name='add' style="margin: 5px 0px 100px 100px"></p></center>
</form>