<?php
/*Загрузка главного пути*/
include_once '../includes/path.inc.php';

/*Загрузка функций*/
include_once MAIN_FILE . '/includes/func.inc.php';

$title = 'Все пользователи';//Данные тега <title>
$headMain = 'Все пользователи';
$toLastPage = '<a href = "//'.MAIN_URL.'"><button>На главную</button></a>';

$num = 10;//по сколько пользователей выводить

$headerForuser = 'Последние '.$num.' пользователей';

/*Вывод статусов для поиска*/

$allStatuses = viewAllStatuses();

/*Вывод пользователей*/

$lastUsers = lastUsers($num);

include 'view.html.php';
exit();