@extends('layouts.app')

@push('css')
    <style>
        .panel-body p {
            font-size: 1.3em;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$idea->name}}</div>
                    <div class="panel-body">
                        <p>{{$idea->description}}</p>
                        <a href="#" class="btn btn-success btn-lg col-xs-12" id="btn-like" style="margin-bottom:10px">Like</a>
                        <a href="#" class="btn btn-default btn-lg col-xs-12">Next</a>
                    </div>

                    <form id="form-like" action="{{ route("idea.like") }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="text" name="id" value="{{$idea->id}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(function (e) {
        $("#btn-like").click(function (e) {
            $("#form-like").submit();
        })
    })
</script>
@endpush
