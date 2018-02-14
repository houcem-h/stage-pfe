$(function(){
    var c1=0;
    var c2=0;

    $('input[type="checkbox"]').change(function(e){
       if ($(this).parent().attr('id') == 'firstdaysjuiesdiv'){
           if(e.target.checked)
             $('#counterjuriesfirstday').text(++c1);
           else
             $('#counterjuriesfirstday').text(--c1);
       }else{
           if (e.target.checked)
             $('#counterjuriessecondday').text(++c2);
           else
             $('#counterjuriessecondday').text(--c2);
       }
          if (c1 == parseInt($('#nbrjfd').text()))
              $('#alo').css('color', 'green');
          if (c2 == parseInt($('#nbrjsd').text()))
              $('#alt').css('color', 'green');
    });

  $('#donebutton').click(function(e){
   var liste= $('.classroominputfield');
   var lengthListe = liste.length;
   var test=true;
   for(var i=0;i<lengthListe;i++){
        if($(liste[i]).val().length==0){
            $(liste[i]).css('border','solid 1px red');
            test= false;
        }else{
             $(liste[i]).css('border', 'solid 1px green');
        }    
   }
   
    if (parseInt($('#counterjuriesfirstday').text()) != parseInt($('#nbrjfd').text()) || parseInt($('#counterjuriessecondday').text()) != parseInt($('#nbrjsd').text())){
          test= false;
    }
     if(test==false)
          return false;
          
      $(this).attr('disabled','disabled');
     var classrooms_first_day = $('#formclassroomsfirstday').serializeArray();
     var classrooms_second_day = $('#formclassroomssecondday').serializeArray();
     var array_class_first_day=[];
     var array_class_second_day = [];
     var array_juries_first_day=[];
     var array_juries_second_day = [];

     var start_time_first_day = $("#def_start_time_first_day").text();
     var start_time_second_day = $("#def_start_time_second_day").text();
     var def_legal_duration_first_day = $('#def_legal_duration_first_day').text();
     var def_legal_duration_second_day = $('#def_legal_duration_second_day').text();
     var init_duration = $('#init_duration').text();
     var perf_duration = $('#perf_duration').text();
     var start_date_first_day = $('#start_date_first_day').text();
     var start_date_second_day = $('#start_date_second_day').text();

          for (var key in classrooms_first_day) {
              var i = 0;
              for (var prop in classrooms_first_day[key]) {
                  if (classrooms_first_day[key][prop] != '_token') {
                      if (i % 2 != 0)
                          array_class_first_day.push(classrooms_first_day[key][prop]);
                      i++;
                  }
              }
          }

          for (var key in classrooms_second_day) {
              var i = 0;
              for (var prop in classrooms_second_day[key]) {
                  if (classrooms_second_day[key][prop] != '_token') {
                      if (i % 2 != 0)
                          array_class_second_day.push(classrooms_second_day[key][prop]);
                      i++;
                  }
              }
          }
   
      var juries_first_day = $('#formjuriesfirstday').serializeArray();
      var juries_second_day = $('#formjuriessecondday').serializeArray();
     
       for (var key in juries_first_day)
        for (var prop in juries_first_day[key])
          if (!isNaN(juries_first_day[key][prop]))
              array_juries_first_day.push(juries_first_day[key][prop]);

        for (var key in juries_second_day)
          for (var prop in juries_second_day[key])
            if (!isNaN(juries_second_day[key][prop]))
                array_juries_second_day.push(juries_second_day[key][prop]);
     
    $.ajaxSetup({
         headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
         }
     });

     $.ajax({
        url: '/planning',
        type:'POST',
        data: {
            classrooms_first_day: array_class_first_day,
            classrooms_second_day: array_class_second_day,
            juries_first_day: array_juries_first_day,
            juries_second_day: array_juries_second_day,
            start_date_first_day: start_date_first_day,
            start_date_second_day: start_date_second_day,
            start_time_first_day: start_time_first_day,
            start_time_second_day: start_time_second_day,
            legal_duration_first_day: def_legal_duration_first_day,
            legal_duration_second_day: def_legal_duration_second_day,
            init_duration: init_duration,
            perf_duration: perf_duration,
            level: $('#levelintern').text()
        },
        dataType:'json',
        success:function(response){
            // window.location.href = "/planning?l="+$('#levelintern').text();
            window.location.href="/dashboard";
        },error:function(xhr){
            var errors=xhr.responseJSON['errors'];
            $('#errorsplanning').show();1
            for(var i in errors)
                $('#errorsplanning').append('<p>'+errors[i]+'</p>')
        }
     });
  });
});