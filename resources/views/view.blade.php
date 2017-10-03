@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- post conetent -->
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
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Delete</button>
                        </form>    
                    @endif
                </div>
            </div>
            <!-- comment content -->
            <div class="panel panel-default"> 
                <div class="panel-heading">
                    <h2><i class="fa fa-comment-o" aria-hidden="true"></i> Reply</h2>
                </div>
                <div class="panel-body">

                    <!-- show all comment -->
                    @foreach($allComment as $item)
                        <div class="form-group">
                          <label for="content" class="col-md-1 control-label">
                            @if($item->name==Auth::user()->name)
                            <i class="fa fa-user" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                            @endif
                          </label>
                          <label for="content" class="col-md-1 control-label">{{$item->name}}</label>
                          <label for="content" class="col-md-8 control-label">：{{$item->content}}</label>
                          @if($item->name==Auth::user()->name)
                            <form action="deleteC_{{$item->id}}_{{$this_post->id}}" method="POST" class="text-right">
                                {{ csrf_field() }}
                                {{method_field('DELETE')}}
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </div>
                            </form>    
                          @endif
                          
                          <hr>
                        </div>
                        <hr>
                    @endforeach

                    <!-- adding comment -->
                    <form action="view_{{$this_post->id}} " method="POST" >
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="content" class="col-md-1 control-label"><i class="fa fa-user" aria-hidden="true"></i></label>
                          <label for="content" class="col-md-1 control-label">{{Auth::user()->name}}</label>
                          <div class="col-md-8">                     
                            <textarea class="form-control"  rows="1" id="content" name="content"></textarea>
                          </div>
                          <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Reply</button>
                          </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection