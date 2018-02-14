(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  })();

  
// add action on student's inviations

$(function(){
    $(".acceptStudentInvit").click(function(){
        //add user to registration table
        var registrationId = $(this).parent().parent().attr("id");
        var userId = $(this).parent().parent().attr("class")
        var userEmail = $(this).parent().parent().attr("userEmail");
        acceptAStudent(userId,registrationId, userEmail);
    })

    $(".deleteStudentInvit").click(function(){
        //add user to registration table
        var registrationId = $(this).parent().parent().attr("id");
        var userId = $(this).parent().parent().attr("class")
        var userEmail = $(this).parent().parent().attr("userEmail")
        deleteAStudent(userId,registrationId, userEmail);
    })


    /** when admin want to accept/delete many student in same time (checkbox) */

    //1 : when admin want to accept/delete all student (selectionner tout)
    $("#selectAll").click(function(){
        var results = new Array();
        //init disbaled button
       if($("#selectAll").is(":checked")){
           //delete disable from buttons
           $("#acceptChecked").removeAttr("disabled");
           $("#deleteChecked").removeAttr("disabled");

           //make all checkbox checked
           $(".checkbox").attr("checked","checked");

    
            //accept
            $("#acceptChecked").click(function(){
                //get list of all id students
                results = getAllChecked();
                var i=0
                acceptStudentAll(i);
            })

            //delete
            $("#deleteChecked").click(function(){
                //get list of all id students
                results = getAllChecked();
                var i=0;
                deleteStudentAll(i);
            })

       }else{
           //make all checkbox unchecked
            $(".checkbox").removeAttr("checked");

            $("#acceptChecked").attr("disabled","disabled");
            $("#deleteChecked").attr("disabled","disabled");
       }
        
    });





    //2: when use choose to accept/delete custom students
    $(".checkbox").click(function(){
        if($(".checkbox").is(":checked")){
            //delete disable from buttons
            $("#acceptChecked").removeAttr("disabled");
            $("#deleteChecked").removeAttr("disabled");


             //accept
             $("#acceptChecked").click(function(){
                var i=0
                acceptStudentAll(i);
            })

            //delete
            $("#deleteChecked").click(function(){
                var i=0;
                deleteStudentAll(i);
            })


        }else{
            $("#acceptChecked").attr("disabled","disabled");
            $("#deleteChecked").attr("disabled","disabled");
        }
        
    });



});



/////////////////////////////////// add action to teacher
$(function(){
    $(".acceptTeacherInvit").click(function(){
        var userId = $(this).parent().parent().attr("id");
        var userEmail = $(this).parent().parent().attr("userEmail");
        acceptATeacher(userId, userEmail);
    })

    $(".deleteTeacherInvit").click(function(){
        var userId = $(this).parent().parent().attr("id");
        var userEmail = $(this).parent().parent().attr("userEmail");
        deleteATeacher(userId, userEmail);
    })


    /** when admin want to accept/delete many teachers in same time (checkbox) */

    //1 : when admin want to accept/delete all teachers (selectionner tout)
    $("#selectAllTeacher").click(function(){
        var results = new Array();
        //init disbaled button
       if($("#selectAllTeacher").is(":checked")){
           //delete disable from buttons
           $("#acceptCheckedTeacher").removeAttr("disabled");
           $("#deleteCheckedTeacher").removeAttr("disabled");

           //make all checkbox checked
           $(".checkboxTeacher").attr("checked","checked");

    
            //accept
            $("#acceptCheckedTeacher").click(function(){
                var i=0
                acceptTeacherAll(i);
            })

            //delete
            $("#deleteCheckedTeacher").click(function(){
                var i=0;
                deleteTeacherAll(i);
            })

       }else{
           //make all checkbox unchecked
            $(".checkboxTeacher").removeAttr("checked");

            $("#acceptCheckedTeacher").attr("disabled","disabled");
            $("#deleteCheckedTeacher").attr("disabled","disabled");
       }
        
    });





    //2: when use choose to accept/delete custom teacher
    $(".checkboxTeacher").click(function(){
        if($(".checkboxTeacher").is(":checked")){
            //delete disable from buttons
            $("#acceptCheckedTeacher").removeAttr("disabled");
            $("#deleteCheckedTeacher").removeAttr("disabled");


             //accept
             $("#acceptCheckedTeacher").click(function(){
                var j=0
                acceptTeacherAll(j);
            })

            //delete
            $("#deleteCheckedTeacher").click(function(){
                var j=0;
                deleteTeacherAll(j);
            })


        }else{
            $("#acceptCheckedTeacher").attr("disabled","disabled");
            $("#deleteCheckedTeacher").attr("disabled","disabled");
        }
        
    });
});








