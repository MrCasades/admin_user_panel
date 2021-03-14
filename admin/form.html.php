<?php 

/*Загрузка header*/
include_once MAIN_FILE . '/header.inc.php';?>
  <main>
	<div>
		<form action = "?<?php echo $action; ?>" method = "post">
			<div class = "upd-form-group">
			  <input type = "text" name = "lastname" id = "lastname" value = "<?php echo $lastName;?>" placeholder = "Фамилия">	
		  	  <input type = "text" name = "firstname" id = "firstname" value = "<?php echo $firstName;?>" placeholder = "Имя">
		  	  <input type = "text" name = "patronymic" id = "patronymic" value = "<?php echo $patronymic;?>" placeholder = "Отчество">
			
			<select name = "status" id = "status">
			  <option value = "">Выбрать: </option>
			  <?php foreach ($allStatuses as $status): ?>
			  	<option value = "<?php echo $status['idstatus']; ?>"
					<?php if ($status['idstatus'] == $idStatus)
					{
						echo 'selected';
					}				 
					?>><?php echo $status['statusname']; ?>
				</option>
			  <?php endforeach; ?> 
			</select> 
			</div>
			<div class = "upd-form-btn-group">
				<input type = "hidden" name = "iduser" value = "<?php echo $idUser;?>">
				<input type = "submit" value = "<?php echo $button;?>" class="btn-subm btn-upd">
			</div>
		</form>
		<a href="#" onclick="history.back();"><button class="btn-subm btn-back">Назад</button></a>
	</div>
  </main>	
	
<?php 
/*Загрузка footer*/
include_once MAIN_FILE . '/footer.inc.php';?>