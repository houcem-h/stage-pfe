@extends('../layouts/dashboard')

@section("content")
<div class="content-wrapper">
    <div class="container">
        @if(count($framing) > 0)
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">
                        Vos notifications
                    </h4>
                </div>
            </div>
            <div class="col-md-12">
              @foreach ($framing as $frame)
                <div>
                    <h4>L'enseignant <b>{{ $frame->firstname }} {{ $frame->lastname }}</b>
                        vous choisit pour vous encadrer dans votre stage
                        <span><b>
                          @if($frame->type == "init")
                            d'initiation
                          @elseif($frame->type == "perf")
                            de perfectionement
                          @else
                            de PFE
                          @endif </b>
                        </span>
                    </h4>
                    <small>Date :   {{ Carbon\Carbon::parse($frame->created_at)->format("Y-m-d") }}</small>
                </div> <hr>
              @endforeach
            </div>
        @else
            <h2>Aucun notifications</h2>
        @endif
    </div>
</div>
@endsection
