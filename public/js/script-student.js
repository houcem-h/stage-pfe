(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
})();


//swal the success session
$(function(){
    if( success == true){
      swal("Super!","Vos informations ont été changées avec success","success");
    }
});


//check password when user want to confirm his new email
//scond form
$(function(){
    $("#saveEmail").click(function(event){
          //init class errors
          $(".Div_Err_Pass").removeClass('has-error');
          $(".Span_Err_Pass").text("");
          $(".Div_Err_PassC").removeClass('has-error');
          $(".Span_Err_PassC").text("");
          $(".Div_Err_Email").removeClass('has-error');
          $(".Span_Err_Email").text("");

          //////////////////////////////
          event.preventDefault();
          var password = $("#password").val();
          var password_confirmation = $("#password_confirmation").val();
          var email = $("#email").val();
          var isValid = true;

          if(email == ""){
            console.log("empty");
            isValid = false;
            $(".Div_Err_Email").addClass('has-error');
            $(".Span_Err_Email").text("Required");
          }

          if(password == ""){
            console.log("empty");
            isValid = false;
            $(".Div_Err_Pass").addClass('has-error');
            $(".Span_Err_Pass").text("Required");
          }
          if(password_confirmation == ""){
            console.log("empty");
            isValid = false;
            $(".Div_Err_PassC").addClass('has-error');
            $(".Span_Err_PassC").text("Required");
          }

          if(isValid == true){
            $.post($("#SetNewEmailForm").attr("action"),{email:email,password:password, password_confirmation:password_confirmation},function(data){
                if(data == "wrong password"){ // password wrong
                  $(".Div_Err_Pass").addClass('has-error');
                  $(".Span_Err_Pass").text("Mot de passe incorrect");
                  $("#password").val("");
                  $("#password_confirmation").val("");
                }else if( data == "wrong password confirmation"){ // password confirmation doesn't match
                  $(".Div_Err_Pass").addClass('has-error');
                  $(".Span_Err_Pass").text("Mot de passe et mot de password confirmation ne sont pas identique");
                  $("#password").val("");
                  $("#password_confirmation").val("");
                }else if(data == "true"){ // all fields are correct
                  swal("Super!", "Votre adresse email a été changé avec success! Essayer de se connecter","success");
                }else if(data == "email exist"){
                    $(".Div_Err_Email").addClass("has-error");
                    $(".Span_Err_Email").text("Email est deja existe");
                    $("#password").val("");
                    $("#password_confirmation").val("");
                }else if(data == "wrong email"){
                  $(".Div_Err_Email").addClass("has-error");
                  $(".Span_Err_Email").text("Email est invalid");
                  $("#password").val("");
                  $("#password_confirmation").val("");
                }else{
                  console.log(data);
                }
            });
            //redirect student to his home page when he click "OK"
            $(document).on("click",".swal-button--confirm",function(){
                location.reload();
            });
          }

    });
});


// when user want to change his password
$(function(){
  $("#save_new_pass").click(function(event){
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
          $.post($("#EditPasswordForm").attr("action"),{
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


// show notification when a teacher send a request a student
$(function(){
  var isShown=false;
  $.ajax({
      url: "NotifyMe",
      method: "post",
      data: {},
      success:function(data){
          if(data.length > 0 ){ //the student has notfication
            $.toast({
              heading: 'Notification',
              text: "l y'a des enseignants veux t'encadrer! Voir vos notifications pour plus info",
              icon: 'info',
              loader: true,
              showHideTransition: 'slide',
              bgcolor: '#3d3d3d',
              loaderBg: "#7158e2",
              textAlign: 'left',
              position: 'bottom-right',
          })

          $(".notification").addClass("animated infinite bounce")
            console.log("notif");
            isShown = true;
          }else{
            $(".notification").removeClass("animated infinite bounce")
          }
      }
  });
});


//when user accept/decline a teacher demande
$(function(){
    $(".accept").click(function(){
        var idFrame = $(this).parent().parent().attr('id');
        var internship = $(this).parent().parent().attr("data-intern");
        var teacher = $(this).parent().parent().attr("data-teachId");
        $.post("acceptDemande",{id_frame: idFrame, internship: internship,teacher:teacher},function(data){
            if(data == "done"){
              swal({
                title: "Super!",
                text: "Votre acceptation sera envoyée à cet enseignant",
                icon:"success",
                button: false,
              });

              //replace the button of the selected teacher (success)
              $("#"+idFrame+" .actions").html('<span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Accepté</span>');

              //replace the rest of the non-selected teacher (X)
              // $("tr [id !='"+idFrame+"']").find(" td .actions").html('<span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Refusée</span>');
              $(".requests tr").each(function(index){
                var id = $(this).attr("id");
                if(id != idFrame)
                  $("#"+id+" .actions").html('<span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Refusée</span>')
              });
            }

            console.log(data);
        })


        //redirect student to his home page when he click "OK"
        $(document).on("click",".swal-button--confirm",function(){
          location.reload();
        });
    });


    $(".decline").click(function(){
      var idFrame = $(this).parent().parent().attr('id')
      $.post("rejectDemande",{id_frame: idFrame},function(data){
          $("tbody tr#"+idFrame).fadeOut("slow")
      })
  });
});
