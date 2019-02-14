{{$news}}
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
                            <div class="col-md-10">
                                {{ __($news->name) }}
                            </div>
                            <div class="col-md-2">
                                <a href="{{route('news.edit',['id'=>$news->id])}}" class="text-center    "><i
                                        class="fas fa-edit"></i></a>
                            </div>
                        </div></div>

                    <div class="card-body">
                        <article>{{$news->description}}</article>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                Created: {{$news->created_at->format('Y-m-d')}}
                            </div>
                            <div class="col-md-6">
                                Author: {{$news->author}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
