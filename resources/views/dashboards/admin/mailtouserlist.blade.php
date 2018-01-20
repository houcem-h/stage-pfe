@extends('dashboards.admin.appdash')

@section('dash_content')
<br>

<div class="card">

    <div class="card-header">
        <div class="row">
            <div class="col-sm-12">Type Your Message Here</div>
        </div>
    </div>

    <div class="card-body">
            <div id="editor">
            </div>   
    </div>

    <div class="card-footer">
            <button id="mybtn" class="btn btn-success pull-right">Send Mail</button>
    </div>

</div>

<!--script for quill text editor-->
<script>
        var quill = new Quill('#editor', {
            modules: {
              toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                ['image', 'code-block']
              ]
            },
            placeholder: 'Write Something Here...',
            theme: 'snow'  // or 'bubble'
          });

        $('#test1').click(function() {
            var mytext = $(".ql-editor").html();
            console.log(delta);
        });


</script>    



<div class="card">
    <div class="card-header">
            <div class="row"><div class="col-sm-12">
                    <div class="row">
                            <div class="col-sm-12">Select Users</div>
                        </div>
            </div>
    </div>
    <div class="card-body">

            <div >
                    <div>
                        <div class="row">
                            <div class="col-6">
                                    <input id="search_byname" type="text" class="form-control" placeholder="Search By Name" onkeyup="search_table_by_name()"></input>

                            </div>
                            <div class="col-6">
                                    <input id="search_byemail" type="text" class="form-control" placeholder="Search By Email" onkeyup="search_table_by_email()"></input>

                            </div>                           

                        </div>
                        <br>
                        <table id="tableOne" class="table table-responsive-sm table-hover table-outline mb-0">

                            <thead>
                                <tr>                        
                                    <th>Select All : <input type="checkbox" /></th>
                                    <th>Nom et Prénom</th>
                                    <th>Email</th>
                                    <th>CIN</th>
                                    <th>Tel</th>
                                    <th>Date De Naissance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userlist as $user)
                                <tr>                                
                                    <td class="chk"><input type="checkbox" /></td>
                                        <td><strong>{{$user->firstname}} {{$user->lastname}} </strong></td>
                                        <td id="email">{{$user->email}}</td>
                                        <td>{{$user->cin}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->birthdate}}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <br>
                       
                    </div>
                </div>

    </div>
</div>

<script>
    //to check all
        $("#tableOne thead tr th:first input:checkbox").click(function () {
            var checkedStatus = this.checked;
            $("#tableOne tbody tr td:first-child input:checkbox").each(function () {
                this.checked = checkedStatus;
            });
        });
</script>

<script>
    //get emails from table as array when button clicked
    //    $("input:checked").each(function() {
    ///        console.log(this);
     // });


     $('td:not(.chk)').click( function() {


            $(this).parent().find("td:first-child").html('<input type="checkbox" checked>');
         
        
        
      });


      $( "#mybtn" ).click(function() {


        // get emails as array
        var checkedValues = $('input:checkbox:checked').map(function() {
            return $(this).parent().parent().find('#email').html();
        }).get();

        // get text from editor (HTML format)
        var text_from_editor = $(".ql-editor").html();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            type: "POST",
            url: "/sendmail",
            data: { emails : JSON.stringify(checkedValues), mytext: text_from_editor },
            beforeSend: function() {
                swal({
                    title: "Loading...",
                    text: "Please Wait While Sending Emails",
                    icon: 'https://rotoplas.com/rtp_resources/loading.gif'
                  });
             },
             complete: function() {
               // $('#general-ajax-load ').fadeOut();
             },
            success: function(resp)
            {
                swal("Email Sent!", "The mail has been sent successfully", "success");
            },
            error: function(resp) {
                swal("Error", "Error : " + "There was an erro while sending ..." , "error");
                console.log(  resp);
            }
            
          });


      });




</script>


<script>


    function search_table_by_name(){
                var input, filter, table, tr, td, i;
                input = document.getElementById("search_byname");
                filter = input.value.toUpperCase();
                table = document.getElementById("tableOne");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1]; //td name
                    if (td) {
                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            }
                            else {
                                tr[i].style.display = "none";
                            }
                    }       
                }
    }


    function search_table_by_email(){
        var input, filter, table, tr, td, i;
        input = document.getElementById("search_byemail");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableOne");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2]; //td name
            if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }
                    else {
                        tr[i].style.display = "none";
                    }
            }       
        }
}



</script>

@endsection