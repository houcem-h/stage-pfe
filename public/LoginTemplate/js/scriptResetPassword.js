//ajax setup
(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  })();



$(function(){
    $("#resetMe").click(function(e){
        e.preventDefault();
        
        //init errors
        $("#emailReset").parent().attr("data-validate","Adresse email est obligatoire")
        $("#passwordReset").parent().attr("data-validate","Mot de passe est obligatoire")
        $("#passwordConfirmReset").parent().attr("data-validate","Confirmation mot de passe email est obligatoire")
        $(".validate-input").removeClass("alert-validate")
        var check = true;



          //all fields are check
          if($("#emailReset").val() == ""){
            showValidate($("#emailReset"));
            check = false;
          }else if(validateEmail($("#emailReset").val()) == false){
            showValidate($("#emailReset"));
            $("#emailReset").parent().attr("data-validate","Adresse email incorrect")
            check = false;
          }else{

          }

          if($("#passwordReset").val() == ""){
            showValidate($("#passwordReset"));
            check = false;
          }

          if($("#passwordConfirmReset").val() == ""){
            showValidate($("#passwordConfirmReset"));
            check = false;
          }else if($("#passwordReset").val() != $("#passwordConfirmReset").val()){
            showValidate($("#passwordReset"));
            $("#passwordReset").parent().attr("data-validate","Le mot de passe n'est identique")
            $("#passwordReset").val("")
            $("#passwordConfirmReset").val("")
            check = false;
          }else if($("#passwordReset").val().length < 8) {
            showValidate($("#passwordReset"));
            $("#passwordReset").parent().attr("data-validate","Le mot de passe doit avoir au minimum 8 caracteres")
            $("#passwordReset").val("")
            $("#passwordConfirmReset").val("")
            check = false;
          }

        





        if(check == true){
          console.log("true");
          e.preventDefault();
          //use register post to check email (no duplacate :p)
          $.post("RegisterCheckEmail",{email: $("#emailReset").val()},function(data){
            if(data == "done"){ //not exist
              showValidate($("#emailReset"));
              $("#emailReset").parent().attr("data-validate","Adresse email n'existe pas")
            }else{
              $("#ResetPasswordForm").submit();
            }
          });



          
        }



    })








    //functions
    function showValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }


    function validateEmail(email){
      if(email.trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
          return false;
      }
    }

});