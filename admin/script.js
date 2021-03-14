/*Загрузка результатов поиска*/

$( document ).ready(function() {

    /*Загрузка результатов поиска*/
  
      $( document ).on('click', '#search-btn', function(e) {
         const status = $('#status[name="status"]').val()
         const text = $('#text[name="text"]').val()
  
        //  $('#all-users').delay(50).fadeOut('slow')
         $( "#search-result" ).load( "search.php?text=" + text+"&status=" + status)
  
         $( "#last-users" ).hide('fast')
        //  $('#search-result').delay(100).fadeIn('slow')
        
         e.preventDefault()
      })
  })

  /*Инициализация таблицы*/
  $(function() {
    $("#myTable").tablesorter(({
        widgets: ['zebra']
      }
    ))
  })

  //Проверка заполнения форм

const lastName = document.getElementById('lastname')
const firstName = document.getElementById('firstname')

const confirm = document.getElementById('confirm')
const incorr = document.getElementById('incorr')


confirm.addEventListener('click', (event) => {
    if ((lastName.value === '') || (firstName.value === '')){
        const incorr = document.getElementById('incorr')
        incorr.innerHTML = 'Не заполнены обязательные поля!'
        event.preventDefault()
    }
})



  // $( document ).on ('click', '.btn-subm', function(e){
  //   const idUser = $(this).prop('value')
  //   $(location).attr('href','index.php?upd&iduser='+idUser);
  // })

  // $( document ).on ('click', '.btn-del', function(e){
  //   const idUser = $(this).prop('value')
  //   $(location).attr('href','index.php?upd&iduser='+idUser);
  // })

  // $('a').each(function(){
  //   $(this)
  //       .data('href', $(this).attr('href'))
  //       .attr('href','//:')
  //       .on('click', function(){
  //         location.href = $(this).data('href');
  //       });
  // });

  // $('#rez td').sort(function(a, b) { // сортируем
  //   return +$(b).find('.tosort').attr('#lastnam') - +$(a).find('.tosort').attr('#lastnam');
  // })
  // .appendTo('#rez');// возвращаем в контейнер