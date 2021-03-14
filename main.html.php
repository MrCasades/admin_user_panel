<?php
    /*Загрузка header*/
    include_once __DIR__ . '/header.inc.php';
?>

    <main>
       <div class = "main-page-group"> 
        <h3>Выберете роль:</h3>
        <div class = "selection-group">
          <div>
            <a href = "./admin"><button class = "btn-subm btn-main">Я администратор</button></a> 
            <a href= "./user"><button class = "btn-subm btn-main">Я пользователь</button></a> 
          </div>   
        </div>
       </div> 
    </main>
    
<?php 
/*Загрузка footer*/
include_once MAIN_FILE . '/footer.inc.php';?>