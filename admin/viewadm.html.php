<?php 

/*Загрузка header*/
include_once MAIN_FILE . '/header.inc.php';?>

  <main>
	<div>
	<div class = "adm-form">	
		<form action = "?<?php echo $action; ?>" method = "post">
			<div>
				<input type = "text" name = "lastname" id = "lastname" value = "<?php echo $lastName;?>" placeholder = "Фамилия*">	
				<input type = "text" name = "firstname" id = "firstname" value = "<?php echo $firstName;?>" placeholder = "Имя*">
				<input type = "text" name = "patronymic" id = "patronymic" value = "<?php echo $patronymic;?>" placeholder = "Отчество">
			</div> 
			<div class = "adm-form-sub-gr">
				<input type = "submit" value = "<?php echo $button;?>" class="btn-subm" id = "confirm">
			</div>
		</form>
		<div id = "incorr" class = "incorr"></div>	
	</div>
    <a href = "addupdstatus"><button class="btn-subm">Управление статусами</button></a>
		<div id = "last-users">			
			<table id="myTable" class="tablesorter">
			  <thead>
				<tr><th>id</th><th>ФИО пользователя</th><th>Статус</th><th>Возможные действия</th>
			  </thead>
			<?php if (empty ($lastUsers)): ?>
			
				<?php echo '<p>Пользователи не добавлены!</p>'; ?>
			
			<?php else: ?>

			<tbody>	

			<?php foreach ($lastUsers as $user): ?> 
				<tr>
				<form action = " " method = "post">
					<td><?php echo $user['userid'];?></td>
					<td><?php echo($user['lastname']. ' '. $user['firstname']. ' '. $user['patronymic']);?></td>
					<td><?php echo $user['statusname'];?></td>
                    <td>
                        <input type = "hidden" name = "iduser" value = "<?php echo $user['userid']; ?>">
                        <input type = "submit" name = "action" value = "Редактировать" class="btn-subm">
                        <input type = "submit" name = "action" value = "X" class="btn-subm btn-del" title = "Удалить" onclick = "return confirm('Вы уверены?')"> 
                    </td>
				</form>
				</tr>
			<?php endforeach; ?>
			</tbody>	
			</table>
		</div>
		<?php endif; ?>
	</div>
  </main>

<?php 
/*Загрузка footer*/
include_once MAIN_FILE . '/footer.inc.php';?>