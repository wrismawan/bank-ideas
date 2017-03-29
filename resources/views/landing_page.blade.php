@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12 text-center">

                                <p style="font-size: 1.2em">Hi, <i class="em em-raised_hands"></i>
                                    <br>Jadilah bagian dari perubahan dengan ikut <span style="text-decoration: underline; font-weight: bold;">memilih ide-ide startup</span> yang akan diwujudkan</p>

                                <a href="{{ route('idea.start') }}" class="btn btn-block btn-success btn-go text-center">Go!</a>
                            </div>
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
        mixpanel.track("Landing Page");

        $(".btn-facebook").click(function() {
            mixpanel.track("Click FB Button");
        })

        $(".btn-go").click(function() {
            mixpanel.track("Click Go!");
        })
    });

</script>
@endpush
