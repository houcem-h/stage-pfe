//ajax setup
(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  })();



// start form validations


(function ($) {
    "use strict";

    
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('#registerFormTeacher').on('submit',function(e){
        //i need to init the errors
        $("#email").parent().attr("data-validate","Adresse email est obligatoire")
        $("#pass").parent().attr("data-validate","Mot de passe est obligatoire")
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                e.preventDefault();
                showValidate(input[i]);
                check=false;
            }
        }



        
            /****************** check password ******************/
            //1: length of password is 8
            if($("#pass").val().length < 8){
                e.preventDefault();
                showValidate($("#pass"));
                $("#pass").parent().attr("data-validate","Mot de passe doit avoir au minimum 8 caractere")
                check=false;
            }

            /****************** check email ******************/
            //1: email should unique

            if($("#email").val() != ""){
                $.post("RegisterCheckEmail",{email: $("#email").val()},function(data){
                    e.preventDefault();
                    if(data == "false"){
                        showValidate($("#email"));
                        $("#email").parent().attr("data-validate","Cette email exist déja")
                        check=false;
                    }
                    
                });
            }
            


        /*************IF ALL DATA ARE CORRECT, TRY TO REGISTER THAT ACCOUNT ****************************/
        if(check == true){
            e.preventDefault();
           $.post("registerAccountTeacher",{
                "nom":$("#nom").val(),
                "prenom":$("#prenom").val(),
                "email":$("#email").val(),
                "password":$("#pass").val(),
                "dob":$("#dob").val(),
                "tel":$("#tel").val(),
                "role":$("#role").val(),

           },function(data){
               if(data == "done"){
                   swal("Super!","Votre compte a été crée avec success! Nous vous envoyer un email lors de l'activation de votre compte","success");
                }else if(data == "error"){
                   swal("Error!","Nous rencontrons un petit probleme!","warning")
               }else{
                   console.log(data);
               }
           });
        }
    
    
    });
    
     //redirect student to his home page when he click "OK"
     $(document).on("click",".swal-button--confirm",function(){
        location.href="login";
    });


































    //******************************  Show errors *************************************/
    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);