<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['age'])) {
        session_start();
        $_SESSION['Item']['name'] = strip_tags(trim($_POST['name']));
        $_SESSION['Item']['age'] = strip_tags(trim($_POST['age']));
        header("Location: catalog.php");
    } 
    else echo 'Полностью заполните форму';
}
?>
<form method='POST'>
    <p>Имя:<input type='text' name='name'></p>
    <p>Возраст:<input type='text' name='age'></p>
    <p><input type='submit' value='Добавить'></p>
</form>