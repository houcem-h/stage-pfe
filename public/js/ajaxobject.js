       //Ajax Object
        var Ajax = function () {

        };

        Ajax.prototype.init = function (url, method, returnJson) {
            this.url = url;
            this.method = method;
            this.data = "";
            this.processData = true;
            this.contentType = "application/x-www-form-urlencoded; charset=UTF-8";
            this.dataType = (returnJson == true) ? "json" : "text";
            if (method == "post" || method == "POST") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
            return this;
        };

        Ajax.prototype.addData = function (MapObject) {
            if(!(MapObject instanceof FormData) && typeof MapObject==="object"){
                for (var key in MapObject) {
                    if (MapObject.hasOwnProperty(key)) {
                        if (this.data == "" || this.data.length == 0)
                            this.data = key + "=" + MapObject[key];
                        else
                            this.data += "&" + key + "=" + MapObject[key];
                    }
                }
            }else{
                if(typeof MapObject==="string"){
                     this.data=MapObject;
                }else{
                    this.processData = false;
                    this.contentType = false;
                    this.data = MapObject;
                 }
            }
            return this;
        };

        Ajax.prototype.execute = function (successCallback,errorCallback) {
            var thisObject = this;
            $.ajax({
                url: thisObject.url,
                method: thisObject.method,
                data: thisObject.data,
                dataType: thisObject.dataType,
                processData: thisObject.processData,
                contentType: thisObject.contentType,
                success:successCallback,
                error:errorCallback,
            });
            return this;
          
        };
         // FormChecker Object verify Forms inputs

        var FormChecker = {
                hasPhoneOrFaxInput:function(key){
                    if(key.indexOf('fax') != -1 || key.indexOf('phone') != -1)
                    return true;
                    return false;   
                },
                hasEmailInput:function(key){
                    return (key.indexOf('email') != -1)?true:false;             
                },
                checkEmail:function(email){
                    var regexpemail = /^[a-z0-9.*\!#\-_@]{3,}@[a-z]{3,}\.[a-z]{2,}$/;
                    return regexpemail.test(email);
                },
                checkForm: function (MapInputs) {
                    //MapInputs key=id input,value=message d erreur
                    var errorsObject={};
                    var test = false;
                    if(typeof MapInputs == "object") {
                        if ($('#start_date').val().length!=0 && $('#end_date').val().length!=0){
                            if($('#start_date').val() >= $("#end_date").val()){
                                test = true;
                                errorsObject['end_date'] = 'date invalide';
                                errorsObject['start_date'] = 'date invalide';
                            }
                        }
                        for(var key in MapInputs) {
                             if ( ($('#' + key).val()=="" || $('#' + key).val().length==0) && (key.indexOf('fax')<0)){
                                test=true;
                                errorsObject[key]=MapInputs[key];
                                              
                             }else if (this.hasEmailInput(key) && !this.checkEmail($('#'+key).val())){
                                test = true;
                                errorsObject[key] = MapInputs[key]; 
                             }
                        }
                    }
                    return (test==false)?false:errorsObject;
                },checkFormSpecialisation:function(){

                }
        };
 