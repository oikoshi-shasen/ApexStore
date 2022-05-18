<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ApexStore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="stylesheet" href="css/cart_contents.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

        
    </head>

    <body>
        <div class="toumei">
        @include('common.navbar_2')
          <main>
            @if($count_goods>0)
                <div class="container">
                    <div class="flex card-area">
                        @foreach($goods as $good)
                            <div class="card_item">
                                <a href="/good/detail/{{$good->id}}">{{$good->name}}</a>
                                <br>
                                <img class="img" src="{{asset($good->picture)}}" alt="">
                                <div class="discount">値段：<span>${{$good->price * Auth::user()->rank_num}}</span></div>
                                <div class="discount">数量：<span>{{$good->pivot->quantity}}</span></div>
                                <div class="discount">小計：<span>${{$good->pivot->sub_total}}</span></div>
                                <form action="good/detail/{{$good->id}}">
                                    <input class="submit" type="submit" value="数量変更">
                                    <input type="hidden" name="good_id" value={{$good->id}}>
                                </form>
                                <form action="{{ route('delete.cartsgood') }}">
                                    <input class="submit" type="submit" value="商品取り消し">
                                    <input type="hidden" name="good_id" value={{$good->id}}>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="rank-up">
                        @if(Auth::user()->rank_num != 1)
                            @if($neo_balance > 0)
                                <h2>あと${{$neo_balance}}でランクアップ！</h2>
                            @else
                                <h3>{{ceil((abs($neo_balance)/App\User::$judgment_value)) }}ランクアップ確定！</h3>
                            @endif
                        @endif
                    </div>
                    <div class="toSettle">
                        <form action="/settle" method="get" onsubmit="return func1()">
                            <button id="toSettle" class="settle_btn" >  決済へ進む </button> 
                        </form>
                        <script>
                            function func1(){
                                let bar = {{ $neo_balance }};
                                if(bar > 0){
                                    if(window.confirm(`あと$ ${bar} でランクアップなのにほんとにいいんですか？`))
                                        {
                                            if(window.confirm(`もったいない気がしますけど、いいんですか？`)){
                                                window.alert('決済画面に進みます😊');
                                                return true;
                                            }
                                            else{
                                                window.alert(`あと$ ${bar}でランクアップです！`)
                                                return false; 
                                            }
                                        }
                                    else{
                                          window.alert('もっと買ってくれるのうれしい😊');
                                          return false; 
                                        }
                                    }
                                else{
                                    window.alert('ランクアップ確定やで😊');
                                    return true; 
                                }
                                }
                        </script>
                    </div>
                </div>
            @else
                <div class="non-goods">
                    <h1>商品がありません</h1>
                        @if(Auth::user()->rank_num != 1)
                 <h3>あと${{$neo_balance}}でランクアップ！</h3>
                        @endif
                    <div class="to-goods-index">
                        <form action="/goods" method="get">
                            <input type="submit" class="settle_btn" value="商品一覧に戻る">
                        </form>
                    </div>
                </div>
            @endif
        </main>
    </div>
    </body>
</html>



<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
<script src="{{asset('js/main.js')}}"></script>