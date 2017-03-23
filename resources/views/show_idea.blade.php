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
                    <div class="panel-heading">KondanginYuk</div>

                    <div class="panel-body">
                        <p>Platform online yang menyediakan informasi dan layanan kondangan bagi anak muda Indonesia secara utuh dari hulu ke hilir.</p>
                        <a href="#" class="btn btn-success btn-lg col-xs-12" style="margin-bottom:10px">Like</a>
                        <a href="#" class="btn btn-default btn-lg col-xs-12">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
