<header>
    <style>
        .nav_img{
            width:40px;
            transform:translateY(10px);
        }
        .nav_img a svg{
            font-size:21px;
        }
        .header-height{
            height:60px;
            line-height:60px;
        }
        .rank_img{
            height:50px;
            width:50px;
            position:absolute;
            right:15px;
            top:5px;
        }
        </style>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/goods">ApexStore</a>


        <div class="collapse navbar-collapse header-height" id="nav-bar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item nav_img">
                    <a href="/user">
                        <!--<i class="fas fa-user" style="color:#fff;"></i>-->
                        <img class="rank_img" src="{{asset('/img/Rank_badge/'.Auth::user()->rank()->rank.'.png')}}">
                    </a>
                </li>
                <li class="nav-item nav_img">
                    <a href="/carts">
                        <i class="fas fa-shopping-cart" style="color:#fff;"></i>
                    </a>
                </li>

                 <li class="nav-item">{!! link_to_route('logout.get', 'Logout', [], ['class' => 'nav-link']) !!}</li>
            </ul>
        </div>
    </nav>
</header>

