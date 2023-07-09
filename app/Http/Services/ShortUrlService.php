<?php 
namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ShortUrlService{
    
    protected $client;

    public function __construct()   
    {   
        $this->client = new Client();
    }
    //串接皮克看見api 製作縮網址
    public function makeShortUrl($url){

        try {
            $accesstoken =  env('URL_ACCESS_TOKEN');
            $data = [
                'url' => $url
            ];
            Log::info('postData', ['data' => $data]);
            $response = $this->client->request(
                'POST',
                "https://api.pics.ee/v1/links/?access_token=$accesstoken",
                [
                    'headers'=>['Content-Type'=>'application/json'],
                    'body'=>json_encode($data)
                ]
            );
            $contents = $response->getBody()->getContents();
            //url_shorten.log記在
            Log::channel('url_shorten')->info('responseData', ['data' => $contents]);
            $contents = json_decode($contents);
        } catch (\Throwable $th) {
            report($th);
        }
        return $contents->data->picseeUrl;
    }
}