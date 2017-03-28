@extends('layouts.app')

@push('css')
<style>
    .panel-body p {
        font-size: 1.2em;
    }
</style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="text-center">Fun Facts</h3></div>
                    <div class="panel-body">
                        <img style="width: 100%" src="{{$funfact[$idx]['url_image']}}" alt="">
                        <p style="text-align: center; padding: 5px" >{{$funfact[$idx]['fact']}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection