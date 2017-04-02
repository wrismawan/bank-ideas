@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>
                    <span class="label label-danger">Unique: {{$unique_session}}</span>
                    <span class="label label-info">Voted Min. 1x: {{$voters_1x}}</span>

                </h3>
                <h3>
                    <span class="label label-success">Voted Min. 5x: {{$voters_5x}}</span>
                    <span class="label label-warning">Signed In: {{$signed_in}}</span>
                </h3><br>
                <div class="panel panel-default">
                    <div class="panel-heading">Your Awesome Idea</div>
                    <form action="{{ route('admin.ideastore') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Startup Name" name="name"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Email as an Owner" name="owner"/>
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
                        <a class="navbar-brand" href="#">Import Ideas From Excel/CSV </a>
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
                        <table class="table table-responsive" id="ideas-table">
                            <thead>
                                <th style="width: 10%">Name</th>
                                <th style="width: 35%">Description</th>
                                <th style="width: 5%"><i class="em em-boy"></i></th>
                                <th style="width: 5%"><i class="em em-white_check_mark"></i></th>
                                <th style="width: 5%"><i class="em em-broken_heart"></i></th>
                                <th style="width: 5%"><i class="em em-eyes"></i></th>
                                <th style="width: 5%"><i class="em em-heart"></i></th>
                                <th style="width: 5%"><i class="em em-ballot_box_with_check"></i></th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($ideas as $idea)
                            <tr>
                                <td>{{$idea->name}}</td>
                                <td>{{$idea->description}}</td>
                                <td>{{$idea->owner}}</td>
                                <td>{{$idea->like}}</td>
                                <td>{{$idea->skip}}</td>
                                <td>{{$idea->viewed}}</td>
                                <td><?php
                                    if ($idea->skip == 0) {
                                        echo "100%";
                                    } else {
                                        $likeable = $idea->like == 0 ? 0 : number_format(floatval($idea->like) * 100 / floatval($idea->skip), 2);
                                        echo "{$likeable}%";
                                    }
                                ?>
                                </td>
                                <td>{{$idea->status}}</td>
                                <td>
                                    <a href="{{route('admin.updateidea',[$idea->id])}}">Edit</a>
                                    <a href="{{route('admin.deleteidea',[$idea->id])}}" onclick="return confirm('Beneran Mau di Delete?');">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(function() {
        $("#ideas-table").DataTable();
    });
</script>
@endpush
