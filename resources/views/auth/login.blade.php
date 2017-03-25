@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12 text-center">

                            <p style="font-size: 1.3em">Hi, <i class="em em-raised_hands"></i>
                                <br>Temukan inspirasi dari ratusan ide startup karya anak bangsa. Sudah siap?</p>

                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{ route('social.redirect') }}" class="btn btn-social btn-facebook text-center">
                                    <span class="fa fa-facebook"></span> Masuk menggunakan Facebook
                                </a>
                            </div>
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
