@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Your Elevator Pitch Here.."></textarea>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">


                    <div class="panel-body">
                        <table class="table table-responsive">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>%</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>AntriYuk</td>
                                <td>Mobileapps yang membantu pengantre untuk mengamankan posisi antriannya sehingga bebas melakukan kegiatan selama masa antrean</td>
                                <td>90%</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>AntriYuk</td>
                                <td>Mobileapps yang membantu pengantre untuk mengamankan posisi antriannya sehingga bebas melakukan kegiatan selama masa antrean</td>
                                <td>90%</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
