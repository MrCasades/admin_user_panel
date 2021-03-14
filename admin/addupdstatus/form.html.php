<?php 

/*Загрузка header*/
include_once MAIN_FILE . '/header.inc.php';?>
  <main>
	<div>
		<form action = "?<?php echo $action; ?>" method = "post">
			<div class = "upd-status">
			  <input type = "text" name = "statusname" id = "statusname" value = "<?php echo $statusName;?>" placeholder = "Статус">	
			</div>
			<div class = "upd-status-btn">
				<input type = "hidden" name = "idstatus" value = "<?php echo $idStatus;?>">
				<input type = "submit" value = "<?php echo $button;?>" class="btn-subm btn-upd">
				<a href="#" onclick="history.back();"><button class="btn-subm btn-back">Назад</button></a>
			</div>
		</form>
	</div>
  </main>	
	
<?php 
/*Загрузка footer*/
include_once MAIN_FILE . '/footer.inc.php';?>