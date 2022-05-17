<link rel="stylesheet" href="css/history.css">


@extends('layouts.app_2')

@section('content')
   <div class="contents">
       <div class="dark">
      <h1 style="color:white;">注文履歴</h1>
      </div>
      <?php $total = 0;?>
      @foreach($historys as $history)
      <div class="item-card">
          <div class="card-top">
              <div class="date">
                  {{$history->updated_at}}
              </div>
              <div class="card-top-right">
                 <h4>{{$history->pivot->quantity}}個</h4>
                  <h4>${{$history->pivot->sub_total}}</h4>
              </div>
          </div>
          <div class="card-bottom">
              <div class="item-img">
                  <a href="/good/detail/{{$history->id}}">
                     <img src="{{asset($history->picture)}}" >
                  </a>
              </div>
              <div class="item-text">
                  <a href="/good/detail/{{$history->id}}">
                     <h3>{{$history->name}}</h3>
                     </a>
                  <h3>{{$history->explanation}}</h3>
              </div>
          </div>
      </div>
      <?php $total += $history->pivot->sub_total?>
      @endforeach
        <div class="total-card">
            <h2>過去累計金額</h2>
            <h3>${{$total}}</h3>
        </div>
   </div>
@endsection


