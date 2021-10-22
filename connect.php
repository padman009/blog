<?php
$mysql = new mysqli("localhost", "decode", "decode", "blog") or die('Ошибка соединения с БД');
$mysql->set_charset("UTF-8");
