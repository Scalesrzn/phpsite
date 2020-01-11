<footer>
	<div style="padding: 10px 0; margin: auto;">
		<?php date_default_timezone_set('Europe/Moscow')?>
		<p style="text-align: center; margin: 0;">
			© 2019
			<b>Ваш последний визит:</b> <?=$dateVisit?> 
			<b>Текущая дата и время:</b> <?=date("d.m.Y H:i")?> 
			<b>Powered by</b> <?=$_SERVER['SERVER_SOFTWARE']?>
		</p>  
	</div>
</footer>