<?php 

/*Загрузка header*/
include_once MAIN_FILE . '/header.inc.php';?>

  <main>
	<div>
		<div class = "search-form">
			<form action = " " method = "get">
				<input type = "text" name = "text" id = "text" placeholder = "Введите имя фамилию или отчество"/>	 
					<select name = "status" id = "status">
					<option value = "">Любой статус</option>
						<?php foreach ($allStatuses as $status): ?>
							<option value = "<?php echo $status['idstatus']; ?>"><?php echo $status['statusname']; ?></option>
						<?php endforeach; ?>  
					</select>
					<input type = "hidden" name = "action" value = "search"/>
					<input type = "submit" value = "Найти" id = "search-btn" class="btn btn-primary btn-sm"/>
			</form>	
		</div>
			
		<div id = "last-users">	

			<h3><?php echo $headerForuser;?></h3>

				<table id="myTableUser" class="tablesorter">
				<thead>
					<tr><th>Имя пользователя</th><th>Статус</th></tr>
				</thead>
				<?php if (empty ($lastUsers)): ?>
				
					<?php echo '<p>Пользователи не добавлены!</p>'; ?>

				<?php else: ?>
					
				<tbody>

				<?php foreach ($lastUsers as $user): ?> 
					<tr>
						<td><?php echo($user['lastname']. ' '. $user['firstname']. ' '. $user['patronymic']);?></td>
						<td><?php echo $user['statusname'];?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>	
				</table>
			<?php endif; ?>
		</div>
		<div id = "search-result"></div>
	</div>
  </main>

<?php 
/*Загрузка footer*/
include_once MAIN_FILE . '/footer.inc.php';?>