@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adding Post - {{ Auth::user()->name }} </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- if error occur -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('home') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Title</label> 
                            <div class="col-md-6">
                                <input id="title" name="title" type="text" placeholder="title" class="form-control input-md" required autufocus>    
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="content" class="col-md-4 control-label">Content</label>
                          <div class="col-md-6">                     
                            <textarea class="form-control"  rows="5" id="content" name="content"></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                @captcha()
                                <button type="submit" class="btn btn-primary">
                                    Post
                                </button>
                                <button type="reset" class="btn btn-danger">
                                    Reset
                                </button>

                            </div>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection