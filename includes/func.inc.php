<?php

/*Вывод списка пользователей и статусов*/

function lastUsers($num = '')//num - Число пользователей. Если пусто, то выводится всё.
{
	$limit = $num != '' ? ' LIMIT '.$num : '';

    /*Подключение к базе данных*/
    include MAIN_FILE . '/includes/db.inc.php';

    /*Команда SELECT*/
    try
    {
        $sql = 'SELECT u.id AS userid, firstname, lastname, patronymic, s.id AS statusid, statusname FROM user u
                INNER JOIN status s ON s.id = statusid
                ORDER BY userid DESC'.$limit;
        $result = $pdo->query($sql);
    }

    catch (PDOException $e)
    {
        $headMain = 'Ошибка БД';
        $error = 'Ошибка выбора категории: ' . $e -> getMessage();// вывод сообщения об ошибке в переменой $e
        include 'error.html.php';
        exit();
    }

    /*Вывод результата в шаблон*/
    foreach ($result as $row)
    {
        $lastUsers[] =  array ('userid' => $row['userid'], 'firstname' => $row['firstname'], 'lastname' => $row['lastname'],
                            'patronymic' => $row['patronymic'],  'statusid' => $row['statusid'], 
                            'statusname' => $row['statusname']);
    }

    return $lastUsers;
}

/*Вывод статусов*/

function viewAllStatuses()
{
    /*Подключение к базе данных*/
    include MAIN_FILE . '/includes/db.inc.php';

    /*Список статусов*/
	try
	{
		$result = $pdo -> query ('SELECT * FROM status');
	}
	catch (PDOException $e)
	{
		$headMain = 'Ошибка БД';
		$error = 'Ошибка вывода статусов '. ' Error: '. $e -> getMessage();// вывод сообщения об ошибке в переменой $e
		include 'error.html.php';
		exit();
	}
	
	foreach ($result as $row)
	{
		$allStatuses[] = array('idstatus' => $row['id'], 'statusname' => $row['statusname']);
	}

    return $allStatuses;
}

/*Функция поиска*/

function searchFunction($text, $status)
{
    /*Подключение к базе данных*/
    include MAIN_FILE . '/includes/db.inc.php';
            
    /*Переменные для выражения SELECT*/
    $select = 'SELECT u.id AS userid, firstname, lastname, patronymic, s.id AS statusid, statusname';
    $from = ' FROM user u
            INNER JOIN status s ON s.id = statusid';
    $where = ' WHERE TRUE';
	$orderBy = ' ORDER BY userid DESC';
            
    $forSearch = array();//массив заполнения запроса
                
    /*Получение статуса*/
    if ($status != '')//Если выбран статус
    {
        $where .= " AND statusid = :idstatus";
        $forSearch[':idstatus'] = $_GET['status'];
    }
                
    /*Поиск по фамилии, имени или отчеству*/

    if ($text != '')//Если текст присутствует
    {
        $where .= " AND (firstname LIKE :firstname OR lastname LIKE :lastname OR patronymic LIKE :patronymic)";
        $forSearch[':firstname'] = '%'. $_GET['text']. '%';
        $forSearch[':lastname'] = '%'. $_GET['text']. '%';
        $forSearch[':patronymic'] = '%'. $_GET['text']. '%';	
    }
            
    /*Объеденение переменных в запрос*/
    try
    {
        $sql = $select.$from.$where.$orderBy;
        $s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
        $s -> execute($forSearch);// метод дает инструкцию PDO отправить запрос MySQL. Т. к. массив $forSearch хранит значение всех псевдопеременных 
                                    // не нужно указывать их по отдельности с помощью bindValue									
    }

    catch (PDOException $e)
    {
		$title = 'Ошибка';
        $headMain = 'Ошибка БД';
		$toLastPage = '';
        $error = 'Ошибка поиска : ' . $e -> getMessage();// вывод сообщения об ошибке в переменой $e
        include 'error.html.php';
        exit();
    }
            
    foreach ($s as $row)
    {
        $searchUsers[] =  array ('userid' => $row['userid'], 'firstname' => $row['firstname'], 'lastname' => $row['lastname'],
                                'patronymic' => $row['patronymic'],  'statusid' => $row['statusid'], 
                                'statusname' => $row['statusname']);
    }

	if (empty($searchUsers)) $searchUsers = '';

    return $searchUsers;
}

/*Добавление информации в БД*/

function insertToDB($firstName, $lastName, $patronymic)
{
    /*Если не заполнены обязательные поля*/
	if (($firstName == '') || ($lastName == ''))
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
		$sql = 'INSERT INTO user 
				SET firstname = :firstname,
					lastname = :lastname,
					patronymic = :patronymic';// псевдопеременная получающая значение из формы
		$s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':firstname', $firstName);//отправка значения
		$s -> bindValue(':lastname', $lastName);//отправка значения
		$s -> bindValue(':patronymic', $patronymic);//отправка значения
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
}

/*Данные для формы обновления пользователей*/

function dataToUpdate($id)
{
    /*Подключение к базе данных*/
	include MAIN_FILE . '/includes/db.inc.php';
	
	/*Команда SELECT*/
	try
	{
		$sql = 'SELECT * FROM user WHERE id = :iduser';
		$s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':iduser', $id);//отправка значения
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
	
    $GLOBALS['padgeTitle'] = 'Редактировать информацию';// Переменные для формы "Рубрика"
	$GLOBALS['headMain'] = 'Редактировать данные пользователя';
	$GLOBALS['action'] = 'editform';
    $GLOBALS['firstName'] = $row['firstname'];
    $GLOBALS['lastName'] = $row['lastname'];
    $GLOBALS['patronymic'] = $row['patronymic'];
    $GLOBALS['idUser'] = $row['id'];
    $GLOBALS['idStatus'] = $row['statusid'];
    $GLOBALS['button'] = 'Обновить информацию';
}

/*Обновление информации в базе данных*/

function updateInfo($idUser, $firstName, $lastName, $patronymic, $statusId)
{
    /*Если не заполнены обязательные поля*/
	if (($firstName == '') || ($lastName == ''))
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
		$sql = 'UPDATE user 
				SET firstname = :firstname, 
					lastname = :lastname, 
					patronymic = :patronymic,
					statusid = :statusid 
				WHERE id = :iduser';// псевдопеременная получающая значение из формы
		$s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':iduser', $idUser);//отправка значения
		$s -> bindValue(':firstname', $firstName);//отправка значения
		$s -> bindValue(':lastname', $lastName);//отправка значения
		$s -> bindValue(':patronymic', $patronymic);//отправка значения
		$s -> bindValue(':statusid', $statusId);//отправка значения
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
}

/*Удаление из базы данных*/

function deleteInfo($id)
{
    /*Подключение к базе данных*/
	include MAIN_FILE . '/includes/db.inc.php';
	
	try
	
	{
		$sql = 'DELETE FROM user WHERE id = :iduser';// - псевдопеременная получающая значение из формы
		$s = $pdo->prepare($sql);// подготавливает запрос для отправки в бд и возвр объект запроса присвоенный переменной
		$s -> bindValue(':iduser', ($id));//отправка значения
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
}