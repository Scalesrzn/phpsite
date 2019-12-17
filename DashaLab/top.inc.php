<!-- Верхняя часть сайта --> 
<table class="top">
	<tr>
		<td style="width:10%">
			<a href="index.php"><img src="image/logo.png" alt="Логотип" class="header-logo"/></a>
		</td>
		<td>
			<img src="image/name.png" alt="Наименование"/>
		</td>
	</tr>
	<?php
	if (!empty($_SESSION['user_login']))
		echo "<div class='welcomemsg'>Добро пожаловать, <b>{$_SESSION['user_login']}!</b> <a class='button' href='index.php?logout=true'>  (Выйти)</a></div>";
	?>
</table>