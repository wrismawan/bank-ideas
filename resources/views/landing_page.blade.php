@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12 text-center">

                                <p style="font-size: 1.3em">Hi, <i class="em em-raised_hands"></i>
                                    <br>Temukan inspirasi dari <span style="text-decoration: underline">ratusan ide</span> startup di sini. Sudah siap?</p>

                                <a href="{{ route('idea.start') }}" class="btn btn-block btn-success text-center">Go!</a>
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
        mixpanel.track("Login Page");

        $(".btn-facebook").click(function() {
            mixpanel.track("Click FB Button");
        })
    });

</script>
@endpush
