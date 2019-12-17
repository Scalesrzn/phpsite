<?php
//Инициализация переменных
$name = "";
$age = "";
session_start();
if (isset($_POST['delete']) && isset($_POST['cbs']))
{
unset($_SESSION['Item']); //Удаление сессионной записи
}
if (!empty($_SESSION['Item']['name']))
{
$name = $_SESSION['Item']['name'];
$age = $_SESSION['Item']['age'];
}
echo "<table border='1' width='300'>
<tr>
<th width='70%'>Имя</th>
<th width='20%'>Возраст</th>
<th width='10%'></th>
</tr>
<tr>
<td>$name</td>
<td>$age</td>
<td>
<form method='POST'>
<input type='checkbox' name='cbs[]' value=$name />
</td></tr>
</table><input  id='delete' type='submit' class='button' name='delete' value='Удалить' style='position:relative;bottom:-25px;left:150px;' /></form>";
?>
<br/>
<button onclick="location.href='add.php';" style="margin-left:20px">Добавить</button>
