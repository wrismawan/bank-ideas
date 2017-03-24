@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-12 ">
                            <a href="{{ route('social.redirect') }}" class="btn btn-block btn-social btn-lg btn-facebook">
                                <span class="fa fa-facebook"></span> Sign in with Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
