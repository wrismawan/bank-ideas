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

</style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h3>Coming Soon!</h3>
                        <p>Kami akan hubungimu jika fitur submit ide sudah tersedia <i class="em em-blush"></i></p>
                        <a href="{{ route('idea.more') }}" class="btn btn-danger btn-lg col-xs-12 btn-action">LIHAT IDE-IDE LAIN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
<script>
    $(function() {
        mixpanel.track("Coming Soon Page");
    });

</script>
@endpush