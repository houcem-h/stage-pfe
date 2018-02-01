<html><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<style>
               

            * {
                font-family: 'Open Sans', sans-serif;
                margin:5;padding:0
            }

            .page-break {
                page-break-after: always;
            }

        </style>
        </head>
        <body>




@foreach($alldata as $user)



                <center><img width="100%" src="https://i.imgur.com/GtcVgJJ.png"></center>
                <p style="text-align: right;margin-top: 3px;"><span style="font-size: small; text-align: right;">&nbsp;Bizerte le :{{$datesign}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></p>
<div style="text-align: right;">&nbsp;</div>
<div style="text-align: right;">
<div style="text-align: center;"><strong><span style="font-size: x-large;">LETTRE D'AFFECTATION</span></strong></div>
<div style="text-align: center;"><strong><span style="font-size: x-large;"><br></span></strong></div>
<div style="text-align: center;">
<div><em><strong><span style="font-size: large;">{{ $user->title }}</span></strong></em></div>
<div>&nbsp;</div>

<div>
<p style="text-align: left;"><span style="font-size: medium;">Madame, Monsieur&nbsp;</span></p>

<p style="text-align: justify;"><span style="font-size: medium;">&nbsp; &nbsp; &nbsp;Nous vous remercions amplement pour la suite favorable que vous avez accordée à notre demande de stage de Projet de Fin d'Etudes (PFE) concernant l'étudiant(e) Mr/Mlle {{$user->firstname}} {{$user->lastname}} titulaire de la C.I.N N° {{$user->cin}} inscrit(e) au département Technologies de l'Informatique sous l'option 
    
    @if ( $user->stream == "DSI" )
        Développement des Systèmes d'Informations
    @elseif ( $user->stream == "REM" )
        Réseaux et Services Informatiques
    @elseif ( $user->stream == "SEM" )
        Systèmes Embarqués
    @endif
    et qui va travailler sur le sujet suivant:</span></p>

<p style="text-align: justify;"><span style="font-size: medium;"><br></span></p>
<p align="center"><span style="font-size: medium;"><strong>«{{$user->title}}»</strong></span></p>

<p align="center"><span style="font-size: medium;"><strong><br></strong></span></p>
<p style="text-align: justify;"><span style="font-size: medium;">&nbsp; &nbsp; Ce stage se déroulera du {{$user->start_date}} au {{$user->end_date}}. Il fait partie intégrante du cursus universitaire des étudiants de l'Institut Supérieur des Etudes Technologiques de Bizerte.</span></p>
<p style="text-align: justify;"><span style="font-size: medium;">&nbsp; &nbsp; A la fin du stage, l'étudiant(e) doit remettre à l'ISET un dossier qui comprend une attestation de stage et un rapport, signés et validés par l'encadrant à l'entreprise. L'étudiant(e) est tenu(e) à se conformer aux directives et à la discipline la plus stricte au sein de l'organisme d'acceuil.</span></p>
<p style="text-align: justify;"><span style="font-size: medium;">&nbsp; &nbsp; &nbsp;Nous vous signalons, par ailleurs, que durant la période de stage, l'étudiant est couvert par la Mutuelle Accident Scolaire et universitaire- MASU- sous le numéro 11050215-006.</span></p>
<p style="text-align: justify;"><span style="font-size: medium;">&nbsp; &nbsp; &nbsp;Nous vous remercions pour votre collaboration et nous nous mettons à votre disposition pour toute information complémentaire.</span></p>
<br>
<p style="text-align: right;"><span style="font-size: medium;">Unité PFE</span></p>
<br><br><br><br><br>
<div>&nbsp;</div>

<hr>
<p style="margin: 0; padding: 0;"><span style="font-size: small;">ISET de Bizerte BP. N°65 Campus universitaire, Menzel Abderrahmen</span></p>
<p align="center" style="
    margin-top: 0px;
    padding: 0;
">
<span style="font-size: small;"><strong>Tel:</strong> 72 570 601<strong> Fax: </strong>72 572 455 <strong>Email:</strong> pfe.ti.iset.bizerte@gmail.com</span></p>
</div>
    </div></div>





@endforeach







</body></html>