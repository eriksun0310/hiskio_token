@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="/css/try.css">
<h1 class="m-2">
    聯絡我們
    <i class="fa-solid fa-phone-volume"></i>
</h1>
<form action="" class="w-50 m-2">
    <div class="form-group">
        <label for="exampleInputePassword1">請問你是：</label>
        <input name="name" type="text" class="form-control" id="exampleInputePassword1">
    </div>

    <div class="form-group">
        <label for="exampleInputePassword1">請問你的消費時間：</label>
        <input name="date" type="text" class="form-control" id="exampleInputePassword1">
    </div>

    <div class="form-group">
        <label for="exampleInputePassword1">你消費的商品種類：</label>
        <select class="form-control" name="product" id="">
            <option value="物品">物品</option>
            <option value="食物">食物</option>
        </select><br>
    </div>
    <button class="btn btn-success">送出</button>
</form>

@endsection