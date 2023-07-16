@extends('layouts.app')

@section('contect')
<h3>聯絡我們</h3>
<form action="">
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