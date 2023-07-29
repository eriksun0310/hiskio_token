
@extends('layouts.app')

@section('contect')
    
<link rel="stylesheet" href="/css/try.css">


    <div class="col-12">
        <h1 class="d-flex justify-content-center">
            <i class="fa-solid fa-bone"></i>商品列表<i class="fa-solid fa-bone"></i>
        </h1>
    </div>
    <div class="d-flex justify-content-center">
        <img src="https://a.34cimg.com/PetUpload/2012-09/f87a131defe0617620325c2752965bfa.jpg" alt="" width="20%">
    </div>



<table class="table table-hover mt-2">
    <thead class="table-light">
        <tr>
            <td class="title"><i class="fa-solid fa-shrimp">標題</i></td>
            <td class="title"><i class="fa-regular fa-comment"></i>內容</i></td>
            <td class="title"><i class="fa-solid fa-sack-dollar">價格</i></td>
            <td class="title"><i class="fa-solid fa-wrench">功能</i></td>
        </tr>

    </thead>
    <tbody class="table-group-divider"> 
        @foreach ($products as $product)
        <tr>
            @if ( $product->id == 1)
                <td class="special-text">{{$product->title}}</td>
            @else
                <td class="text">{{$product->title}}</td>
            @endif
            
            <td class="text">{{$product->content}}</td>
            <td class="text"></i>{{$product->price}}</td>
            <td class="action">
                <input class="check_product btn btn-success" value="確認商品數量" data-id="{{$product->id}}"  type="button">
                <input class="check_shared_url btn btn-secondary" value="分享網址" data-id="{{$product->id}}"  type="button">
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

