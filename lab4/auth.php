﻿<?php
if (isset($_POST['login']) && isset($_POST['password']))
{
	$login = clearData($_POST['login']);
	$password = clearData($_POST['password']);
	$dbh = ibase_connect($host, $user, $pass); 

	
	$query = "SELECT * FROM USE WHERE LOGIN='$login' AND PASSWORD='$password'";
	$result = ibase_query($dbh, $query);
	if ($row = ibase_fetch_assoc($result)) 
	{
		session_start();
		$_SESSION['user_login'] = $row['LOGIN'];
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		exit;
	}
	else echo 'Вы неправильно ввели логин или пароль';
}

if (isset($_GET['logout'])) 
{
	session_start();
	session_destroy();
	header("Location: index.php");
	exit;
}

if (isset($_SESSION['user_login']) and $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) return;
else {
	?>
	<div class= "authorization">
		<table align="center" style="margin-left:40px">
			<tr>
				<td>
					<h3>Авторизируйтесь:</h3>
					<img src="Images/user.png" class="user-foto" alt="Пользователь">
					<form method="POST">
						<p>Логин:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="login" ><br>
							<p>Пароль:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" ><br>
								<p><input type="submit" value="Отправить"><br>
								</form>
								<button onclick="location.href='index.php?page=reg';">Зарегистрироваться</button>

							</td>
						</tr>
					</table>
				</div>
				<?php 
			}
			exit;
			?>
			