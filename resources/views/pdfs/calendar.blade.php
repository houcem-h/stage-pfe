
<html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
                table {
                  border-collapse: collapse;
                  width: 100%;
                }
                td, th {
                  border: solid 2px;
                  padding: 10px 5px;
                }
                tr {
                  text-align: center;
                }
                .container {
                  width: 100%;
                  text-align: center;
                }
              </style>
        </head>
        <body>
            <center><h1> Liste Des Soutenances </h1></center>
                <table  class="table">
                        <thead>
                          <tr role="row">
                            <th>Date Soutenance</th>
                            <th>Nom et Prénom</th>
                            <th>CIN</th> 
                            <th>Salle</th>
                            <th>Société</th>   
                            <th>Type Stage</th>   
                            <th>Rapporteur</th> 
                            <th>Président</th> 
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($alldata as $student)
                            <tr role="row" class="odd">
                              <td>{{ $student->date_d }} - {{$student->start_time}}</td>
                              <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                              <td>{{ $student->cin }}</td>
                              <td>{{ $student->classroom }}</td>
                              <td>{{ $student->company_name }}</td>
                              <td>{{ $student->type }}</td>
                              <td>{{ \App\Http\Controllers\GetStat::get_teacher_fullname($student->reporter)  }}</td>
                              <td>{{ \App\Http\Controllers\GetStat::get_teacher_fullname($student->president)  }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
    
        </body>
        </html>
    
    