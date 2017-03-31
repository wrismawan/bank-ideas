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

    .btn-action {
        margin-bottom: 10px;
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
                    <div class="panel-heading" style="border-bottom: none">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                        @if ($isFunFact)
                        <span class="label label-success pull-left" style="font-size:10px"><i class="fa fa-quote-left"></i> Startup Fun Fact</span>
                        @endif
                        <span class="label label-danger pull-right" style="font-size:10px; margin-left:3px"><i class="fa fa-star"></i> {{ $countAction }}pts</span>
                    </div>
                    @if ($isFunFact == true)
                    <div class="panel-body text-center">
                        <img style="width: 100%" src="{{asset($funFact['url_image'])}}" alt="">
                        <p style="text-align: center; padding: 5px" >{{$funFact['fact']}}</p>
                        <a href="{{ route('idea.more') }}" class="btn btn-danger btn-lg col-xs-12 btn-action">LIHAT IDE-IDE LAIN</a>
                        <a href="{{ route('user.ideaedit') }}" class="try">Mau submit ide juga doong.</a>
                    </div>
                    @else
                    <div class="panel-body text-center">
                        <h3>Yay! <i class="em em-confetti_ball"></i><i class="em em-confetti_ball"></i></h3>
                        <p>Terima kasih sudah melihat <span class="idea-count">{{$countAction}} ide kami</span> :)</p>
                        <a href="{{ route('idea.more') }}" class="btn btn-danger btn-lg col-xs-12 btn-action">LIHAT IDE-IDE LAIN</a>
                        <a href="{{ route('user.ideaedit') }}" class="try">Mau submit ide juga doong.</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(function() {
        mixpanel.track("Want More Page");

        $(".btn-action").click(function() {
            mixpanel.track("Click More Idea");
        })

        $(".try").click(function() {
            mixpanel.track("Want to submit idea");
        })
    });

</script>
@endpush
