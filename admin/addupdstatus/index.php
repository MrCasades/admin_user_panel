<?php
/*Загрузка главного пути*/
include_once '../../includes/path.inc.php';

/*Загрузка функций*/
include_once MAIN_FILE . '/includes/func.inc.php';

$title = 'Панель администратора';//Данные тега <title>
$headMain = 'Работа со статусами';
$toLastPage = '<a href = "//'.MAIN_URL.'"><button>На главную</button></a>';

/*Добавление информации в таблицу*/
	
$action = 'addform';
$statusName = '';
$idUser = '';
$button = 'Добавить статус';

if (isset ($_GET['addform']))
{
	/*Если не заполнены обязательные поля*/
	if ($_POST['statusname'] == '')
	{
		$title = 'Ошибка';
		$headMain = 'Введите недостающую информацию';
		$toLastPage = '';
		$error = 'Заполните обязательные поля';// вывод сообщения об ошибке в переменой $e
		include 'error.html.php';
		exit();
	}

	/*Подключение к базе данных*/
	include MAIN_FILE . '/includes/db.inc.php';
	
	try
	{
		$sql = 'INSERT INTO status 
				SET statusname = :statusname';// псевдопеременная получающая значение из формы
		$s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':statusname', $_POST['statusname']);//отправка значения
		$s -> execute();// метод дает инструкцию PDO отправить запрос MySQL
	}

	catch (PDOException $e)

	{
		$title = 'Ошибка';
		$headMain = 'Ошибка БД';
		$toLastPage = '';
		$error = 'Ошибка добавления информации '. ' Error: '. $e -> getMessage();// вывод сообщения об ошибке в переменой $e
		include 'error.html.php';
		exit();
	}
	
	header ('Location: .');//перенаправление обратно в контроллер index.php
	exit();
}	

/*Редактирование информации в таблице category*/

if (isset ($_POST['action']) && ($_POST['action'] == 'Редактировать'))
{
	/*Подключение к базе данных*/
	include MAIN_FILE . '/includes/db.inc.php';
	
	/*Команда SELECT*/
	try
	{
		$sql = 'SELECT * FROM status WHERE id = :idstatus';
		$s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':idstatus', $_POST['idstatus']);//отправка значения
		$s -> execute();// метод дает инструкцию PDO отправить запрос MySQL
	}

	catch (PDOException $e)

	{
		$title = 'Ошибка';
		$headMain = 'Ошибка БД';
		$toLastPage = '';
		$error = 'Error select : ' . $e -> getMessage();// вывод сообщения об ошибке в переменой $e
		include 'error.html.php';
		exit();
	}
	
	$row = $s -> fetch();

	$title = 'Панель администратора';//Данные тега <title>
	$headMain = 'Работа со статусами';
	$toLastPage = '<a href = "//'.MAIN_URL.'"><button>На главную</button></a>';
    
	$action = 'editform';
	$statusName = $row['statusname'];
	$idStatus = $row['id'];
	$button = 'Обновить статус';
	
	include 'form.html.php';
	exit();
}

/*Команда UPDATE*/
if (isset ($_GET['editform']))
{	
	/*Если не заполнены обязательные поля*/
	if ($_POST['statusname'] == '')
	{
		$title = 'Ошибка';
		$headMain = 'Введите недостающую информацию';
		$toLastPage = '';
		$error = 'Заполните обязательные поля';// вывод сообщения об ошибке в переменой $e
		include 'error.html.php';
		exit();
	}

	/*Подключение к базе данных*/
	include MAIN_FILE . '/includes/db.inc.php';
	
	try
	{
		$sql = 'UPDATE status 
				SET statusname = :statusname
				WHERE id = :idstatus';// псевдопеременная получающая значение из формы
		$s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':idstatus', $_POST['idstatus']);//отправка значения
		$s -> bindValue(':statusname', $_POST['statusname']);//отправка значения 
		$s -> execute();// метод дает инструкцию PDO отправить запрос MySQL
	}

	catch (PDOException $e)
	{
		$title = 'Ошибка';
		$headMain = 'Ошибка БД';
		$toLastPage = '';
		$error = 'Error Update: '. $e -> getMessage();// вывод сообщения об ошибке в переменой $e
		include 'error.html.php';
		exit();
	}

	header ('Location: .');//перенаправление обратно в контроллер index.php
	exit();
}	

/*Удаление пользователя*/

if (isset ($_POST['action']) && ($_POST['action'] == 'X'))
{
	/*Подключение к базе данных*/
	include MAIN_FILE . '/includes/db.inc.php';

	/*Проверка на присвоение статуса*/
	/*Команда SELECT*/
    try
    {
        $sql = 'SELECT COUNT(statusid) AS countid FROM user WHERE statusid = :idstatus';
        $s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':idstatus', $_POST['idstatus']);//отправка значения
		$s -> execute();// метод дает инструкцию PDO отправить запрос MySQL
    }

    catch (PDOException $e)
    {
        $headMain = 'Ошибка БД';
        $error = 'Ошибка выбора категории: ' . $e -> getMessage();// вывод сообщения об ошибке в переменой $e
        include 'error.html.php';
        exit();
    }

	$row = $s -> fetch();

	if ($row['countid'] != 0)
	{
		$title = 'Ошибка';
		$headMain = 'Нельзя удалить статус';
		$toLastPage = '';
		$error = 'Если статус присвоен хотябы одному пользователю (или это статус по умолчанию), его удалить нельзя!';// вывод сообщения об ошибке в переменой $e
		include 'error.html.php';
		exit();
	}
	
	try
	{
		$sql = 'DELETE FROM status WHERE id = :idstatus';// - псевдопеременная получающая значение из формы
		$s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':idstatus', $_POST['idstatus']);//отправка значения
		$s -> execute();// метод дает инструкцию PDO отправить запрос MySQL
	}

	catch (PDOException $e)
	{
		$title = 'Ошибка';
		$headMain = 'Ошибка БД';
		$toLastPage = '';
		$error = 'Ошибка удаления '. ' Error: '. $e -> getMessage();// вывод сообщения об ошибке в переменой $e
		include 'error.html.php';
		exit();
	}
	
	header ('Location: .');//перенаправление обратно в контроллер index.php
	exit();
}

/*Информация для вывода*/

$allStatuses = viewAllStatuses();

include 'statuses.html.php';
exit();