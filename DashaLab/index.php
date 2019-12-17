<?php
session_start();
ob_start();
ini_set('display_errors',1);
date_default_timezone_set('Europe/Moscow');
header("Content-Type: text/html; charset=utf-8");
header("Cache-control: no-store");
include "lib.inc.php";
if (isset($_COOKIE['dateVisit']))
	$dateVisit = $_COOKIE['dateVisit'];
setcookie('dateVisit',date('Y-m-d H:i:s'),time()+0xFFFFFFF);
	//Инициализация переменных
$page = "";

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Академия знаний</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<table class="table">
	<tr>
		<td colspan="2" style="height:15%">
			<!-- Верхняя часть сайта --> 
			<?php include "top.inc.php" ?>
		</td>
	</tr>
	<tr>
		<td style="width:20%; height:100%">
			<!-- Меню сайта -->
			<?php include "menu.inc.php "?>
		</td>
		<td style="height:100%">
			<table class="content">
				<tr>
					<td class="content_td">
						<!-- Область основного контента сайта -->
						<div>
							<?php
							if (!empty($_GET['page']))
								$page = $_GET['page'];
							require 'auth.php';
							if (empty($page)) {
								?>
								<h2>Добро пожаловать, студент!</h2>
								<p>Любой ВУЗ - это живой организм, который развивается и действует по своим законам. Вбирая и аккумулируя в себе все новое, передовое, прогрессивное, он является единением умов и рук, сосредоточением сил и знаний, что позволяет не просто идти в ногу со временем, но и на полшага опережать его. Такое поступательное движение характерно и для нашего университета.</p>
								<p>С учетом требований времени университет готовит специалистов, отвечающих потребностям рынка, идет непрерывный процесс совершенствования существующих и создания новых образовательных программ. Многое делается впервые: открываются новые кафедры, появляются новые специальности и направления. Иными словами, делается все, чтобы наши выпускники всегда были востребованы на рынке труда. Правильный выбор во многом определит Ваш трудовой путь. Диплом университета – гарантия трудоустройства, успеха, благополучия!</p>
								<p>Поступайте к нам, у нас созданы все условия для учебы и быта, чтобы Вы стали хорошими специалистами в различных отраслях народного хозяйства. С нашими дипломами нет безработных!</p>
							</div>
							<p><img src="image/glavn.png" alt="О ВУЗе" style="width:600px; height:250px"/></p>
							<?php 
						}
						else switch($page)
						{
							case 'lab1': 
							include 'lab_rab1.html'; break;
							case 'lab2': 
							include 'lab_rab2.php'; break;
							case 'lab3': 
							include 'lab_rab3.php'; break;				
							case 'catalog':
							include 'catalog.php'; break;	
							case 'add': 
							include 'add.php'; break;
							case 'item': 
							include 'item.php'; break;	
							case 'edit': 
							include 'edit.php'; break;	
						}		
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="height:5%">
			<!-- Нижняя часть сайта --> 
			<?php include "bottom.inc.php" ?>
		</td>
	</tr>
</table>
</body>
</html>

