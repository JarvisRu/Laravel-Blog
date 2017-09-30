@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                
                <div class="panel-heading">
                    
                    <h2> {{$this_post->title}}</h2>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{$this_post->name}} <br>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{$this_post->created_at}}
                </div>
                <div class="panel-body">
                    <p>{{$this_post->content}}</p>
                    <!-- delete post -->
                    @if($this_post->name==Auth::user()->name)
                        <form action="delete_{{$this_post->id}}" method="POST" class="text-right">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <input type="submit" class="btn btn-danger" value="DELETE">
                        </form>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection