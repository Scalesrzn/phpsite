<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!empty($_POST['login_reg']) && !empty($_POST['password_1']) && !empty($_POST['password_2']) && !empty($_POST['email'])) 
	{
		if ($_POST['password_1'] == $_POST['password_2'])
		{
			$login_reg = clearData($_POST['login_reg']);
			$hash_password = clearData($_POST['password_1']);
			$email_reg = clearData($_POST['email']);
			
			$dbh = ibase_connect($host, $user, $pass); 
			$query = "INSERT INTO USE (LOGIN,PASSWORD,EMAIL) VALUES ('$login_reg','$hash_password','$email_reg')";
			if (ibase_query($dbh, $query)) header("Location: index.php");
			else echo "Сбой при вставке данных: " . ibase_errmsg();
			ibase_trans();
		}
		else echo 'Пароли не совпадают';
	}
	else echo 'Полностью заполните форму';
}
?>

<h3>Регистрация</h3>
<table class="data_table">
	<tr>
		<td><form method="POST">
			<table>
				<tr>
					<td>
						<label>Логин:</label>
					</td>
					<td>
						<input type="text" required name="login_reg" style="margin-left:30px">
					</td>
				</tr>	
				<tr>
					<td>
						<label>Пароль:</label>
					</td>
					<td>
						<input type="password" required name="password_1" style="margin-left:30px">
					</td>
				</tr>
				<tr>
					<td>
						<label>Повторите пароль:</label>
					</td>
					<td>
						<input type="password" required name="password_2" style="margin-left:30px">
					</td>
				</tr>	
				
				<tr>
					<td>
						<label>Email:</label>
					</td>
					<td>
						<input type="email" required name="email" style="margin-left:30px">
					</td>
				</tr>
				<tr><td></td>
					<td>
						<input type="submit" style="margin-left:30px;margin-top:30px">
					</td>
				</tr>
			</table>
		</form>
	</td>
</tr>
</table>