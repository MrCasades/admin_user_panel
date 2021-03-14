/*Загрузка результатов поиска*/

$( document ).ready(function() {

  /*Загрузка результатов поиска*/

    $( "#search-btn" ).click(function(e) {
       const status = $('#status[name="status"]').val()
       const text = $('#text[name="text"]').val()

       $( "#search-result" ).load( "search.php?text=" + text+"&status=" + status,
       
       /*Инициализция таблицы для результатов поиска*/
       function(e) {
        $("#myTableSearch").tablesorter({
           widgets: ['zebra']
          }
        );
      });

       $( "#last-users" ).hide('fast')
       $('#search-result').delay(100).fadeIn('slow')

       e.preventDefault()
    })
})

/*Инициализация TableSorter */
$(function() {
  $("#myTableUser").tablesorter({
      widgets: ['zebra']
    }
  )
})
