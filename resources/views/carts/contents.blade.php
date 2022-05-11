<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ApexStore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/cart_contents.css">
    </head>

    <body>
        @include('common.navbar_2')
          <main>
            @if($count_goods>0)
                <div class="container">
                    <div class="flex card-area">
                        @foreach(Auth::user()->inCarts as $good)
                            <div class="card_item">
                                <a href="/good/detail/{{$good->id}}">{{$good->name}}</a>
                                <br>
                                <img class="img" src="{{asset($good->picture)}}" alt="">
                                <div class="discount">値段：<span>${{$good->price * Auth::user()->rank_num}}</span></div>
                                <div class="discount">数量：<span>{{$good->pivot->quantity}}</span></div>
                                <div class="discount">小計：<span>${{$good->pivot->quantity * $good->price * Auth::user()->rank_num}}</span></div>
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
                    <!--<hr>-->
                    <!--<div class="flex card-area">-->
                    <!--    @foreach($goods as $good)-->
                    <!--        <div class="card_item">-->
                    <!--            <a href="/good/detail/{{$good->good_id}}">{{$good->name}}<a>-->
                    <!--            <br>-->
                    <!--            <img src="{{asset($good->picture)}}" alt="">-->
                    <!--            <div class="discount">値段：<span>{{$good->price}}</span></div>-->
                    <!--            <div class="discount">数量：<span>{{$good->quantity}}</span></div>-->
                    <!--            <form action="{{ route('delete.cartsgood') }}">-->
                    <!--                <input class="submit"type="submit" value="商品を取り消す">-->
                    <!--                <input type="hidden" name="good_id" value={{$good->good_id}}>-->
                    <!--            </form>-->
                    <!--        </div>-->
                    <!--    @endforeach-->
                    <!--</div>-->
                    <div class="toSettle">
                        <form action="/settle" method="get">
                            <input type="submit" class="settle_btn" value="決済へ進む">
                        </form>
                    </div>
                </div>
            @else
                <div class="non-goods">
                    <h1>商品がありません</h1>
                    <div class="to-goods-index">
                        <form action="/goods" method="get">
                            <input type="submit" class="settle_btn" value="商品一覧に戻る">
                        </form>
                    </div>
                </div>
            @endif
        </main>
    </body>
</html>



<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>