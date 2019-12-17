<?php
    require 'auth.php';
    echo "Привет, {$_SESSION['login']}! Ваш ip - {$_SESSION['ip']}";
?>
<form method="GET">
    <input type="hidden" name="logout" value="true">
    <input type="submit" value="Выход">
</form>