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
                        <div class="panel-heading"><h4>Share Your Awesome Idea</h4></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <p style="text-align: left">Check This Error!</p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="text-align: left">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('user.ideastore') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Product/Startup Name" name="name"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control"  value="{{Auth::user()->email}}" placeholder="Your Email as an Owner" name="owner"/>
                                </div>
                                <div class="form-group">
                                    <textarea rows="8" class="form-control" placeholder="Your Elevator Pitch Here.." name="description"></textarea>
                                </div>
                                <div class="panel-footer">

                                    <button style="width: 100%" type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
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