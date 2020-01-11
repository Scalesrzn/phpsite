<header>
	<p class="header-text">#FACEAWARDSITALY</p>
	<a href="index.php">
		<img src="Images/logoo.jpg" alt="Логотип" class="header-logo">
	</a>	
	<p class="header-text">#FACEAWARDSITALY</p>
	<?php
	if (!empty($_SESSION['user_login']))
		echo "
		<div class='welcomemsg'>
			<b>Пользователь: {$_SESSION['user_login']} |</b> 
			<a class='button' href='index.php?logout=true'> Выход</a>
		</div>";
	?>
</header>