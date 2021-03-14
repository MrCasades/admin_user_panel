<?php
/*Загрузка главного пути*/
include_once '../includes/path.inc.php';

/*Загрузка функций*/
include_once MAIN_FILE . '/includes/func.inc.php';

/*Поиск*/

$searchUsers = searchFunction($_GET['text'], $_GET['status']);
		
include 'searchpost.html.php';
exit();