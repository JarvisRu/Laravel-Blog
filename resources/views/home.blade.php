@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br>Adding your own post now!<hr>

                   <a href="{{ url('home/add') }}">Add Now</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">All Post</div>

                <div class="panel-body">

                    test
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
