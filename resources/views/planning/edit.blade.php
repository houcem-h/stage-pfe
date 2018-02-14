@extends('dashboards.admin.appdash')
@section('dash_content')
<div class="container">
    <div class="row">
        <table border="2" class="table-bordered stable-stripped">
                @forelse($defenses as $def)
                 <tr>
                    <td>{{App\Internship::find($def->internship)->registration->studentRecord->firstname}} {{App\Internship::find($def->internship)->registration->studentRecord->lastname}}</td>
                    <td></td>
                 </tr>    
                @empty

                @endforelse
        </table>
    </div>
</div>
@endsection