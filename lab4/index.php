<?php
session_start();
ob_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
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
	<title>Интернет-магазин косметики "NYX"</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>	
	<!-- шапка -->
	<?php include "top.inc.php" ?>
	<div style="display: flex; flex-wrap: wrap;">
		<?php include "menu.inc.php" ?>	
		<div class="container-body"> 
			<?php
			require 'base_registration.php';
			if (!empty($_GET['page']))
				$page = $_GET['page'];
			if ($page == 'reg')
			{
				include 'registration.php';
				exit;
			}
			require 'auth.php';
			if (empty($page)) {
				?>
				<h1> Профессиональная косметика </h1>
				<p class="body-text">
					<b>NYX PROFESSIONAL MAKEUP</b> - ЭТО КАЧЕСТВЕННАЯ ДЕКОРАТИВНАЯ КОСМЕТИКА, С ПОМОЩЬЮ КОТОРОЙ МОЖНО СДЕЛАТЬ САМЫЙ РАЗНООБРАЗНЫЙ МАКИЯЖ, ВОПЛОТИВ В ЖИЗНЬ ЛЮБОЙ ОБРАЗ. НА НАШЕМ САЙТЕ ТЫ МОЖЕШЬ ЗАКАЗАТЬ КОСМЕТИКУ ОНЛАЙН. ИЗВЕСТНАЯ ВО ВСЕМ МИРЕ МАРКА КОСМЕТИКИ NYX PROFESSIONAL MAKEUP НАЧАЛА ВЫПУСКАТЬСЯ В 1999 ГОДУ И С ТЕХ ПОР ЗАВОЕВАЛА НЕМАЛО ЖЕНСКИХ СЕРДЕЦ. С НАШЕЙ КОСМЕТИКОЙ МОЖНО ВОПЛОТИТЬ САМЫЕ СМЕЛЫЕ ОБРАЗЫ, И КАКОЙ БЫ МЕЙКАП ТЫ НИ ЗАДУМАЛА - МОЖЕШЬ БЫТЬ УВЕРЕНА, ЧТО С ТАКИМ АРСЕНАЛОМ ПОЛУЧИТСЯ НАСТОЯЩИЙ ШЕДЕВР. МАКИЯЖ В СТИЛЕ NUDE, БРОСКИЙ SMOKEY НА ВЕЧЕРИНКУ, CASUAL LOOK - NYX PROFESSIONAL MAKEUP ВСЕ ПО ПЛЕЧУ!.
				</p>
				<img src="Images/foto.jpg" class="body-foto" alt="Косметика">
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
				case 'lab4': 
				include 'lab_rab4.php'; break;				
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
		</div>
	</div>
	<?php include "bottom.inc.php" ?>
</body>
</html>