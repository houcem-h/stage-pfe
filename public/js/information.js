
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$(function(){
  $(".toggle-modal-show").click(function(){
      var id_inter = $(this).attr("id");

       $.get("information/"+id_inter,function(data){

        if(data.length != 0){
            $("#title").text(data[0]['firstname']+" "+data[0]['lastname']);
            $('#studentnum').text(data[0]['phone']);
            $('#studentemail').text(data[0]['email']);
            $('#managernum').text(data[1]['phone']);
            $('#manageremail').text(data[1]['email']);
            $("#managerposition").text(data[1]['position']);
            $("#titre").text(data[2]['title']);
            $('#existing_desc').text(data[2]['existing_desc']);
            $('#requirement_spec').text(data[2]['requirement_spec']);
            $('#hardware_env').text(data[2]['hardware_env']);
            $('#software_env').text(data[2]['software_env']);
            $("#provisional_planning").text(data[2]['provisional_planning']);
            }
     });

    $(document).on("hide.bs.modal","#information",function(){
       $("#title").text().empty();
       $('#studentnum').text().empty();
       $('#studentemail').text().empty();
       $('#managernum').text().empty();
       $('#manageremail').text().empty();
       $("#managerposition").text().empty();
       $("#titre").text().empty();
       $('#existing_desc').text().empty();
       $('#requirement_spec').text().empty();
       $('#hardware_env').text().empty();
       $('#software_env').text().empty();
       $("#provisional_planning").text().empty();
      })
  });
});

// Amine password change
// // when user want to change his password
$(function(){
  $("#save_new_passteacher").click(function(event){
      //init errors
      $(".Div_Err_PA").removeClass("has-error");
      $(".Span_Err_PA").text("");
      $(".Div_Err_PN").removeClass("has-error");
      $(".Span_Err_PN").text("");
      $(".Div_Err_PC").removeClass("has-error");
      $(".Span_Err_PC").text("");

      event.preventDefault();
      //required fields
      var passAct = $("#passAct").val();
      var passNouv = $("#passNouv").val();
      var passConfirm = $("#passNouvConfirm").val();

      var isValid = true;

      if(passAct == ""){
        isValid = false;
        $(".Div_Err_PA").addClass("has-error");
        $(".Span_Err_PA").text("Required");
      }

      if(passNouv == ""){
        isValid = false;
        $(".Div_Err_PN").addClass("has-error");
        $(".Span_Err_PN").text("Required");
      }

      if(passConfirm == ""){
        isValid = false;
        $(".Div_Err_PC").addClass("has-error");
        $(".Span_Err_PC").text("Required");
      }

      if(isValid == true){
          $.post($("#EditPasswordFormteacher").attr("action"),{
              password_actuel: passAct,
              password_nouv: passNouv,
              password_confirm: passConfirm,

            },function(data){
              //check if password actuel is wrong
              if(data == "wrong password"){
                $(".Div_Err_PA").addClass("has-error");
                $(".Span_Err_PA").text("mot de passe actuel est incorrect");
                $("#passAct").blur();
                //make all fields empty
                $("#passAct").val("");
                $("#passNouv").val("");
                $("#passNouvConfirm").val("");
              }else if(data == "wrong password confirmation"){ // check if password confirmation === password nouv
                $(".Div_Err_PN").addClass("has-error");
                $(".Span_Err_PN").text("mot de passe actuel et mot de passe de confirmation doivent etre identiques");
                $("#passNouv").blur();
                $("#passNouvConfirm").blur();
                //make all fields empty
                $("#passAct").val("");
                $("#passNouv").val("");
                $("#passNouvConfirm").val("");
              }else if(data == "length"){
                $(".Div_Err_PN").addClass("has-error");
                $(".Span_Err_PN").text("Taille de mot de passe est 8 caracters");
                $("#passNouv").blur();
                $("#passNouvConfirm").blur();
                //make all fields empty
                $("#passAct").val("");
                $("#passNouv").val("");
                $("#passNouvConfirm").val("");
              }else if(data == "done"){ // all fields are correct
                 swal("Super!", "Votre mot de passe a été changé avec success! Essayer de se connecter!","success");
              }else{
                swal("Sorry!", "There is a problem!Please re fresh your page and try it again :)","error");
              }

          });

           //redirect student to his home page when he click "OK"
           $(document).on("click",".swal-button--confirm",function(){
              location.reload();
          });
      }

  });
});
