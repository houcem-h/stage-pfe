
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$(function(){
  $(".toggle-modal-show").click(function(){
      var id_inter = $(this).attr("id");

       $.get("information/"+id_inter,function(data){

        if(data.length != 0){
            $("#title").text(data[0]['firstname']+" "+data[0]['lastname']);
            $('#studentnum').text(data[0]['phone']);
            $('#studentemail').text(data[0]['email']);
            $('#managernum').text(data[1]['phone']);
            $('#manageremail').text(data[1]['email']);
            $("#managerposition").text(data[1]['position']);
            $("#titre").text(data[2]['title']);
            $('#existing_desc').text(data[2]['existing_desc']);
            $('#requirement_spec').text(data[2]['requirement_spec']);
            $('#hardware_env').text(data[2]['hardware_env']);
            $('#software_env').text(data[2]['software_env']);
            $("#provisional_planning").text(data[2]['provisional_planning']);
            }
     });

    $(document).on("hide.bs.modal","#information",function(){
       $("#title").text().empty();
       $('#studentnum').text().empty();
       $('#studentemail').text().empty();
       $('#managernum').text().empty();
       $('#manageremail').text().empty();
       $("#managerposition").text().empty();
       $("#titre").text().empty();
       $('#existing_desc').text().empty();
       $('#requirement_spec').text().empty();
       $('#hardware_env').text().empty();
       $('#software_env').text().empty();
       $("#provisional_planning").text().empty();
      })
  });
});
