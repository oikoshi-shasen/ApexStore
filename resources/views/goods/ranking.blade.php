@extends('layouts.app_2')
    <link rel="stylesheet" href="/css/ranking.css">
@section('content')
        <div class="ranking">
            <div class="top-card">
                <a href="good/detail/{{$rankings[0]['good']->id}}">
                    <div class="top-name">
                        <h1>{{$rankings[0]['good']->name}}</h1>
                    </div>
                    <div class="top-picture">
                        <img class="img" src="{{asset($rankings[0]['good']->picture)}}" alt="">
                    </div>
                </a>
                <div class="quantity">
                    <h3>{{$rankings[0]['sum_quantity']}}個</h3>
                </div>
            </div>
            <div class="bottom-card flex">
                <div class="well-card">
                    <a href="good/detail/{{$rankings[1]['good']->id}}">
                        <div class="well-name">
                            <h2>{{$rankings[1]['good']->name}}</h2>
                        </div>
                        <div class="well-picture">
                            <img  src="{{asset($rankings[1]['good']->picture)}}" alt="">
                        </div>
                    </a>
                    <div class="quantity">
                        <h3>{{$rankings[1]['sum_quantity']}}個</h3>
                    </div>  
                </div>
                <div class="well-card">
                    <a href="good/detail/{{$rankings[2]['good']->id}}">
                        <div class="well-name">
                            <h2>{{$rankings[2]['good']->name}}</h2>
                        </div>
                        <div class="well-picture">
                            <img  src="{{asset($rankings[2]['good']->picture)}}" alt="">
                        </div>
                    </a>
                    <div class="quantity">
                        <h3>{{$rankings[2]['sum_quantity']}}個</h3>
                    </div>  
                </div>
            </div>
        </div>
@endsection