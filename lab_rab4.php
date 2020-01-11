<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//Параметры подключения
$user = "SYSDBA"; 
$pass = "0";
$host = 'localhost:D:\BASE_TMP.fdb';
//$dbh = mysqli_connect($host, $user, $pass);
//Создание БД
mysqli_query($dbh, "CREATE DATABASE '$host' USER '$user' PASSWORD '$pass'");

mysqli_close($dbh);
echo 'База данных успешно создана!</br>';
echo 'Структура базы данных:</br>';
$dbh = mysqli_connect($host, $user, $pass);
//Начало транзакции
//mysqli_trans();
//Создание таблиц																		
mysqli_query($dbh, "CREATE TABLE Users (id INTEGER primary key, name VARCHAR(60) not null, date_born DATE, adress VARCHAR(80) not null, phone SMALLINT)") or die ("Сбой при доступе к БД: " );
mysqli_query($dbh, "CREATE TABLE Purchase (id INTEGER primary key, name VARCHAR(60) not null, cost INTEGER, userid INTEGER REFERENCES Users not null  , date_purchase TIMESTAMP)") or die ("Сбой при доступе к БД: " );

$tablename = 'Users';
$primarykey = 'ID';

mysqli_query($dbh, 'CREATE GENERATOR GEN_' . $tablename . '_PK;');
mysqli_query($dbh, 'CREATE TRIGGER INC_' . $primarykey . ' FOR ' . $tablename
	. chr(13) . 'ACTIVE BEFORE INSERT POSITION 0'
	. chr(13) . 'AS'
	. chr(13) . 'BEGIN'
	. chr(13) . 'IF (NEW.' . $primarykey . ' IS NULL) THEN'
	. chr(13) . 'NEW.' . $primarykey . '= GEN_ID(GEN_' . $tablename . '_PK, 1);'
	. chr(13) . 'END');

$tablename = 'Purchase';
$primarykey = 'ID';
mysqli_query($dbh, 'CREATE GENERATOR GEN_' . $tablename . '_PK;');
mysqli_query($dbh, 'CREATE TRIGGER INC_2' . $primarykey . ' FOR ' . $tablename
	. chr(13) . 'ACTIVE BEFORE INSERT POSITION 0'
	. chr(13) . 'AS'
	. chr(13) . 'BEGIN'
	. chr(13) . 'IF (NEW.' . $primarykey . ' IS NULL) THEN'
	. chr(13) . 'NEW.' . $primarykey . '= GEN_ID(GEN_' . $tablename . '_PK, 1);'
	. chr(13) . 'END');

mysqli_commit($dbh);
//Вывод информации о таблицах
getTableInfo($host, $user, $pass);
//mysqli_trans($dbh);
echo '</br>Измененная структура базы данных:</br>';
//Изменение структуры таблицы
$dbh = mysqli_connect($host, $user, $pass);
mysqli_query($dbh, "ALTER TABLE Purchase ADD description VARCHAR(50)");
mysqli_query($dbh, "ALTER TABLE Users DROP phone");
mysqli_query($dbh, "ALTER TABLE Users add email VARCHAR(50)");
mysqli_commit($dbh);

//Вывод информации о таблицах
getTableInfo($host, $user, $pass);
$dbh = mysqli_connect($host, $user, $pass);//хз
//Заполнение таблиц данными


mysqli_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Иванов','Новосибирск','1996.11.15', 'ivanov@mail.ru')");
mysqli_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Петров','Орел','1992.06.12','petrov@mail.ru')");
mysqli_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Сидоров','Москва','1998.02.03','sidorov@mail.ru')");

mysqli_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Тени для век','550','1','2019.11.23 15:45:45', 'были разбиты')");
mysqli_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Помада','670','2','2019.11.25 16:47:52', 'нет колпачка')");
mysqli_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Хайлайтер','780','1','2019.11.26 17:34:25','недостатков нет')");
mysqli_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Карандаш для глаз','560','1','2017.11.06 19:23:56','недостатков нет')");



//Вывод содержимого таблиц
echo "</br>Таблица Purchase:</br><table border='1' width='80%'>
<tr>
<th width='10%'>ID</th>
<th width='30%'>Название товара</th>
<th width='15%''>Цена, руб</th>		
<th width='20%'>Имя покупателя</th>
<th width='20%'>Дата покупки</th>
<th width='20%'>Отзыв</th>
</tr>";
$result = mysqli_query($dbh, "SELECT Purchase.id, Purchase.name, Purchase.cost,Users.name, Purchase.date_purchase, Purchase.description FROM Purchase,Users WHERE Purchase.userid = Users.id ") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td>
	<td>$row[3]</td>
	<td>$row[4]</td>
	<td>$row[5]</td></tr>";
}
echo '</table>';
echo "</br>Таблица Users:</br><table border='1' width='80%'>
<tr>
<th width='10%'>ID</th>
<th width='30%'>Имя</th>
<th width='25%''>Адрес</th>
<th width='30%'>Дата рождения</th>
<th width='30%'>email</th>
</tr>";
$result = mysqli_query($dbh, "SELECT * FROM Users") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[3]</td>		
	<td>$row[2]</td>
	<td>$row[4]</td>
	</tr>";
}
echo '</table>';

//Вывод результатов первого запроса
echo "</br>Запрос №1:</br>
Вывести информацию о покупках Иванова, сумма которых более 500</br></br>

<table border='1' width='80%'>
<tr>
<th width='45%'>Название товара</th>
<th width='20%''>Цена, руб</th>
<th width='35%'>Дата покупки</th>
</tr>";
$result = mysqli_query($dbh, "SELECT name,cost,date_purchase FROM Purchase WHERE userid=(select id from Users WHERE name='Иванов') AND cost>=300") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td></tr>";
}
echo '</table>';

//Вывод результатов второго запроса
echo "</br>Запрос №2:</br>
Вывести информацию о покупках клиентов, определив дату последней покупки и сумму по всем заказам</br></br>

<table border='1' width='80%'>
<tr>
<th width='30%'>Имя</th>
<th width='20%'>Цена</th>
<th width='40%'>Дата покупки</th>
</tr>";
$result = mysqli_query($dbh, "SELECT U.name,P.Sum_purchase,P.Max_date FROM Users U, (SELECT userid,SUM(cost),MAX(date_purchase) FROM Purchase GROUP BY userid) AS P (userid,Sum_purchase,Max_date) WHERE P.userid=U.id") or die ("Сбой при доступе к БД: " );
while ($row = mysqli_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td>
	</tr>";
}
echo '</table>';

//Удаление БД
//mysqli_drop_db();
//mysqli_close();
//mysqli_query($dbh, "drop database 'D:\BASE2.fdb'");
echo '</br>База данных успешно удалена!</br>';
?>