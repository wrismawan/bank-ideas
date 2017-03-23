@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <form action="{{ route('idea.store') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Startup Name" name="name"/>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Your Elevator Pitch Here.." name="description"></textarea>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-responsive">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>like</th>
                                <th>skip</th>
                                <th>viewed</th>
                                <th>%</th>
                            </tr>
                            @foreach($ideas as $idea)
                            <tr>
                                <td>{{$idea->name}}</td>
                                <td>{{$idea->description}}</td>
                                <td>1000</td>
                                <td>100</td>
                                <td>45</td>
                                <td>90%</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
