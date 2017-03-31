@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endpush
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Your Awesome Idea</div>
                    <form action="{{ route('update.idea') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$idea->name}}" name="name"/>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="description">{{$idea->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$idea->owner}}" name="owner"/>
                            </div>
                            <div class="form-group">
                                {{--<select name="status">
                                    <option value="{{$idea->status}}">1</option>
                                    <option value="{{$idea->status}}">0</option>
                                </select>--}}
                            </div></div>
                        <div class="panel-footer">
                            <input type="hidden" name="id" value="{{$idea->id}}">
                            <button type="submit" class="btn btn-success">Save!</button>
                        </div>
                    </form>

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
