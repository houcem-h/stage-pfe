$(function(){

$('input[name="nbrdays"]').click(function(e){

  var nbrDays=parseInt($(this).val());
  var placeToAppend = $('#appenddatesandtimesinputs');
  var $dateElementSecondDay = $('<div class="form-group" id="d2"><label for="date_second_day">Date Day 2</label><input type="date" name="date_second_day" id="date_second_day" class="form-control"/></div>');
  var $startTimeSecondDay = $('<div class="form-group" id="t3"><label for="start_time_second_day">Start Time Day 2</label><input type="time" name="start_time_second_day" id="start_time_second_day" class="form-control"/></div>');
  var $endTimeSecondDay = $('<div class="form-group" id="t4"><label for="end_time_second_day">End Time Day 2</label><input type="time" name="end_time_second_day" id="end_time_second_day" class="form-control"/></div>');
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
        var $dateElementThirdDay = $('<div class="form-group" id="d3"><label for="date_third_day">Date Day 3</label><input type="date" name="date_third_day" id="date_third_day" class="form-control"/></div>');
        var $startTimeThirdDay = $('<div class="form-group" id="t5"><label for="start_time_third_day">Start Time Day 3</label><input type="time" name="start_time_third_day" id="start_time_third_day" class="form-control"/></div>');
        var $endTimeThirdDay = $('<div class="form-group" id="t6"><label for="end_time_third_day">End Time Day 3</label><input type="time" name="end_time_third_day" id="end_time_third_day" class="form-control"/></div>');
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
 
});
});