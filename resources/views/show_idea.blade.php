@extends('layouts.app')

@push('css')
    <style>
        .panel-body p {
            font-size: 1.2em;
        }

        .info {
            margin-top: 10px;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @if (session('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>HOW:</strong> Pilih <strong>"Yep!"</strong> jika kamu suka, dan <strong>"Nope"</strong> jika kamu ingin langsung melihat ide lainnya.
                </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">

                        <span class="label label-danger pull-right" style="font-size:10px; margin-left:3px"><i class="fa fa-star"></i> {{ $countAction }}pts</span>
                        <span class="label label-success pull-right" style="font-size:10px"><i class="fa fa-refresh"></i> {{ $countAction % \App\UserAction::$LIMIT + 1}}/{{$totalStep}}</span>

                        <h3 class="text-center" style="margin-top">{{$idea->name}}</h3>

                    </div>
                    <div class="panel-body">
                        <p>{{$idea->description}}</p>
                        <a href="#" class="btn btn-success btn-lg col-xs-12 btn-action" data-type="like" style="margin-bottom:10px">Yep!</a>
                        <a href="#" class="btn btn-default btn-lg col-xs-12 btn-action" data-type="skip">Nope</a>
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
        mixpanel.identify("{{ Cookie::get('id') }}");

        @if (Auth::check())
        mixpanel.people.set({
            "$name" : "{{ Auth::user()->name }}",
            "$email": "{{ Auth::user()->email }}",
            "$created": "{{ Auth::user()->created_at }}",
            "$last_login": new Date(),
        });
        @endif

        $(".btn-action").click(function (e) {
            type = $(this).data('type');
            url = type == 'like' ? '{{ route('idea.like') }}' : '{{ route('idea.skip') }}';
            $("#form-action").attr('action', url).submit();

            if (type == 'like') {
                mixpanel.track("Like");
            } else {
                mixpanel.track("Nope");
            }
        })
    })
</script>
@endpush
