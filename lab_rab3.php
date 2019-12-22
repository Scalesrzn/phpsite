<?php
	session_start();
	$from = 1;
	$to = 10;
	$report = '';
	$story = array();
	if (isset($_POST['submit'])) {
		if (isset($_SESSION['count']) <=3)
			$_SESSION['count']++;
			$number = (int) $_POST['number'];
			array_push($story, $_SESSION['number'] );
			echo "<span> Вы вводили:  $story</span>";
			if ($_SESSION['count'] != 3){
				if ($number == $_SESSION['number']) {
					$report = 'Угадал с ' . $_SESSION['count'] . ' попыток';
					$_SESSION['count'] = 0;
					$_SESSION['number'] = mt_rand($from, $to);

				}
				else {
					echo "</br>Не угадал!";
				}
			}
			else{
				$_SESSION['count'] = 0;
				$_SESSION['number'] = mt_rand($from, $to);	
				echo 'Попытки кончились. Попробуй еще раз!';
			}
		
	} else {
		$_SESSION['number'] = mt_rand($from, $to);
		$_SESSION['count'] = 0;
		
	}
 
?>
        <div><?=$report ?></div>
        <form action="<?php $_SERVER['SCRIPT_NAME']?>" method="POST">
            <fieldset>
                <legend>Введите число от <?=$from ?> до <?=$to ?></legend>
                <label><p>
                <input type="text" name="number" /></p></label>
                <p><input class ='btn' type="submit" name="submit"  value="проверить"/></p>
                <p><input class ='btn' type="submit" name="reset" value="начать заново" /></p>
            </fieldset>
        </form>