/********************************************* FUNCTIONS ********************************************* */


    /******* FOR STUDENTS *********/

    function getAllChecked(){
        tab = new Array();
        $(".checkbox:checked").each(function(){
            var registrationId = $(this).parent().parent().attr("id");
            var userId = $(this).parent().parent().attr("class");
            var userEmail = $(this).parent().parent().attr("userEmail");
            tab.push([registrationId,userId,userEmail]);
        })

        return tab;
    }




    function acceptStudentAll(i){
        var tab=getAllChecked();
        if ( i < tab.length){
            $.post("acceptStudent",{
                registrationId: tab[i][0],
                userId: tab[i][1],
                userEmail: tab[i][2]
            },function(data){
                if(data == "done"){
                    $("#"+tab[i][0]).fadeOut("slow");
                }
            })

            setTimeout(function(){
                acceptStudentAll(i+1);
            },500)
            
        }
        
        

    }


    function deleteStudentAll(i){
        var tab=getAllChecked();
        if ( i < tab.length){
            $.post("deleteStudent",{
                registrationId: tab[i][0],
                userId: tab[i][1],
                userEmail: tab[i][2]
            },function(data){
                if(data == "done"){
                    $("#"+tab[i][0]).fadeOut("slow");
                }
            })

            setTimeout(function(){
                deleteStudentAll(i+1);
            },500)
            
        }
    }


    function acceptAStudent(userId,registrationId,userEmail){
        $.post("acceptStudent",{
            registrationId: registrationId,
            userId: userId,
            userEmail : userEmail
        },function(data){
            if(data == "done"){
                $("#"+registrationId).fadeOut("slow");
            }
        })
    }


    function deleteAStudent(userId,registrationId, userEmail){
        $.post("deleteStudent",{
            registrationId: registrationId,
            userId: userId,
            userEmail: userEmail
        },function(data){
            if(data == "done"){
                $("#"+registrationId).fadeOut("slow");
            }
        })

    }
    /******* FOR TAECHERS *********/

    function getAllCheckedTeachers(){
        tab = new Array();
        $(".checkboxTeacher:checked").each(function(){
            var userId = $(this).parent().parent().attr("id")
            var userEmail = $(this).parent().parent().attr("userEmail")
            tab.push([userId,userEmail]);
        })

        return tab;
    }




    function acceptTeacherAll(i){
        var tab=getAllCheckedTeachers();
        if ( i < tab.length){
            $.post("acceptTeacher",{userId:tab[i][0], userEmail:tab[0][1]},function(data){
                if(data == "done"){
                    $("#"+tab[i]).fadeOut("slow");
                }
            })

            setTimeout(function(){
                acceptTeacherAll(i+1);
            },500)
            
        }
        
        

    }


    function deleteTeacherAll(i){
        var tab=getAllCheckedTeachers();
        if ( i < tab.length){
            $.post("deleteTeacher",{userId:tab[i][0], userEmail:tab[i][1] },function(data){
                if(data == "done"){
                    $("#"+tab[i]).fadeOut("slow");
                }
            })

            setTimeout(function(){
                deleteTeacherAll(i+1);
            },500)
            
        }
    }


    function acceptATeacher(userId, userEmail){
        $.post("acceptTeacher",{userId: userId, userEmail: userEmail},function(data){
            if(data == "done"){
                $("#"+userId).fadeOut("slow");
            }
        })
    }


    function deleteATeacher(userId, userEmail){
        $.post("deleteTeacher",{userId:userId, userEmail: userEmail},function(data){
            if(data == "done"){
                $("#"+userId).fadeOut("slow");
            }
        })
    }

    