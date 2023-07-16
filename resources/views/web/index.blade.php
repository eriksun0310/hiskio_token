
@extends('layouts.app')

@section('contect')
    
<link rel="stylesheet" href="/css/try.css">
<h2>商品列表</h2>
<img src="https://a.34cimg.com/PetUpload/2012-09/f87a131defe0617620325c2752965bfa.jpg" alt="" width="20%">
<table>
    <thead>
        <tr>
            <td>標題</td>
            <td>內容</td>
            <td>價格</td>
            <td></td>
        </tr>

    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            @if ( $product->id == 1)
                <td class="special-text">{{$product->title}}</td>
            @else
                <td>{{$product->title}}</td>
            @endif
            
            <td>{{$product->content}}</td>
            <td>{{$product->price}}</td>
            <td>
                <input class="check_product" value="確認商品數量" data-id="{{$product->id}}"  type="button">
                <input class="check_shared_url" value="分享網址" data-id="{{$product->id}}"  type="button">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<script>
    $('.check_product').on('click',function(){
        $.ajax({
            type: 'POST',
            url:'/products/check_product',
            data:{ id: $(this).data('id') },
            success: function(response){
                        if(response){
                            alert('商品數量充足')
                        }else{ 
                            alert('商品數量不足')
                        }
            }
        });
        
    });

    $('.check_shared_url').on('click',function(){
        var $id = $(this).data('id')
        $.ajax({
            type: 'GET',
            url:`/products/${$id}/shared-url`,
            success: function(msg){
                alert('請分享此縮網址'+ msg.url)
            }
        });
        
    });
</script>

@endsection

