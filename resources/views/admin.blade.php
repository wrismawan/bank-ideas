@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Your Awesome Idea</div>
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
                <nav class="navbar navbar-default">

                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Import & Export Ideas From Excel/CSV </a>
                    </div>
                </div>
            </nav>
                <form style="border-top: 1px solid #a1a1a1; margin-top: 15px;margin-bottom: 15px;padding: 10px;" action="{{ URL::to('import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <input type="file" name="import_file" />
                    <button style="margin-top: 5px" class="btn btn-primary">Import File</button>
                    {{ csrf_field() }}
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
                                <td>{{$idea->like}}</td>
                                <td>{{$idea->skip}}</td>
                                <td>{{$idea->viewed}}</td>
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
