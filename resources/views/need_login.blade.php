@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <img src="https://media3.giphy.com/media/3oz8xIsloV7zOmt81G/giphy.gif" width="100%" style="margin-bottom: 10px">
                                <p>
                                    Ingin memilih lebih banyak ide lainnya dan dapat update tentang ide mana yang akan dieksekusi?</p>
                                <div class="col-md-12">
                                    <a href="{{ route('social.redirect') }}" class="btn btn-social btn-facebook text-center">
                                        <span class="fa fa-facebook"></span> Masuk menggunakan Facebook
                                    </a>
                                <p style="font-size: 9px; margin-top:10px">Tenang, kami tidak akan mengirim spam dan menyalahgunakan email kamu <i class="em em-blush"></i></p>
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
