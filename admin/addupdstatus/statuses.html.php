<?php

/*Загрузка header*/
include_once MAIN_FILE . '/header.inc.php';?>

  <main>
	<div>
	<a href="#" onclick="history.back();"><button class="btn-subm btn-back">Назад</button></a>
	<div class = "adm-form">	
		<form action = "?<?php echo $action; ?>" method = "post">
			<div>
				<input type = "text" name = "statusname" id = "statusname" value = "<?php echo $statusName;?>" placeholder = "Название статуса">	
			</div> 
			<div class = "adm-form-sub-gr">
				<input type = "submit" value = "<?php echo $button;?>" class="btn-subm">
			</div>
		</form>	
	</div>
    
		<div id = "last-users">
		   <div class = "status-table">			
			<table id="myTableSt" class="tablesorter">
			  <thead>
				<tr><th>id</th><th>Статус</th><th>Возможные действия</th>
			  </thead>
			<?php if (empty ($allStatuses)): ?>
			
				<?php echo '<p>Статусы не добавлены!</p>'; ?>
			
			<?php else: ?>

			<tbody>	

			<?php foreach ($allStatuses as $status): ?> 
				<tr>
				<form action = " " method = "post">
					<td><?php echo $status['idstatus'];?></td>
					<td><?php echo $status['statusname'];?></td>
                    <td>
                        <input type = "hidden" name = "idstatus" value = "<?php echo $status['idstatus']; ?>">
                        <input type = "submit" name = "action" value = "Редактировать" class="btn-subm">
                        <input type = "submit" name = "action" value = "X" class="btn-subm btn-del" title = "Удалить" onclick = "return confirm('Вы уверены?')"> 
                    </td>
				</form>
				</tr>
			<?php endforeach; ?>
			</tbody>	
			</table>
		   </div>		
		</div>
		<?php endif; ?>
	</div>
  </main>

<?php 
/*Загрузка footer*/
include_once MAIN_FILE . '/footer.inc.php';?>