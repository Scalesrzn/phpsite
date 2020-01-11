<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//Параметры подключения
$user = "SYSDBA"; 
$pass = "0";
$host = 'localhost:D:\BASE_TMP.fdb';
//$dbh = ibase_connect($host, $user, $pass);
//Создание БД
ibase_query(IBASE_CREATE, "CREATE DATABASE '$host' USER '$user' PASSWORD '$pass'");

ibase_close();
echo 'База данных успешно создана!</br>';
echo 'Структура базы данных:</br>';
$dbh = ibase_connect($host, $user, $pass);
//Начало транзакции
ibase_trans();
//Создание таблиц																		
ibase_query($dbh, "CREATE TABLE Users (id INTEGER primary key, name VARCHAR(60) not null, date_born DATE, adress VARCHAR(80) not null, phone SMALLINT)") or die ("Сбой при доступе к БД: " . ibase_errcode());
ibase_query($dbh, "CREATE TABLE Purchase (id INTEGER primary key, name VARCHAR(60) not null, cost INTEGER, userid INTEGER REFERENCES Users not null  , date_purchase TIMESTAMP)") or die ("Сбой при доступе к БД: " . ibase_errmsg());

$tablename = 'Users';
$primarykey = 'ID';

ibase_query($dbh, 'CREATE GENERATOR GEN_' . $tablename . '_PK;');
ibase_query($dbh, 'CREATE TRIGGER INC_' . $primarykey . ' FOR ' . $tablename
	. chr(13) . 'ACTIVE BEFORE INSERT POSITION 0'
	. chr(13) . 'AS'
	. chr(13) . 'BEGIN'
	. chr(13) . 'IF (NEW.' . $primarykey . ' IS NULL) THEN'
	. chr(13) . 'NEW.' . $primarykey . '= GEN_ID(GEN_' . $tablename . '_PK, 1);'
	. chr(13) . 'END');

$tablename = 'Purchase';
$primarykey = 'ID';
ibase_query($dbh, 'CREATE GENERATOR GEN_' . $tablename . '_PK;');
ibase_query($dbh, 'CREATE TRIGGER INC_2' . $primarykey . ' FOR ' . $tablename
	. chr(13) . 'ACTIVE BEFORE INSERT POSITION 0'
	. chr(13) . 'AS'
	. chr(13) . 'BEGIN'
	. chr(13) . 'IF (NEW.' . $primarykey . ' IS NULL) THEN'
	. chr(13) . 'NEW.' . $primarykey . '= GEN_ID(GEN_' . $tablename . '_PK, 1);'
	. chr(13) . 'END');

ibase_commit();
//Вывод информации о таблицах
getTableInfo($host, $user, $pass);
ibase_trans();
echo '</br>Измененная структура базы данных:</br>';
//Изменение структуры таблицы
$dbh = ibase_connect($host, $user, $pass);
ibase_query($dbh, "ALTER TABLE Purchase ADD description VARCHAR(50)");
ibase_query($dbh, "ALTER TABLE Users DROP phone");
ibase_query($dbh, "ALTER TABLE Users add email VARCHAR(50)");
ibase_commit();

//Вывод информации о таблицах
getTableInfo($host, $user, $pass);
$dbh = ibase_connect($host, $user, $pass);//хз
//Заполнение таблиц данными


ibase_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Иванов','Новосибирск','1996.11.15', 'ivanov@mail.ru')");
ibase_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Петров','Орел','1992.06.12','petrov@mail.ru')");
ibase_query($dbh, "INSERT INTO Users (name,adress,date_born,email) VALUES ('Сидоров','Москва','1998.02.03','sidorov@mail.ru')");

ibase_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Тени для век','550','1','2019.11.23 15:45:45', 'были разбиты')");
ibase_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Помада','670','2','2019.11.25 16:47:52', 'нет колпачка')");
ibase_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Хайлайтер','780','1','2019.11.26 17:34:25','недостатков нет')");
ibase_query($dbh, "INSERT INTO Purchase (name,cost,userid,date_purchase,description) VALUES ('Карандаш для глаз','560','1','2017.11.06 19:23:56','недостатков нет')");



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
$result = ibase_query($dbh, "SELECT Purchase.id, Purchase.name, Purchase.cost,Users.name, Purchase.date_purchase, Purchase.description FROM Purchase,Users WHERE Purchase.userid = Users.id ") or die ("Сбой при доступе к БД: " . ibase_errmsg());
while ($row = ibase_fetch_row($result)) 
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
$result = ibase_query($dbh, "SELECT * FROM Users") or die ("Сбой при доступе к БД: " . ibase_errmsg());
while ($row = ibase_fetch_row($result)) 
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
$result = ibase_query($dbh, "SELECT name,cost,date_purchase FROM Purchase WHERE userid=(select id from Users WHERE name='Иванов') AND cost>=300") or die ("Сбой при доступе к БД: " . ibase_errmsg());
while ($row = ibase_fetch_row($result)) 
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
$result = ibase_query($dbh, "SELECT U.name,P.Sum_purchase,P.Max_date FROM Users U, (SELECT userid,SUM(cost),MAX(date_purchase) FROM Purchase GROUP BY userid) AS P (userid,Sum_purchase,Max_date) WHERE P.userid=U.id") or die ("Сбой при доступе к БД: " . ibase_errmsg());
while ($row = ibase_fetch_row($result)) 
{
	echo "<tr>
	<td>$row[0]</td>
	<td>$row[1]</td>
	<td>$row[2]</td>
	</tr>";
}
echo '</table>';

//Удаление БД
ibase_drop_db();
//ibase_close();
//ibase_query($dbh, "drop database 'D:\BASE2.fdb'");
echo '</br>База данных успешно удалена!</br>';
?>