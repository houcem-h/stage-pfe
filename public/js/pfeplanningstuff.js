function validateForm(nbrDays,inDay,dayDate,dayStartTime,dayEndTime,err) {
  var tmp; 
  if(inDay === 1) 
    tmp="first";
  else if(inDay === 2)
    tmp = "second";
  else
    tmp = "third";
  if(dayDate){
     if(dayStartTime){
         if(dayEndTime) {
           if(dayStartTime < dayEndTime) {
             if (inDay < nbrDays) {
                const suffix = (inDay === 1) ? "second" : "third";
                dayDate = $("#date_" + suffix + "_day").val();
                dayStartTime = $("#start_time_" + suffix + "_day").val();
                dayEndTime = $("#end_time_" + suffix + "_day").val();
                return validateForm(nbrDays, inDay + 1, dayDate, dayStartTime, dayEndTime, err);
             }
           }else{
            var string = "end_time_" + tmp + "_day";
            err[string] = "verifier le temps";
            string = "start_time_" + tmp + "_day";
            err[string] = "verifier le temps";
           }
         }else{
            const string = "end_time_" + tmp + "_day";
            err[string] = "entrer le temps de la fin";
         }
     }else{
       const string = "start_time_"+tmp+"_day";
       err[string] = "entrer le temps de début";
     }
  }else{
     const string = "date_" + tmp + "_day";
     err[string] = "entrer une date";
  }
  return err;
}

function differentDates(nbrDays) {
  const date1 = $("#date_first_day").val();
  const currentDate = new Date();
  const year = currentDate.getFullYear();
  var month = currentDate.getMonth() +1;
  var day = currentDate.getDate();
  if (month < 10) {month = "0" + month;}
  if(day < 10) {day = "0"+day;}
  const fullDate= year+"-"+month+"-"+day;  
  if(nbrDays === 2) {
    const date2 = $("#date_second_day").val();
    return date1 !== date2 && date1 > fullDate && date2 > fullDate;
  } else if (nbrDays === 3) {
    const date2 = $("#date_second_day").val();
    const date3 =  $("#date_third_day").val();
    return (date1 !== date2 && date1 !== date3 && date2 !== date3) && (date1 > fullDate && date2 > fullDate && date3 > fullDate);
  }
  return true;
}

$(function(){
  $('input[name="nbrdays"]').click(function(e){
      var nbrDays=parseInt($(this).val());
      var placeToAppend = $('#appenddatesandtimesinputs');
      var $dateElementSecondDay = $('<div class="form-group" id="d2"><label for="date_second_day">Date Day 2</label><input type="date" name="date_second_day" id="date_second_day" class="form-control"/><small class="text-danger small-form-error"></small> </div>');
      var $startTimeSecondDay = $('<div class="form-group" id="t3"><label for="start_time_second_day">Start Time Day 2</label><input type="time" name="start_time_second_day" id="start_time_second_day" class="form-control"/><small class="text-danger small-form-error"></small> </div>');
      var $endTimeSecondDay = $('<div class="form-group" id="t4"><label for="end_time_second_day">End Time Day 2</label><input type="time" name="end_time_second_day" id="end_time_second_day" class="form-control"/><small class="text-danger small-form-error"></small> </div>');
      if(nbrDays==2){
        $('#d3').remove();
        $('#t5').remove();
        $('#t6').remove();
        $('#d2').remove();
        $('#t3').remove();
        $('#t4').remove();
        placeToAppend.append($dateElementSecondDay).append($startTimeSecondDay).append($endTimeSecondDay);
      }else if (nbrDays==3){
        $('#d2').remove();
        $('#t3').remove();
        $('#t4').remove();
        var $dateElementThirdDay = $('<div class="form-group" id="d3"><label for="date_third_day">Date Day 3</label><input type="date" name="date_third_day" id="date_third_day" class="form-control"/><small class="text-danger small-form-error"></small> </div>');
        var $startTimeThirdDay = $('<div class="form-group" id="t5"><label for="start_time_third_day">Start Time Day 3</label><input type="time" name="start_time_third_day" id="start_time_third_day" class="form-control"/><small class="text-danger small-form-error"></small> </div>');
        var $endTimeThirdDay = $('<div class="form-group" id="t6"><label for="end_time_third_day">End Time Day 3</label><input type="time" name="end_time_third_day" id="end_time_third_day" class="form-control"/><small class="text-danger small-form-error"></small> </div>');
        placeToAppend.append($dateElementSecondDay).append($startTimeSecondDay).append($endTimeSecondDay).append($dateElementThirdDay).append($startTimeThirdDay).append($endTimeThirdDay);
      }else{
        $('#d2').remove();
        $('#d3').remove();
        $('#t3').remove();
        $('#t4').remove();
        $('#t5').remove();
        $('#t6').remove();
      }
  });

  $('#formplanningpfe').submit(function(e){
    $('.small-form-error').hide();
    $('input').css('border','solid 1px lightgrey');
    var err = {};
    var nbrDays = parseInt($("input[name=nbrdays]:checked").val());
    var inDay =1;
    var dateFirstDay = $('#date_first_day').val();
    var stFirstDay = $("#start_time_first_day").val();
    var etFirstDay = $("#end_time_first_day").val();
    err = validateForm(nbrDays, inDay, dateFirstDay, stFirstDay, etFirstDay, err);
    for(var key in err) {
        $("#"+key).css('border','solid 1px red').next().show().text(err[key]);
        return false;
    }
    if (!differentDates(nbrDays)) {
      alert("verifiez les dates des soutenances!");
      return false;
    }
    if (!$("#pfe_duration").val() || $("#pfe_duration").val()==0) {
      $("#pfe_duration").css('border','solid 1px red').next().show();
      return false;
    }
    return true;
   });
});