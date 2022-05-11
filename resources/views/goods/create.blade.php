@extends('layouts.app_2')

@section('content')
    <div class="col-md-6 offset-sm-6">
        <div class="text-center">
            <h1>Goods Register</h1>
        </div>
    
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <form action="{{ route('goods.register') }}" method="post" enctype='multipart/form-data'>
                       @csrf
                      <label class="label" for="Name">Name</label>
                      <input type="text" name="name">
                      <label class="label" for="Price">Price</label>
                      <input type="text" name="price">
                      <label class="label" for="Picture">写真</label>
                      <input type="text" name="picture">
                      <textarea rows="4" placeholder="説明文を記入してください" name="explanation"></textarea>
                      <input type="submit">
                </form>
            </div>
        </div>
    </div>
@endsection