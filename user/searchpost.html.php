	
	<?php if (!empty ($searchUsers)):?>

		<h3>Результаты поиска | <a href = "../user">Очистить</a></h3>
		
		<table id="myTableSearch" class="tablesorter">
		  <thead>
			<tr><th>Имя пользователя</th><th>Статус</th></tr>
		  </thead>

		 <tbody>	 
			<?php foreach ($searchUsers as $user): ?> 

				<tr>
					<td><?php echo($user['lastname']. ' '. $user['firstname']. ' '. $user['patronymic']);?></td>
					<td><?php echo $user['statusname'];?></td>
				</tr>
			<?php endforeach; ?>
		  </tbody>	
		</table>

		<?php elseif (empty ($searchUsers)):?>

			<p>Поиск не дал результатов! | <a href = "../user">Очистить</a></p>
		
		<?php endif;?>

	