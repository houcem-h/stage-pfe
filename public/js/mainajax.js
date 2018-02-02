$(function(){
    function successAddingCompany(response){
        $("#errorsajax").hide();
        $('#successajax').show(400).append('<p>Company added successefully</p>').addClass('alert alert-success');
         setTimeout(function(){
            $("#successajax").hide(400).empty();
             window.location.href = "/companiesmanagers/create?c=" + response['company'] + "&pre=t";
         },4000);
    }

    function successUpdatingCompanyManager(response){
        $("#errorsajax").hide();
        $('#successajax').show(400).append('<p>CompanyManager updated successefully</p>').addClass('alert alert-success');
        setTimeout(function () {
            $("#successajax").hide(400).empty();
            window.location.href = "/company/"+response['company']+"/edit?c=&pre=t";
        }, 4000);
    }

    function failUpdatingCompanyManager(xhr){
            $("#errorsajax").show().addClass('alert alert-danger').empty();
            var errors = xhr.responseJSON['errors'];
            for (var i in errors)
                $("#errorsajax").append('<p>'+errors[i]+'</p>');
    }

    function failAddingCompany(xhr){
            $("#errorsajax").show().addClass('alert alert-danger').empty();
            var errors = xhr.responseJSON['errors'];
            for (var i in errors) 
                $("#errorsajax").append('<p>'+errors[i]+'</p>');
    }

    function successUpdatingCompany(response){
        $("#errorsajax").hide();
        $('#successajax').show(400).append('<p>Company updated successefully</p>').addClass('alert alert-success');
        setTimeout(function () {
            $("#successajax").hide(400).empty();
            window.location.href = "/studentdashboard";
        }, 4000);
    }

    // function failUpdatingCompany(xhr){
    //               $("#errorsajax").show().addClass('alert alert-danger').empty();
    //         var errors = xhr.responseJSON['errors'];
    //         for (var i in errors) 
    //             $("#errorsajax").append('<p>'+errors[i]+'</p>');

    // }

    $(document).bind("ajaxStart",function(){
        $("#bar").addClass('barloading');
    });

    $(document).bind('ajaxComplete',function(){
        setTimeout(function(){$("#bar").removeClass('barloading')},3000);
    });

    var ajax = Object.create(window.Ajax.prototype);
    
    $('form#formcreatecompany').submit(function(event){
        var form=$(this);
        ajax.init('/company','POST', true);
        var dataToSend =$(this).serialize();
        ajax.addData(dataToSend);
        ajax.execute(successAddingCompany, failAddingCompany);
        return false;
    });

    $('form#formupdatecompanymanager').submit(function(){
        var form = $(this);
        ajax.init('/companiesmanagers/'+$(form).attr('name'),'POST',true);
        var dataToSend = $(this).serialize();
        dataToSend +="&id="+$(form).attr('name');
        ajax.addData(dataToSend);
        ajax.execute(successUpdatingCompanyManager, failUpdatingCompanyManager);
        return false;
    });

    $('form#formupdatecompany').submit(function (event) {
        var form = $(this);
        ajax.init('/company/' + $(form).attr('name'), 'POST', true);
        var dataToSend = $(this).serialize();
        dataToSend+="&id="+$(this).attr('name');
        ajax.addData(dataToSend);
        ajax.execute(successUpdatingCompany, failAddingCompany);
        return false;
    });
    });

