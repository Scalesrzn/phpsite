<?php
$menu = array(
"Главная"=>"index.php", 
"Работа №1"=>"index.php?page=lab1",
"Работа №2"=>"index.php?page=lab2",
"Работа №3"=>"index.php?page=lab3",
"Каталог"=>"index.php?page=catalog");
?>	
<?php
getMenu($menu);
?>

		 <!-- <div>
			<form action="index.html">
				<button formaction="index.php" class="btn">
					Главная
				</button>
			</form>
		</div>
		
		<div>
			<form action="lab_rab1.html">
				<button formaction="lab_rab1.php" class="btn">
					Лабораторная работа №1
				</button>
			</form>
		</div>

		<div>
			<form action="lab_rab2.html">
				<button formaction="lab_rab2.php" class="btn">
					Лабораторная работа №2
				</button>
			</form>
		</div> -->
       
        <?php

        $hideReview = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if ($hideReview == 'http://vrednayapolza.ru/' or $hideReview == 'http://vrednayapolza.ru/index.php?'  ){
            echo '<div>
                <form action="#review">
                    <button formaction="#review" class="btn">
                        Отзывы
                    </button>
                </form>
            </div>';}
        ?>
