@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-{{session('status')[0]}}" role="alert">
                        {{ session('status')[1] }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">News list</div>
                            <div class="col-md-3 text-center"><a href="{{route('news.create')}}" class="text-center    "><i
                                        class="fas fa-plus-circle"></i></a></div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if (count($newses))
                            @foreach($newses as $news)
                                <div class="row">
                                    <div class="col-md-10">
                                        <a href="{{route('news.show',['id'=>$news->id])}}">{{$news->name}}</a>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{route('news.edit',['id'=>$news->id])}}"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{route('news.destroy',['id'=>$news->id])}}" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            Nothing to show!
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
