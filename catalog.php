<button class="btn" onclick="location.href='index.php?page=add';" class="catalog_2" style="float: left;">Добавить</button>
<table class="addtable"  border="1">
	<tr>
		<th width="20%">Название товара</th>
		<th width="25%">Бренд</th>
		<th width="20%">Год модели</th>
		<th width="15%">Описание</th>
	</tr>

	<?php
			$host="localhost"; 
			$user="scalesrzn_phplab"; 
			$pass="WCHx&Z2l";
			$database='scalesrzn_phplab';
	$dbh = mysqli_connect($host, $user, $pass, $database);
	if (isset($_POST['delete']) && isset($_POST['cbs']))
	{
		$cbs = $_POST['cbs'];
		$count = count($_POST['cbs']);
		for ($i = 0; $i < $count; $i++) 
		{
			$del = $cbs[$i];
			$result = mysqli_query($dbh, "SELECT * FROM ITEMS WHERE nametovar='$del'") or die("Сбой при доступе к БД1: " );
			$row = mysqli_fetch_row($result);
			if (!empty($row[7]))
			{
				unlink($row[7]);
			}
			mysqli_query($dbh, "DELETE FROM ITEMS WHERE nametovar='$del'") or die("Сбой при доступе к БД: " );
		}
	}

	$query = "SELECT * FROM ITEMS ORDER BY nametovar";
	$result = mysqli_query($dbh, $query) or die ("Сбой при доступе к БД: " );
	while ($row = mysqli_fetch_row($result)) 
	{
		echo "
		<tr>
			<td>
				<a href='index.php?page=item&id=$row[0]'>
					$row[0]
				</a>
			</td>
			<td>$row[1]</td>
			<td>$row[2]</td>
			<td>$row[3]</td>
			<td>
				<form method='POST'>
				<input type='checkbox' name='cbs[]' value=$row[0] />
			</td>
		</tr>";
	}
	echo "
	<input class='btn' id='delete' type='submit' name='delete' value='Удалить' class='catalog_2'/>
	</form>
	</table>
	";
	?>
