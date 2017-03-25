@extends('layouts.app')

@push('css')
<style>
    .panel-body p {
        font-size: 1.2em;
    }

    .try {
        text-decoration: underline !important;
        font-weight: bold;
        margin-top: 10px;
    }


    .idea-count {
        text-decoration: underline !important;
        font-weight: bold;
    }

</style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h3><i class="em em-white_check_mark"></i></h3>
                        <p>Kamu sudah melihat <span class="idea-count">{{$idea_count}} ide</span>! <i class="em em---1"></i><br>Terima kasih sudah melihat semuanya<i class="em em-blush"></i></p>
                        <a href="#" class="try">Mau submit ide juga doong.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection