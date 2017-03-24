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
                    <div class="panel-heading"><h3 class="text-center">{{$idea->name}}</h3></div>
                    <div class="panel-body">
                        <p>{{$idea->description}}</p>
                        <a href="#" class="btn btn-success btn-lg col-xs-12 btn-action" data-type="like" style="margin-bottom:10px">Like</a>
                        <a href="#" class="btn btn-default btn-lg col-xs-12 btn-action" data-type="skip">Skip</a>
                    </div>
                    <form id="form-action" action="#" method="POST" style="display: none">
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
        $(".btn-action").click(function (e) {
            type = $(this).data('type');
            url = type == 'like' ? '{{ route('idea.like') }}' : '{{ route('idea.skip') }}';
            $("#form-action").attr('action', url).submit();
        })
    })
</script>
@endpush
