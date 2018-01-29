
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
                            <th>Nom et Prénom</th>
                            <th>CIN</th>
                            <th>Session</th> 
                            <th>Type</th>   
                            <th>Résultat</th>
                            <th>Note</th>   
                            <th>Date Soutenance</th> 
                            <th>Remarque</th> 
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($alldata as $student)
                            <tr role="row" class="odd">
                              <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                              <td>{{ $student->cin }}</td>
                              <td>{{ $student->session }}</td>
                              <td>{{ $student->type }}</td>
                              <td>{{ $student->mention }}</td>
                              <td>{{$student->final_note}}</td>
                              <td>{{ $student->date_d }}</td>
                              <td style="font-size: 12px">{{ $student->notes }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
    
        </body>
        </html>
    
    