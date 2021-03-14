<?php 

/*Загрузка header*/
include_once MAIN_FILE . '/header.inc.php';?>

  <main>	
	<div>  
		<div class = "post" align="center">
		 	<?php echo $error; ?> 
			<p><a href="#" onclick="history.back();"><button class="btn-err" align="center">Назад</button></a></p>
		</div>
	</div>
  </main>
  
<?php 
/*Загрузка footer*/
include_once MAIN_FILE . '/footer.inc.php';?>	