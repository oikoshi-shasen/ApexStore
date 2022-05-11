
<link rel="stylesheet" href="/css/user_detail.css">

@extends('layouts.app_2')

@section('content')
   <?php $rank_array = ['predator','master','diamond','pratinam','gold','silver','bronze']?>
    <div class="detail_content">
        <div class="user_card">
            <div class="detail_name">
                <h2>{{$user->name}}</h2>
            </div>
             <img src="{{asset('/img/Rank_badge/'.$user->rank.'.png')}}" alt="アイコン">
            <div class="detail_email">
                <h4>email:　{{$user->email}}</h4>
            </div>
            <div class="detail_rank">
                <h4>
                    rank:　{{$rank_array[$user->rank - 1]}}
                </h4>
            </div>
        </div>
    </div>
@endsection


