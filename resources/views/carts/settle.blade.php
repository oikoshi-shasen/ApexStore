<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ApexStore</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="/css/settle.css">
    </head>










    <body>
        @include('common.navbar_2')
        @include('common.error_messages')
          <main>
            <div class="container">
                <div class="flex table-area">
                    <div class="table">
                        <table>
                            <tr>
                                <th><font size=+2>商品名</font></th>
                                <th><font size=+2>値段</font></th>
                                <th><font size=+2>数量</font></th>
                                <th><font size=+2>小計</font></th>
                            </tr>
                            <?php $total=0 ?>
                            @foreach($goods as $good)
                                <?php 
                                      $total += $good->pivot->sub_total;
                                ?>
                                <tr>
                                    <td>{{$good->name}}</td>
                                    <td>${{$good->price* Auth::user()->rank_num}}</td>
                                    <td>{{$good->pivot->quantity}}</td>
                                    <td>${{$good->pivot->sub_total}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td  colspan="1"><font size=+2>合計</font></td>
                                <td></td>
                                <td></td>
                                <td colspan="1"><font size=+2>${{ $total }}</font></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="flex">
                <div class="credit_card">
                    <form action="/settled" method='post' class="form_area">
                        @csrf
                        <label>カード番号：<input class="form_text" name="card_num" type="tel"></label>
                        <label>暗証番号：<input class="form_text" type="password" name="password" maxlength="4"></label>
                        <div class="submit_btn">
                        <input type="submit" class="submit" value="決済">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </main>
    </body>
</html>



<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>