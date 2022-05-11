<link rel="stylesheet" href="/css/detail.css">
@extends('layouts.app_2')
@section('content')
    <div class="detail_content">
        <div class="detail_left">
            <div class="detail_name">
                <h2>{{$good->name}}</h2>
            </div>
            <div style="width: 60%; margin:0 auto;">
                <img src="{{asset($good->picture)}}" alt="" style="width:100%">
            </div>
        </div>

        <div class="detail_right">
            <div class="detail_text">
                <h4>{{$good->explanation}}</h4>
            </div>
            <div class="detail_price">
                <h4>${{$good->price * Auth::user()->rank}}</h4>
            </div>
            <div class="detail_btn">
                @if($exist==false)
                <form method="post">
                            <form method="post" id='good_quantity'>
                                @csrf
                            <div class="dropdown">
                                <select class="dropdown-select" name="quantity">
                                        <option value=''>
                                            数量を選択
                                        </option>
                                    @for($i=1;$i<=64;$i++)
                                        <option value="{{$i}}">
                                            {{$i}}個
                                        </option>
                                    @endfor
                                </select>
                            </div>
                                <button class="submit" id="submit">カートに入れる</button>
                                <input type="hidden" name="good_id" value={{$good->id}}>
                            </form>
                            <script>
                                $('#submit').on('click', function(){
                                    const val = $('.dropdown-select').val();
                                    if(val==''){
                                        alert('数量を選択してください');    
                                        return false;
                                    }
                                    $('#good_quantity').submit();
                                })
                            </script>
                @else
                        <form action="/good/changequantity" method="post">
                            @csrf
                            <div class="dropdown">
                                <select class="dropdown-select" name="quantity">
                                    @for($i=1;$i<=64;$i++)
                                        @if($i==$good->quantity)
                                            <option value="{{$i}}" selected>
                                                {{$i}}個
                                            </option>
                                        @else
                                            <option value="{{$i}} ">
                                                {{$i}}個
                                            </option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                                <input type="submit" class="submit" value="カートに入れなおす">

                                <input type="hidden" name="good_id" value={{$good->good_id}}>
                            </form>
                
                @endif
            </div>
            @if (is_null($added_quantity)==false)
                <p>{{$added_quantity}}個追加しました。</p>
            @endif
        </div>
    </div>
@endsection



