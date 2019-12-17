<table class="table">
	
	<tr>
		<td style="height:100%">
			<table class="content">
				<tr>
					<td class="content_td">
						<!-- Область основного контента сайта -->
						<p>Задание 1</p>
						<?php					
						$str = "Ryazan Radio Engineering University";
						$str2 = '';
						$count = strlen($str);
						for($i=1;$i<=$count;$i++){
							$str2 .= substr($str,-$i,1);
						}?>

						<table border="1">
							<tr>
								<th>Исходная строка:</th>
								<td><?=$str?></td>
							</tr>
							<tr>
								<th>Измененная строка:</th>
								<td><?=$str2?></td>
							</tr>
						</table>
						<p></p>

						<?php	
						function mysort(array $arr) {
							$count = count($arr);
							if ($count <= 1) {
								return $arr;
							}
							for ($i = 0; $i < $count; $i++) {
								for ($j = $count - 1; $j > $i; $j--) {
									if ($arr[$j] < $arr[$j - 1]) {
										$tmp = $arr[$j];
										$arr[$j] = $arr[$j - 1];
										$arr[$j - 1] = $tmp;
									}
								}
							}
							return $arr;
						}
						$massive = array(2, 1, 80, 150, 1000, 42, 49, 200, 785, 4, 93254);
						?>

						<p>Задание 2</p>
						<table border="1">
							<tr>
								<th>Исходный массив:</th>
								<td><?php foreach ($massive as &$element) {
									echo $element. ' ';
								}?></td>
							</tr>
							<tr>
								<th>Измененный массив:</th>
								<td><?php $massive = mysort($massive);
								foreach ($massive as &$element) {
									echo $element. ' ';
								}?></td>
							</tr>
						</table>
					</td>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
</body>
</html>