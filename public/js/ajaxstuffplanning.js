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
   //we must take care of the start date and and date also start time nd end time
   e.preventDefault();
   var liste= $('.classroominputfield');
   var lengthListe = liste.length;
   var test=true;
   var lev = $('#levelintern').text();
   console.log(lev);
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

    $('#maskforloadingspinner').show();
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
            level: lev
        },
        dataType:'json',
        success:function(response){
            $('#maskforloadingspinner').hide();
            window.location.href = "/planning/1?l=1";
        }, error: function(xhr) {
            var errors=xhr.responseJSON['errors'];
            $('#errorsplanning').show();
            for(var i in errors)
                $('#errorsplanning').append('<p>'+errors[i]+'</p>')
        }
     });
  });


  $("#formplanninginfo").submit(function(){
     $('input').css('border','solid 1px lightgrey');
     $('.small-form-error').hide();
     var dayOneDate = $("#startdate");
     
     var dayTwoDate = $("#startdate2");
     var stDayOne = $("#starttime");
     var etDayOne=$("#endtime");
     var stDayTwo = $("#starttimesecondday");
     var etDayTwo = $("#endtimesecondday");
     var initDur = $("#defenceduration");
     var perfDur = $("#defenceperfduration");
     const d = new Date();
     const currentDate = new Date();
     const year = currentDate.getFullYear();
     var month = currentDate.getMonth() + 1;
     var day = currentDate.getDate();
     if (month < 10) {month = "0" + month;}
     if (day < 10) {day = "0" + day;}
     const fullDate = year + "-" + month + "-" + day;
     if(!dayOneDate.val()) {
         dayOneDate.css('border','solid 1px red').next().show().text("entrer une date");
        return false;
     }if (dayOneDate.val() <= fullDate) {
          dayOneDate.css('border', 'solid 1px red').next().show().text("date invalide");
          return false;
     }
     if(!dayTwoDate.val()) {
         dayTwoDate.css('border', 'solid 1px red').next().show().text("entrer une date");
         return false;
     }
     if (dayTwoDate.val() <= fullDate) {
        dayTwoDate.css('border', 'solid 1px red').next().show().text("date invalide");
        return false;
     }
     if (dayTwoDate.val() === dayOneDate.val()) {
       dayOneDate.css('border', 'solid 1px red').next().show().text("choisissez des dates differentes");
       dayTwoDate.css('border', 'solid 1px red').next().show().text("choisissez des dates differentes");
       return false;
     }
     if(!stDayOne.val()) {
         stDayOne.css('border', 'solid 1px red').next().show().text("entrer une heure de commencement");
         return false;
     }
     if(!etDayOne.val()) {
        etDayOne.css('border', 'solid 1px red').next().show().text("entrer une heure de fin");
        return false;
     }
     if (stDayOne.val() >= etDayOne.val()) {
       stDayOne.css('border', 'solid 1px red').next().show().text("heure invalide");
       return false;
     }
     if (!stDayTwo.val()) {
        stDayTwo.css('border', 'solid 1px red').next().show().text("entrer une heure de commencement");
        return false;
     }
     if (!etDayTwo.val()) {
       etDayTwo.css('border', 'solid 1px red').next().show().text("entrer une heure de fin");
        return false;
     }
     if(stDayTwo.val() >= etDayTwo.val()) {
        stDayTwo.css('border', 'solid 1px red').next().show().text("heure invalide");
        return false;
     }
     if(!initDur.val() || parseInt(initDur.val()) == 0) {
         initDur.css('border', 'solid 1px red').next().show().text("entrer une duree en minutes");
         return false;
     }
     if (!perfDur.val() || parseInt(perfDur.val()) == 0) {
        perfDur.css('border', 'solid 1px red').next().show().text("entrer une duree en minutes");
        return false;
     }
     return true;
  });
});