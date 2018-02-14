
<html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
                
              </style>
        </head>
        <body>
            <center><h1>Fiche Etudiant</h1></center>

            <table style="border-color: white !important">
                <tr>
                    <td>
                            <h3>• Nom et Prénom : </h3>
                    </td>
               
                
                    <td class="center">
                            <h3>{!! $fiche->pluck("firstname")->first() !!} {!! $fiche->pluck("lastname")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Date Soutenance : </h3>
                    </td>
                
                    <td class="center">
                            <h3>{!! $fiche->pluck("date_d")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Temps : </h3>
                    </td>
               
                    <td class="center">
                            <h3>{!! $fiche->pluck("start_time")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Salle : </h3>
                    </td>
                
                    <td class="center">
                            <h3>{!! $fiche->pluck("classroom")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Type De Stage : </h3>
                    </td>
                
                    <td class="center">
                            <h3>{!! $fiche->pluck("type")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• CIN :</h3>
                    </td>
               
                    <td class="center">
                            <h3>{!! $fiche->pluck("cin")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Tel :</h3>
                    </td>
               
                    <td class="center">
                            <h3>{!! $fiche->pluck("phone")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Session</h3>
                    </td>
                
                    <td class="center">
                            <h3>{!! $fiche->pluck("session")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Classe : </h3>
                    </td>
                
                    <td class="center">
                            <h3>{!! $fiche->pluck("name")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Email : </h3>
                    </td>
                
                    <td class="center">
                            <h3>{!! $fiche->pluck("email")->first() !!}</h3>
                    </td>
                </tr>
                <tr>
                        <td>
                                <h3>• Formateur : </h3>
                        </td>
                    
                        <td class="center">
                                <h3>{!! \App\Http\Controllers\GetStat::get_teacher_fullname($fiche->pluck("framer")->first())  !!}</h3>
                        </td>
                    </tr>
                <tr>
                    <td>
                            <h3>• Rapporteur : </h3>
                    </td>
                
                    <td class="center">
                            <h3>{!!  \App\Http\Controllers\GetStat::get_teacher_fullname($fiche->pluck("reporter")->first()) !!}</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                            <h3>• Président : </h3>
                    </td>
                
              
                    <td class="center">
                            <h3>{!!  \App\Http\Controllers\GetStat::get_teacher_fullname($fiche->pluck("president")->first()) !!}</h3>
                    </td>
                </tr>
            </table>









         
    
        </body>
        </html>
    
    