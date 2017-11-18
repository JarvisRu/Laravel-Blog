@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome <b>{{Auth::user()->name}}</b></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br>Adding your own post now!<hr>
                   <a href="home/add"><button class="btn btn-primary">Add Now</button></a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">All Post</div>
                <div class="panel-body">
                    <!-- show post -->
                    @foreach($allPost as $item)
                        <h2>
                            @if($item->name==Auth::user()->name)
                                <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                            @endif
                            {{$item->title}}
                        </h2>
                        <p class="text-right"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$item->created_at}}</p>
                        <p>{{$item->content}}</p>
                        <p class="text-right"><i class="fa fa-pencil" aria-hidden="true"></i> Post by <b>{{$item->user->name}}</b></p>
                        <!-- view post -->
                        <a href="home/view/{{$item->id}}"><button class="btn btn-default">Read More</button></a>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
