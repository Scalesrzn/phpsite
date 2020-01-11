<button onclick="location.href='index.php?page=add';" class="catalog_2" style="float: left;">Добавить</button>
<table class="data_table"  border="1">
	<tr>
		<th width="10%">ID</th>
		<th width="20%">Название</th>
		<th width="25%">Страна</th>
		<th width="20%">Бренд</th>
		<th width="15%">Цена</th>
		<th width="15%">Дата поступления</th>
		<th width="5%">Х</th>
	</tr>

	<?php
	$dbh = ibase_connect($host, $user, $pass);
	if (isset($_POST['delete']) && isset($_POST['cbs']))
	{
		$cbs = $_POST['cbs'];
		$count = count($_POST['cbs']);
		for ($i = 0; $i < $count; $i++) 
		{
			$del = $cbs[$i];
			$result = ibase_query($dbh, "SELECT * FROM ITEMS WHERE ID='$del'") or die("Сбой при доступе к БД: " . ibase_errmsg());
			$row = ibase_fetch_row($result);
			if (!empty($row[7]))
			{
				unlink($row[7]);
			}
			ibase_query($dbh, "DELETE FROM ITEMS WHERE ID='$del'") or die("Сбой при доступе к БД: " . ibase_errmsg());
		}
	}

	$query = "SELECT * FROM ITEMS ORDER BY ID";
	$result = ibase_query($dbh, $query) or die ("Сбой при доступе к БД: " . ibase_errmsg());
	while ($row = ibase_fetch_row($result)) 
	{
		echo "
		<tr>
			<td>$row[0]</td>
			<td>
				<a href='index.php?page=item&id=$row[0]'>
					$row[1]
				</a>
			</td>
			<td>$row[2]</td>
			<td>$row[3]</td>
			<td>$row[4]</td>
			<td>$row[5]</td>
			<td>
				<form method='POST'>
				<input type='checkbox' name='cbs[]' value=$row[0] />
			</td>
		</tr>";
	}
	echo "
	<input id='delete' type='submit' name='delete' value='Удалить' class='catalog_2'/>
	</form>
	</table>
	";
	?>
