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

    $('#registerForm').on('submit',function(e){
        e.preventDefault();
        //i need to init the errors
        $("#email").parent().attr("data-validate","Adresse email est obligatoire")
        $("#cin").parent().attr("data-validate","Cin est obligatoire")
        $("#classe").parent().attr("data-validate","")
        // $("#pass").parent().attr("data-validate","Mot de passe est obligatoire")
        var check = true;
        var isValidCin = true;
        var isValidEmail = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                e.preventDefault();
                showValidate(input[i]);
                check=false;
            }
        }

        /****************** check cin ******************/
        //1: (must be integer)
            if(isNaN($("#cin").val()) == true){
                e.preventDefault();
                showValidate($("#cin"));
                $("#cin").parent().attr("data-validate","Cin doit etre numeric")
                check=false;

            }else if($("#cin").val().length != 8){
                    e.preventDefault();
                    showValidate($("#cin"));
                    $("#cin").parent().attr("data-validate","Cin est composé de 8 chiffres")
                    check=false;
            }




            //ajax request
            if($("#cin").val() != ""){
                if(checkCin($("#cin").val()) == "false"){
                    showValidate($("#cin"));
                    $("#cin").parent().attr("data-validate","Cin est deja existe")
                    isValidCin = false;
                }
            }


            if($("#email").val() != ""){
                if(checkEmail($("#email").val()) == "false"){
                  showValidate($("#email"));
                  $("#email").parent().attr("data-validate","Adresse email est deja existe")
                  isValidEmail = false;
                }
            }


            //check if student dosent select a classe
            if($("#classe").val() == "default"){
              showValidate($("#classe"));
              $("#classe").parent().attr("data-validate","Il faut choisir une classe")
              check = false;
            }






        /*************IF ALL DATA ARE CORRECT, TRY TO REGISTER THAT ACCOUNT ****************************/
        if(check == true && isValidCin == true && isValidEmail == true){
            e.preventDefault();
               $.post("registerAccount",{
                "nom":$("#nom").val(),
                "prenom":$("#prenom").val(),
                "email":$("#email").val(),
                "dob":$("#dob").val(),
                "cin":$("#cin").val(),
                "tel":$("#tel").val(),
                "classe":$("#classe").val(),
                "role":$("#role").val(),

           },function(data){
               if(data == "done"){
                   swal({
                       title: "Super!",
                       text: "Votre compte a été crée avec success! Nous vous envoyer un email contenant votre login et mot de passe",
                       closeOnClickOutside: false,
                       icon: "success"

                   });
                }else if(data == "error"){
                   swal("Error!","Nous rencontrons un petit probleme!","warning")
               }
           });


        }


    });

     //redirect student to his home page when he click "OK"
     $(document).on("click",".swal-button--confirm",function(){
        location.href="login";
    });


    function checkCin(){
        var res;
        $.ajax({
            url:"RegistercheckCin",
            async:false,
            method: "post",
            data:{cin: $("#cin").val()},
            success:function(data){
                res = data;
            }
        });

        return res;
    }

    function checkEmail(){
        var res;
        $.ajax({
            url:"RegisterCheckEmail",
            async:false,
            method: "post",
            data:{email: $("#email").val()},
            success:function(data){
                res = data;
            }
        });

        return res;
    }


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
