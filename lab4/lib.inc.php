<?php
function getMenu($menu, $vertical=true) {
  $style = "";

  if(!$vertical)
  {
	 $style = "display:inline;";
 }
 echo '<ul  style="list-style-type:none">';
 foreach ($menu as $link=>$href)
 {
  echo "<li style='$style'><a class='button' style='margin: 0 0 0 0' href=\"$href\">", $link, '</a></li>';
}

echo '</ul>';
}

function SimvolInString($Stroka,$Simvol) {
   return substr_count($Stroka,$Simvol);
}

function My_Count($MyParam) {
	// $MyParam = new aClass;
	$MyParam = array(1, 2, 3, 7, 8, 9, 10);

	$m_count = 0;

	if (isset($MyParam) == false) 
		$m_count = 0;
	else
		if (is_array($MyParam) or is_object($MyParam)) {//делаем расчет
			if(is_null($MyParam)) 
				$m_count = 0;
			else {
				foreach ($MyParam as &$value) {
					$m_count = $m_count + 1;
				}
			}
		}
		else $m_count = 1;
   		return $m_count; //$m_count; 
}

class aClass {
  var $protected_property = 'protected_value';
  var $private_property = 'private_value';
  var $public_property = 'public_value';
}

function clearData($data) {
  	return trim(strip_tags($data));
}

function imageCheck()
	{
		if ($_FILES['uploadfile']['type'] == "image/jpeg")
		{
			if ($_FILES['uploadfile']['size']<=1024000)
				return 1;
			else
				return "Размер файла не должен превышать 1000Кб";
		}
		else
			return "Файл должен иметь jpeg-расширение";
	}

	
	function resize($file)
    {
        global $tmp_path;
        // Ограничение по ширине в пикселях
        $max_size = 250;
        // Cоздаём исходное изображение на основе исходного файла
        $src = imagecreatefromjpeg($file['tmp_name']); //@
        // Определяем ширину и высоту изображения
        $w_src = imagesx($src);
        $h_src = imagesy($src);
        // Если ширина больше заданной
        if ($w_src > $max_size)
        {
            // Вычисление пропорций
            $ratio = $w_src/$max_size;
            $w_dest = round($w_src/$ratio);
            $h_dest = round($h_src/$ratio);
            // Создаём пустую картинку
            $dest = imagecreatetruecolor($w_dest, $h_dest);
            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
            // Вывод картинки и очистка памяти
            imagejpeg($dest, $tmp_path . $file['name']);
            imagedestroy($dest);
            imagedestroy($src);
            return $file['name'];
        }
        else
        {
            // Вывод картинки и очистка памяти
            imagejpeg($src, $tmp_path . $file['name']);
            imagedestroy($src);
            return $file['name'];
        }
    }

function getTableInfo($host, $user, $pass)
{
	$dbh = ibase_connect($host, $user, $pass);
	$query = "SELECT R.RDB\$RELATION_NAME AS RELATION_NAME, R.RDB\$FIELD_NAME AS FIELD_NAME, F.RDB\$FIELD_LENGTH AS FIELD_LENGTH, T.RDB\$TYPE_NAME AS TYPE_NAME, CASE R.RDB\$NULL_FLAG WHEN 1 THEN 'TRUE' ELSE 'FALSE' END AS NULL_FLAG, R.RDB\$FIELD_POSITION AS FIELD_POSITION
	FROM RDB\$FIELDS F, RDB\$RELATION_FIELDS R, RDB\$TYPES T 
	WHERE (F.RDB\$FIELD_NAME = R.RDB\$FIELD_SOURCE) AND (R.RDB\$SYSTEM_FLAG = 0) AND (F.RDB\$FIELD_TYPE = T.RDB\$TYPE) AND (T.RDB\$FIELD_NAME = 'RDB\$FIELD_TYPE') ORDER BY RELATION_NAME;";
	$result = ibase_query($dbh, $query);
	echo "<table border='1' width='60%'><tr>
		  <th width='20%'>Таблица</th>
		  <th width='20%'>Поле</th>
		  <th width='10%'>Тип</th>
		  <th width='10%'>Длина</th>
		  <th width='30%'>Ограничение на NULL</th>
		  <th width='10%'>Позиция</th></tr>";
	while ($rows = ibase_fetch_object($result)) 
	{ 
	    echo "<tr><td>$rows->RELATION_NAME</td><td>$rows->FIELD_NAME</td><td>$rows->TYPE_NAME</td><td>$rows->FIELD_LENGTH</td><td>$rows->NULL_FLAG</td><td>$rows->FIELD_POSITION</td></tr>";
	}
	echo "</table>";
}
	
   ?>