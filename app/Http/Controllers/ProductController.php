<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Services\ShortUrlService;
use App\Http\Services\AuthService;

class ProductController extends Controller
{

    // 依賴注入
    public $shortUrlService = '';
    public $authService = '';

    public function __construct(ShortUrlService $shortUrlService , AuthService $authService)
    {
        $this->shortUrlService = $shortUrlService;
        $this->authService = $authService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = DB::table('products')->get();

        // $data = json_encode(Redis::get('products'));
        
        // $data = DB::table('sbl_team_data')
        // ->join('sbl_teams', function($join){
        //     $join->on('sbl_teams.id','=','sbl_team_data.team_id')
        //         ->where('sbl_teams.total_win', '>', '200');
        // })
        // ->select('*')
        // ->get();
        // $data = $data->addSelect('season')->get();
        return response($data);
    }
    //檢查商品數量
    public function checkProduct(Request $request){

        $id = $request->all();
        $product = Product::find($id)->first();

        if($product->quantity > 0){
            return response(true);
        }else{
            return response(false);
        }
        
    }

    //分享縮網址
    public function sharedUrl($id){

        $this->authService->fakeReturn();
        $url  = $this->shortUrlService->makeShortUrl("http://localhost:3000/products/$id");
        
        return response(['url'=> $url]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd(11111);
        $data = $this->getData();
        $newData = $request->all();
        // array的用法
        // array_push($data, $newData);
        // collect的用法
        $data->push(collect($newData));
        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
