<link rel="stylesheet" href="css/history.css">


@extends('layouts.app_2')

@section('content')
   <div class="contents">
       <div class="dark">
      <h1 class="noentext">注文履歴</h1>
      </div>
      <?php $total = 0;?>
      @foreach($historys as $history)
      <div class="item-card">
          <div class="card-top">
              <div class="date">
                  {{$history->created_at}}
              </div>
              <div class="card-top-right">
                 <h4>{{$history->quantity}}個</h4>
                  <h4>${{$history->sub_total}}</h4>
              </div>
          </div>
          <div class="card-bottom">
              <div class="item-img">
                  <a href="/good/detail/{{$history->good_id}}">
                     <img src="{{asset($history->picture)}}" >
                  </a>
              </div>
              <div class="item-text">
                  <a href="/good/detail/{{$history->good_id}}">
                     <h3>{{$history->name}}</h3>
                     </a>
                  <h3>{{$history->explanation}}</h3>
              </div>
          </div>
      </div>
      <?php $total += $history->sub_total?>
      @endforeach
        <div class="total-card">
            <h2>過去累計金額</h2>
            <h3>${{$total}}</h3>
        </div>
   </div>
@endsection


