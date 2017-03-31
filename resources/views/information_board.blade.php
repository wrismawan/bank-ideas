@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h2 class="panel-title">Registered Users</h2></div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td style="width: 30%">Today</td>
                                    <td>: {{$reg_today}} users</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Yesterday</td>
                                    <td>: {{$reg_yesterday}} users</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Total Registration</td>
                                    <td>: {{$reg_total}} users</td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h2 class="panel-title">Unique Visitor</h2></div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <td style="width: 30%">Today</td>
                                <td>: {{$unique_today}} visitors</td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Yesterday</td>
                                <td>: {{$unique_yesterday}} visitors</td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Total Unique</td>
                                <td>: {{$unique_total}} visitors</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h2 class="panel-title">Last 5 Registered User</h2></div>
                    <div class="panel-body">
                        <table style="table-layout: fixed" class="table">
                            <thead>
                            <tr>
                                <th style="width: 10%">Name</th>
                                <th style="width: 20%">Email</th>
                                <th style="width: 30%">Facebook URL</th>
                            </tr>
                            @foreach($last_reg_users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td >{{$user->email}}</td>
                                <td>{{$user->fb_url}}</td></tr>
                            @endforeach
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h2 class="panel-title">User Actions</h2></div>
                    <div class="panel-body">
                        <h4>Min 5 Vote:  Users</h4><hr/>
                        <table class="table">
                            <thead>
                            <h4>Top 10 User</h4>
{{--                            @foreach($voteusers as $voteuser )--}}
                                <th style="">Name</th>
                                <th style="">Facebook URL</th>
                                <th style="">Total</th>
                            </thead>
                            <tr>
                                <td>xx users</td>
                                <td>http://url.facebook.com</td>
                                <td>xx votes</td>
                            </tr>
                        </table><hr/>
                        <h4>Total Votes: </h4>
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
