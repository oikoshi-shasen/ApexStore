<header>
    
    <style>
        .nav_img{
            width:40px;
            transform:translateY(10px);
            margin-left:15px;
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
            right:2.3px;
            top:5px;
        }
        
        .none{
            display:none;
        }
        .search-form{
            margin-top:10px;
        }
        .search-text{
            height:33.33px;
        }
        .search-btn {
          display       : inline-block;
          border-radius : 5%;          /* 角丸       */
          font-size     : 16pt;        /* 文字サイズ */
          text-align    : center;      /* 文字位置   */
          cursor        : pointer;     /* カーソル   */
          padding       : 4px 31px;   /* 余白       */
          background    : rgba(0, 11, 102, 0.6);     /* 背景色     */
          color         : #ffffff;     /* 文字色     */
          line-height   : 1em;         /* 1行の高さ  */
          transition    : .6s;         /* なめらか変化 */
          box-shadow    : 5px 5px 5px #666666;  /* 影の設定 */
          border        : 2px solid rgba(0, 0, 102, 0.7);    /* 枠の指定 */
          margin-bottom: 30px;
        }
        .search-btn:hover {
          box-shadow    : none;        /* カーソル時の影消去 */
          color         : rgba(0, 0, 102, 0.95);     /* 背景色     */
          background    : #ffffff;     /* 文字色     */
        }
        
        </style>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js">
        </script>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/goods">ApexStore</a>
        

        <div class="collapse navbar-collapse header-height" id="nav-bar">

            <ul class="navbar-nav ml-auto">


                @if(Auth::user()->role<=5)
                <li class="nav-item nav_img">
                    <a href="/goods/register">
                       <i class="fas fa-gift" style="color:#fff;"></i>
                    </a>
                </li>
                @endif

                <li class="nav-item nav_img">
                    <a href="/user">
                        <!--<i class="fas fa-user" style="color:#fff;"></i>-->
                        <img class="rank_img" src="{{asset('/img/Rank_badge/'.App\User::detailUser()->rank.'.png')}}">
                    </a>
                </li>
                <li class="nav-item nav_img">
                    <a href="/history">
                       <i class="fas fa-history" style="color:white;"></i>
                    </a>
                </li>
                <li class="nav-item nav_img">
                    <a href="/carts">
                        <i class="fas fa-shopping-cart" style="color:#fff;"></i>
                    </a>
                </li>
                <li class="nav-item nav_img">
                    <a href="/ranking">
                        <i class="fas fa-crown" style="color:#fff;"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

