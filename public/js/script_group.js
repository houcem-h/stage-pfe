//for update group
$(function(){
  $("#save_group").click(function(event){
      var isValid = true;
      event.preventDefault();
    //init
      $("#Nom_up_err").removeClass("has-error");
      $("#nom_span_err").text("");
      $("#Stream_up_err").removeClass("has-error");
      $("#stream_span_err").text("");


      if($("#nom_update").val() == ""){
        $("#Nom_up_err").addClass("has-error");
        $("#nom_span_err").text("Required field");
        isValid = false;
      }

      if(isValid == true){
        var id_group = $("#id_group").val();
        var name = $("#nom_update").val();
        var stream = $("#stream_update").val();
        console.log(name);
        //ajax request
        $.post(url_save_update,{id_group: id_group,name:name,stream:stream,_token:token},function(data){
          console.log(data);
          if(data == "true")
              swal("Job done!", "Group has been updated with success", "success");

        });
      }
  });
});



// For delete a group
$(function(){
    $(".delete_group").click(function(){
        var id_group = $(this).attr("id");
        //check if doesn't exist in Registration table
        $.post(url_check_id_group,{id_group: id_group, _token:token},function(data){
            if(data == "done"){
              swal("Job done!", "Group has been deleted with success", "success");
              $(document).on("click",".swal-button--confirm",function(){
                location.reload();
              });
            }else if(data == "error"){
              swal("Warning!", "You can't delete this group because it's associated with some students", "warning");
            }
        });
    });
});



//for add a group
$(function(){
    var name;
    var stream;
    $("#add_name").keyup(function(){
        name = $("#add_name").val();
        if(name.length > 1){
          stream = name.substr(0,name.length-2);
          $("#stream").val(stream);
        }
    });

    //submit button

    $("#add").click(function(event){
      //init
      $(".name_add_err").removeClass("has-error");
      $("#name_span_add_err").text("");

        event.preventDefault();
        if(name == ""){
          $(".name_add_err").addClass("has-error");
          $("#name_span_add_err").text("Required field");
        }else{
          //ajax
          $.post(add_group,{name:name,stream:stream,_token:token},function(data){
              swal("Job done!", "Group has been added with success", "success");
          });
        }
    });
});


/*  SHOW LIST OF STUDENTS */
$(function(){
  $(".toggle-modal-show").click(function(){
      var id_group = $(this).parent().parent().attr("id");
      //ajax request to get all student in that group id
      $.post(url_get_students,{id_group: id_group,_token:token},function(data){
            var i=0;
            if(data.length != 0){
              $("#group_name").text(data[0]['name']);
              //create table
              $("#show_student .modal-body").append("<table class='table'><thead><tr><th scope='col'>First name</th><th scope='col'>Last name</th><th scope='col'>Entered at</th></tr></thead><tbody></tbody></table>")
              while(i<data.length){
                $(".table tbody").append("<tr><td>"+data[i]['firstname']+"</td><td>"+data[i]['lastname']+"</td><td>"+data[i]['created_at']+"</td></tr>");
                i=i+1;
              }
            }else{
              $("#show_student .modal-body").html("<h3>This group does not contain any student</h3>")
            }

      });

      //make the tbody when modal is hidden
      $(document).on("hide.bs.modal","#show_student",function(){
        $("#show_student .modal-body").empty();
      })
  });
});
