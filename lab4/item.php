<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['id']))
{
	$id = clearData($_GET['id']);
	$dbh = ibase_connect($host, $user, $pass);
	$query = "SELECT * FROM ITEMS WHERE ID='$id'";
	$result = ibase_query($dbh, $query) or die("Сбой при доступе к БД: " . ibase_errmsg());
	$row = ibase_fetch_row($result);
}
?>
<br/>
<a href='index.php?page=catalog' style='margin-left:40px' class="catalog_2">Назад</a>
<a href='index.php?page=edit&id=<?=$row[0]?>' style='margin-left:20px' class="catalog_2">Редактировать</a>
<br/><br/>
<table class="data_table" border="1">
	<tr>
		<th width="20%">Название</th>
		<td colspan="2" width="45%"><?= $row[1] ?></td>
		<td rowspan="6"><img src="<?= $row[7] ?>" width="100%" height="100%"></td>
	</tr>
	<tr>
		<th width="15%">Страна</th>
		<td colspan="2"><?= $row[2] ?></td>
	</tr>
	<tr>
		<th width="15%">Категория</th>
		<td colspan="2"><?= $row[3] ?></td>
	</tr>
	<tr>
		<th width="15%">Цена</th>
		<td colspan="2"><?= $row[4] ?></td>
	</tr>
	<tr>
		<th width="15%">Дата поступления</th>
		<td colspan="2"><?= $row[5] ?></td>
	</tr>
	<tr height="250">
		<th width="15%">Описание</th>
		<td colspan="2"><?= $row[6] ?></td>
	</tr>
</table>
<br/>