//show the name of the student's group if it exists
$(function(){
    $.when(check_group()).done(function(data){
        var i=0;
        var parsed = JSON.parse(data);
        while(i<parsed.length){
            $("#"+parsed[i]['student']+" .info-student .items #groups_show").html("<a href='' data-toggle='modal' data-target='#show_groups' class='toggle-modal-show' id='show_groups_link'>Show groups</a>")
            i=i+1;
        }
    });


    //when user click on modal to show groups and session
    $(document).on("click","#show_groups_link",function(){
        var id_student = $(this).parent().parent().parent().parent().attr("id");


        $.when(get_group_name(id_student)).done(function(data){
            var parsed = JSON.parse(data);
            var i=0;
            //create table
            $("#show_groups .modal-body").append("<table class='table'><thead><tr><th scope='col'>Group name</th><th scope='col'>Session</th></tr></thead><tbody></tbody></table>")
            while(i<parsed.length){
              $(".table tbody").append("<tr><td>"+parsed[i]['name']+"</td><td>"+parsed[i]['session']+"</tr>");
              i=i+1;
            }
        });
    });

    //make the tbody when modal is hidden
    $(document).on("hide.bs.modal","#show_groups",function(){
        $("#show_groups .modal-body").empty();
    })

});

//swal the success session
$(function(){
    if( success == true){
      swal("Job done!","Student has been updated with success","success");
    }
});


//when admin want to change student's group
$(function(){
    $(".save_update_group_student").click(function(event){
      $('.Div_Err').removeClass('has-error');
      $(".span_Err").text("");
      event.preventDefault();
      if($("#group_student_edit").val() != ""){
            var student_id = $("#id_student").val();
            var group_name = $("#group_student_edit").val();
            var session = $("#session").text();
            //ajax
            $.post(url_update_group_student,{id_student:student_id,groupe_name:group_name,session:session,_token:token},function(data){
                if(data == "done"){
                    swal("Job done!","Student's group has been updated with success","success");
                }
                if(data == "error"){
                    swal("Error!","This group is not found! Choose one of these groups below ","error");
              }
            });
      }else{
        $('.Div_Err').addClass('has-error');
        $(".span_Err").text("Required field");
      }

    });
});







/* FUNCTIONS HERE */
//function check if that student has a group
function check_group(){
    return $.post(url_check_group_name,{_token:token});
}

//function get group name
function get_group_name(id_student){
    return $.post(url_get_group_name,{id_student:id_student,_token:token});
}
