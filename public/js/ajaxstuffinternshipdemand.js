(function(){
    var isPfeInternship = false;
    $("#type").change(function () {
        if ($(this).val() == 'pfe'){
            isPfeInternship = true;
            $('#divforframerone').show(200);
            $('#divforbuddy').show(200);
        }else{
            $('#divforframerone').hide();    
            $('#divforbuddy').hide(); 
        }  
        
    });

    $(document).bind('ajaxComplete', function () {
        $('#bar').removeClass('barloading');
    });

 $(function(){
     var dataToSendFormattedString = "";
        $('#formcreatecompany').submit(function(e){
            e.preventDefault();
            var inputs = { companyname: 'remplir le nom', companyactivity: 'remplir l activite', companyphone: 'phone invalide', companyfax: 'fax invalide', companyaddress: 'adresse invalide' };
            var ret = FormChecker.checkForm(inputs);
            if(!ret){
                var companyFormData = $('#formcreatecompany').serialize();
                dataToSendFormattedString=companyFormData;
                for(var key in inputs)
                    $('#' + key).css('border', 'solid 1px #2E7866');

                $('#bar').addClass('barloading');
                setTimeout(function(){
                    $('#formcreatecompany').hide();
                    $('#bar').removeClass('barloading');
                    $("#formcreatecompanymanager").show();
                },3000);
            }else{
                for(var key in inputs){
                    if(ret.hasOwnProperty(key))
                        $('#' + key).css('border','solid 1px #c0392b');
                    else
                        $('#' + key).css('border', 'solid 1px #2E7866');
                }
            }
        });
    
    
        $('#formcreatecompanymanager').submit(function(e){
            e.preventDefault();
            var inputs = { managername: 'remplir le nom', managerphone: 'tel invalide', manageremail: 'email invalide', managerposition: 'donnes invalides' };
            var ret = FormChecker.checkForm(inputs);          
            if(!ret){ 
                var companyManagerFormData = $('#formcreatecompanymanager').serialize(); 
                dataToSendFormattedString += "&" + companyManagerFormData;                
                for (var key in inputs)
                    $('#' + key).css('border', 'solid 1px #2E7866'); 
             
                $('#bar').addClass('barloading');
                setTimeout(function () {
                    $('#formcreatecompanymanager').hide();
                    $('#bar').removeClass('barloading');
                    $("#formcreateinternship").show();
                }, 3000);
            }else {
                for (var key in inputs) {
                    if (ret.hasOwnProperty(key))
                        $('#' + key).css('border', 'solid 1px #c0392b');
                    else
                        $('#' + key).css('border', 'solid 1px #2E7866');
                }
            }
        });


        $('#formcreateinternship').submit(function(e){
            e.preventDefault();
            var inputs = { start_date: 'date invalide', end_date: 'date invalide', type: '', framer: 'donnes invalides' };
            var ret = FormChecker.checkForm(inputs);  
            if (!ret) {
                var companyManagerFormData = $('#formcreateinternship').serialize();
                dataToSendFormattedString += "&" + companyManagerFormData;
                for (var key in inputs)
                    $('#' + key).css('border', 'solid 1px #2E7866');                        
                $('#bar').addClass('barloading');
                setTimeout(function(){
                    $('#bar').removeClass('barloading');
                    if(isPfeInternship){
                        $('#formcreateinternship').hide();
                        $("#formcreatespecification").show();
                    }else{
                        var ajax = Object.create(window.Ajax.prototype);
                        ajax.init('/internshipsave', 'POST', true);
                        ajax.addData(dataToSendFormattedString);
                        ajax.execute(function (rep) {
                            $('#successajax').show().addClass('alert alert-success').text(rep['success']);
                            $("#errorsajax").hide();
                            document.getElementById('formcreateinternship').reset();
                            window.location.href="/studentdashboard";
                        }, function (xhr) {
                            $("#errorsajax").show().addClass('alert alert-danger').empty();
                            var errors = xhr.responseJSON['errors'];
                            for (var i in errors)
                                $("#errorsajax").append('<p>' + errors[i] + '</p>');
                        });                        
                    }
                }, 3000);
            }else{
                for (var key in inputs) {
                    if (ret.hasOwnProperty(key))
                        $('#' + key).css('border', 'solid 1px #c0392b');
                    else
                        $('#' + key).css('border', 'solid 1px #2E7866');
                }
            }
        });

        $('#formcreatespecification').submit(function(e){
           e.preventDefault();
            var inputs = { spectitle: 'date invalide', projecttype: 'date invalide', existingdesc: '', requirementspec: 'donnes invalides',hardwareenv:'donnes invalides',softwareenv:'donnes invalides',provisionalplanning:'donnes invalides' };
            var ret = FormChecker.checkForm(inputs);      
            if(!ret){
                var companyManagerFormData = $('#formcreatespecification').serialize();
                dataToSendFormattedString += "&" + companyManagerFormData;
                for (var key in inputs)
                    $('#' + key).css('border', 'solid 1px #2E7866');
                $('#bar').addClass('barloading');
                setTimeout(function () {
                    $('#bar').removeClass('barloading');
                        var ajax = Object.create(window.Ajax.prototype);
                        ajax.init('/internshipsave', 'POST', true);
                        ajax.addData(dataToSendFormattedString);
                        ajax.execute(function (rep) {
                            $('#successajax').show().addClass('alert alert-success').text(rep['success']);
                            $("#errorsajax").hide();
                            document.getElementById('formcreatespecification').reset();
                            window.location.href = "/studentdashboard";
                        }, function (xhr) { 
                            $("#errorsajax").show().addClass('alert alert-danger').empty();
                            var errors = xhr.responseJSON['errors'];
                            for (var i in errors)
                                $("#errorsajax").append('<p>' + errors[i] + '</p>');
                        });
                }, 3000);                                
            } else{
                for (var key in inputs) {
                    if (ret.hasOwnProperty(key))
                        $('#' + key).css('border', 'solid 1px #c0392b');
                    else
                        $('#' + key).css('border', 'solid 1px #2E7866');
                }                
            }      
        });

 });

})();