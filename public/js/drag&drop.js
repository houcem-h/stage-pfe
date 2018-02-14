$(function(){
    function createClassroomDivForFirstDay(){
        return $('<div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;"><div><input type="text" placeholder="choose classroom name" class="classesnames form-control" style="border:none;outline-decoration:none;width:100%;" name="classname"/></div><hr style="background-color:black;"><div class="classroom" date="'+$("#pdate_first_day").text()+'" time="'+$('#pstart_time_first_day').text()+'"></div></div>');
    }

    function createClassroomDivForSecondDay() {
        return $('<div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;"><div><input type="text" placeholder="choose classroom name" class="classesnames form-control" style="border:none;outline-decoration:none;width:100%;" name="classname"/></div><hr style="background-color:black;"><div class="classroom" date="' + $("#pdate_second_day").text() + '" time="' + $('#pstart_time_second_day').text()+'"></div></div>');
    }

    function createClassroomDivForThirdDay() {
        return $('<div class="globalclassroombox col-md-3" style="background-color:white;min-height:130px;"><div><input type="text" placeholder="choose classroom name" class="classesnames form-control" style="border:none;outline-decoration:none;width:100%;" name="classname"/></div><hr style="background-color:black;"><div class="classroom" date="' + $("#pdate_thirdday").text() + '" time="' + $('#pstart_time_third_day').text() + '"></div></div>');
    }
    
    function isEmpty(el) {
        return !$.trim(el.html());
    }

    $('#addclassinfirstday').click(function(e){
        $('#div_first_day').append(createClassroomDivForFirstDay());
        $('.globalclassroombox').droppable({
            tolerance: "pointer",
            drop: function (event, ui) {
                var data = ui.draggable.attr('data');
                var el = $(ui.draggable).html();
                var p = $('<p class="draggableframers" data="' + data + '">' + el + '</p>');
                $(event.target).find('.classroom').append(p);
                $('.draggableframers').draggable();
                ui.draggable.remove();
            }
        });
    });

    $('#addclassinsecondday').click(function (e) {
        $('#div_second_day').append(createClassroomDivForSecondDay());
        $('.globalclassroombox').droppable({
            tolerance: "pointer",
            drop: function (event, ui) {
                var data = ui.draggable.attr('data');
                var el = $(ui.draggable).html();
                var p = $('<p class="draggableframers" data="' + data + '">' + el + '</p>');
                $(event.target).find('.classroom').append(p);
                $('.draggableframers').draggable();
                ui.draggable.remove();
            }
        });
    });

    $('#addclassinthirdday').click(function (e) {
        $('#div_third_day').append(createClassroomDivForThirdDay());
        $('.globalclassroombox').droppable({
            tolerance: "pointer",
            drop: function (event, ui) {
                var data = ui.draggable.attr('data');
                var el = $(ui.draggable).html();
                var p = $('<p class="draggableframers" data="' + data + '">' + el + '</p>');
                $(event.target).find('.classroom').append(p);
                $('.draggableframers').draggable();
                ui.draggable.remove();
            }
        });
    });

    $('.draggableframers').draggable({
        cursor:'move',
        snap:'.classroom',
        zIndex:10000,
    });
    
    $('.globalclassroombox').droppable({
        tolerance: "pointer",
        drop:function(event,ui){
            var data=ui.draggable.attr('data');
            var el = $(ui.draggable).html();
            var p = $('<p class="draggableframers" data="'+data+'">'+el+'</p>');
            $(event.target).find('.classroom').append(p);
            $('.draggableframers').draggable();
            ui.draggable.remove();
        }
    });

    $('#planningvalidated').click(function(e){
            
            var test=true;
             $('.classesnames').each(function(index){
                 if ($(this).val().length == 0 && !isEmpty($(this).closest('.globalclassroombox ').find('.classroom'))){
                   test=false;
                   $(this).css('border','solid 1px red');
                }
             });

            if(test==false)
               return false;
            var classroomsArray=[];
            var classrooms = $('.globalclassroombox').each(function(index){
            var obj = {};
            var juries = {};
            var date_start = $(this).find('.classroom').attr('date');
            var time_start = $(this).find('.classroom').attr('time');
            obj.start_date = date_start;
            obj.start_time = time_start;
            obj.classroom = $(this).find('input.classesnames').val();
            $(this).find('.classroom').find('.draggableframers').each(function(index){
                juries['jurie'+(index+1)]=$(this).attr('data');
            });
            obj.juries = juries;
            classroomsArray.push(obj);
        });

        $.ajax({
            url:'/planningpfe',
            type:'POST',
            data: { classrooms: classroomsArray,duration: $('#pfe_def_dur').text()},
            dataType:'json',
            success:function(data){
               window.location.href='/dashboard';
            },error:function(xhr){

            }
        });
    });
});