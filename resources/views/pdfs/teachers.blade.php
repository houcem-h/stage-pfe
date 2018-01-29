
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
            <center><h1> Rapport </h1></center>
                <table  class="table">
                        <thead>
                          <tr role="row">
                            <th>Nom et Prénom Enseignant</th>
                            <th>Nom et Prénom Etudinat</th>
                            <th>Type</th> 
                            <th>Résultat</th>   
                            <th>Session</th>
                            <th>Date Soutenance</th>   
                            <th>Temps</th> 
                            <th>Remarques</th> 
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($alldata as $teacher)
                            <tr role="row" class="odd">
                              <td>{{ $teacher->teacher_firstname }} {{ $teacher->teacher_lastname }}</td>
                              <td>{{ $teacher->std_firstname }} {{ $teacher->std_lastname }}</td>
                              <td>{{ $teacher->type }}</td>
                              <td>{{ $teacher->final_note }}</td>
                              <td>{{ $teacher->session }}</td>
                              <td>{{$teacher->date_d}} </td>
                              <td>{{ $teacher->start_time }}</td>
                              <td>{{ $teacher->notes }}</td>
                           
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
    
        </body>
        </html>
    
    