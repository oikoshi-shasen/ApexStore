<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ApexStore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/index.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    </head>

    <body>
        @include('common.navbar_2')
          <main>
                <div class="search-area">
                    <div class="search-form">
                        <form id="hana" action="/search" method="post" class="none">
                            @csrf
                            <input type="text" placeholder="検索ワード" class="search-text" name="search_word">
                            <input type="submit" class="search-btn" value="検索する">
                        </form>
                    </div>
                    <a id="mimi">
                        <i class="fas fa-search" style="color:white;"></i>
                    </a>
                </div>
            <div class="container">

                
                @if($goods->isEmpty())
                <div class="no-item">
                    <h1 class="back-index">検索条件に合う商品はありません。</h1>
                    <button class="back-index submit" onclick="location.href='/goods'">商品一覧に戻る</button>
                </div>
                @endif

          
                
                <div class="flex card-area">
                    @foreach($goods as $good)
                        <div class="card_item">
                            <form action="/good/detail" method="get">
                                <h3>{{$good->name}}</h3>
                                <img class="img" src="{{asset($good->picture)}}" alt="">
                                <div class="discount">値段:<span> ${{$good->price * Auth::user()->rank_num}}</span></div>
                                <input type="hidden" name="good_id" value={{$good->id}}>
                                <input type="submit" class="submit" value="詳細">
                            </form>
                        
                        </div>
                        

                    @endforeach
                </div>
            </div>
        </main>
    </body>
</html>



<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>