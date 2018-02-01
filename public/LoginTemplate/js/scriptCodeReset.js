//ajax setup
(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  })();


$(function(){
    $("#SaveCodeConfirmation").click(function(e){
        e.preventDefault();
        var check = true;
        var email;
        //init error
        $("#code").parent().attr("data-validate","code confirmation est obligatoire")


        if($("#code").val() == ""){
            showValidate($("#code"));
            check = false;
        }else{

            //url: ?code=xxxxxxxxx-code-email
            var url = window.location.search.substring(1);
            var urlSplit = url.split("=")[1]; //xxxxxxxxx-code-email

            //get code
            code = urlSplit.split("-")[1]
            //email
            email = urlSplit.split("-")[2]

            // check if the code from url is equal to field value
            if($("#code").val() != code){
                showValidate($("#code"));
                $("#code").parent().attr("data-validate","code confirmation est incorrect")
                check = false;
            }



        }


        if(check == true){
            console.log("done");
            $.post("FinalResetPassword",{email: email},function(data){
                if(data == "done"){
                    swal("Super!","Votre mot de passe a été modifié! Essayer to se connecter","success");
                }else{
                    swal("Ooops!","Nous rencontrons des problemes","error");
                }
            })
            
        }
        
    })



    //redirect student to his home page when he click "OK"
    $(document).on("click",".swal-button--confirm",function(){
        location.location = "/login";
    });




    //functions

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }



});