
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
            <center><h1>Liste Des Enseignants</h1></center>
                <table  class="table">
                        <thead>
                          <tr role="row">
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th> 
                            <th>Date De Naissance</th>   
                            <th>CIN</th>   
                            <th>Tel</th>  
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($teachers as $teacher)
                            <tr role="row" class="odd">
                              <td>{{ $teacher->firstname }}</td>
                              <td>{{ $teacher->lastname }}</td>
                              <td>{{ $teacher->email }}</td>
                              <td>{{ $teacher->birthdate }}</td>
                              <td>{{ $teacher->cin }}</td>
                              <td>{{ $teacher->phone }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
    
        </body>
        </html>
    
    