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
 