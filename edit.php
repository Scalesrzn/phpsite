<?php
$id = strip_tags(trim($_GET['id']));
$host = "localhost:".dirname(__FILE__)."\base.fdb";
$user="SYSDBA";
$pass="masterkey";
$dbh = ibase_connect($host, $user, $pass);
$query = "SELECT * FROM FILMS WHERE ID='$id'";
$result = ibase_query($dbh, $query) or die("Сбой при доступе к БД: " . ibase_errmsg());
$row = ibase_fetch_row($result);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!empty($_POST['name']) && !empty($_POST['genre']) && !empty($_POST['year']))
{
$name = strip_tags(trim($_POST['name']));
$genre = strip_tags(trim($_POST['genre']));
$year = strip_tags(trim($_POST['year']));
$query = "UPDATE FILMS SET NAME='$name', GENRE='$genre', RELEASE_YEAR='$year' WHERE ID='$id'";
ibase_query($dbh, $query) or die ("Сбой при доступе к БД: " . ibase_errmsg());
header('Location: catalog.php');
}
else echo 'Полностью заполните форму';
}
?>
<form method='POST'>
<p>Название:<input type='text' name='name' value='<?=$row[1]?>'></p>
<p>Жанр:<input type='text' name='genre' value='<?=$row[2]?>'></p>
<p>Год выпуска:<input type='text' name='year' value='<?=$row[3]?>'></p>
<p><input type='submit' value='Изменить'></p>
</form>
