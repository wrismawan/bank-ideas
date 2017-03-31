@extends('layouts.app')

@push('css')
<style>
    .panel-body p {
        font-size: 1.2em;
    }

    .try {
        text-decoration: underline !important;
        font-weight: bold;
        margin: 10px 30px;
    }


    .idea-count {
        text-decoration: underline !important;
        font-weight: bold;
    }

    .credit {
        font-size: 10px;
    }
</style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <img src="https://media1.giphy.com/media/l0MYxef0mpdcnQnvi/giphy.gif" width="100%" style="margin-bottom: 10px"/>
                        <p>Mantap! Kamu sudah melihat <span class="idea-count">{{$countAction}} ide</span>! <i class="em em---1"></i><br>
                            Terima kasih sudah melihat semuanya<i class="em em-blush"></i></p>

                        <p style="margin-bottom: 10px; text-de"></p>
                        <a href="{{ route('idea.try') }}" class="try">Mau submit ide juga doong.</a>

                        <div class="row" style="margin-top: 20px;">
                            <a class="credit" href="http://verivy.com">Copyright @ Verivy 2017</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
<script>
    $(function() {
        mixpanel.track("Finish Page");
    });

</script>
@endpush