<h2> Индивидуальное задание </h2>
<?php 
if ( !empty($_POST)){
	$fio ='';
	$age =0;
	$zp =0;
	$srok =0;
	$pr  =0;
	$sum  = 0;
	$odobrenie ='Не одобрено';
	$itogo =0 ;
	$mecsum   = 0;
	$fio =$_POST['fio'];
	$age =$_POST['age'];
	$zp =$_POST['zp'];
	$srok =$_POST['srok'];
	$pr  =$_POST['pr'];
	$sum  = $_POST['sum'];
	if( $age > 18 and $age < 80  ){ 
		$itogo = $sum / 100  * $pr  + $sum;
		$mecsum = $itogo / $srok;
		if ( $mecsum < $zp  ) {
			$odobrenie ='Одобрено'; 
		}
	}
}
?>
<tr>
	<td  class="content3">
		<p>Определить возможность получения кредита</p>
		<form  method="POST" >
			ФИО: <input type="" name="fio" value=""  placeholder= "Введите ФИО">	 <br>
			Возраст:<input type="" name="age" value="" placeholder= "Введите возраст">   <br>
			Зарплата:<input type="" name="zp" value="" placeholder= "Введите зарплату">  <br>
			Срок: <input type="" name="srok" value="" placeholder= "На сколько месяцев?"> 	 <br>
			Процент:<input type="" name="pr" value="" placeholder= "Введите процент"> 	 <br>
			Сумма:<input type="" name="sum" value="" placeholder= "Введите сумму">     <br>
			<input type="submit" name="" value="Посчитать">
		</form>
	</td>
</tr>
<tr>
	<td class="content4">
		<?php 
		if(!empty($_POST)){
			echo " <table border=1>
			<tr>
			<td>ФИО</td>
			<td>".$fio."</td>
			</tr>	
			<tr>
			<td>Возраст</td>
			<td>".$age."</td>
			</tr>	
			<tr>
			<td>Зарплата</td>
			<td>".$zp."</td>
			</tr>	
			<tr>
			<td>На сколько месяцев</td>
			<td>".$srok."</td>
			</tr>	
			<tr>
			<td>Процент</td>
			<td>".$pr."</td>
			</tr>	
			<tr>
			<td>Сумма</td>
			<td>".$sum."</td>
			</tr>	
			<tr>
			<td>Одобрение</td>
			<td>".$odobrenie."</td>
			</tr>	
			<tr>
			<td>Итого:</td>
			<td>".$itogo."</td>
			</tr>	
			<tr>
			<td>Плата каждый месяц</td>
			<td>".$mecsum."</td>
			</tr>	
			</table>";
		}
		?>
	</td>
</tr>