<?php
/*Загрузка главного пути*/
include_once '../includes/path.inc.php';

/*Загрузка функций*/
include_once MAIN_FILE . '/includes/func.inc.php';

$title = 'Панель администратора';//Данные тега <title>
$headMain = 'Панель администратора';
$toLastPage = '<a href = "//'.MAIN_URL.'"><button>На главную</button></a>';

/*Добавление информации в таблицу*/
	
$padgeTitle = 'Новая категория';// Переменные для формы "Категория"
$action = 'addform';
$firstName = '';
$lastName = '';
$patronymic = '';
$idUser = '';
$button = 'Добавить пользователя';

if (isset ($_GET['addform']))
{
	insertToDB($_POST['firstname'], $_POST['lastname'], $_POST['patronymic']);
	
	header ('Location: .');//перенаправление обратно в контроллер index.php
	exit();
}	

/*Редактирование информации в таблице category*/

if (isset ($_POST['action']) && ($_POST['action'] == 'Редактировать'))
{
	/*Данные для формы обновления*/

	dataToUpdate($_POST['iduser']);
	
	/*Список статусов*/
	
	$allStatuses = viewAllStatuses();
	
	include 'form.html.php';
	exit();
}

/*Команда UPDATE*/
if (isset ($_GET['editform']))
{	
	updateInfo($_POST['iduser'], $_POST['firstname'], $_POST['lastname'], $_POST['patronymic'], $_POST['status']);

	header ('Location: .');//перенаправление обратно в контроллер index.php
	exit();
}	

/*Удаление пользователя*/

if (isset ($_POST['action']) && ($_POST['action'] == 'X'))
{
	deleteInfo($_POST['iduser']);
	
	header ('Location: .');//перенаправление обратно в контроллер index.php
	exit();
}

/*Информация для вывода*/

$lastUsers = lastUsers();

include 'viewadm.html.php';
exit();