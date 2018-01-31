//ajax setup
(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  })();


$(function(){

    /*************VALIDATE ***************/
    $("#login").click(function(e){
        e.preventDefault();
        //i need to init errros
        $("#emailLog").parent().attr("data-validate","Adresse email est obligatoire")
        $("#passLog").parent().attr("data-validate","Mot de passe est obligatoire")
        $(".validate-input").removeClass("alert-validate")
        var check = true;
        var validEmail = true;

        /*** check Required fields *****/
        if($("#emailLog").val() == ""){
            e.preventDefault();
            showValidate($("#emailLog"));
            check = false;
        }else if(validateEmail($("#emailLog").val()) == false){
            e.preventDefault();
            showValidate($("#emailLog"));
            $("#emailLog").parent().attr("data-validate","Adresse email incorrect")
            check = false;
        }







        if($("#passLog").val() == ""){
            e.preventDefault();
            showValidate($("#passLog"));
            check = false;
        }




        //check if the connection is correct
        if($("#passLog").val() != "" && $("#emailLog").val() != "" && validateEmail($("#emailLog").val()) != false && check == true){
            
            $.post("checkConnection",{email: $("#emailLog").val(),password: $("#passLog").val()},function(data){
                //if user information are wrong
                if(data == "login error"){
                    swal("Ooops!","Vos coordonnée sont incorrectes!","warning");
                }else if(data == "waiting"){
                    swal("Ooops!","Votre demande n'est pas encore acceptée!","info");
                }else if(data == "rejected"){
                    swal("Ooops!","Votre demande a été rejeté!","error");
                }else{
                    $("#loginForm").submit();
                    //console.log(data);
                }

                
            });

            
        }


    
    });















    //funtion validations
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