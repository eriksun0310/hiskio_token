<?php
namespace App\Http\Services; 

class TryService extends ShortUrlService
{

    public $shortUrlService;
    public function __construct(ShortUrlInterfaceService $service)
    {
        $this->shortUrlService = $service;
    }

    public function callTry(){
        $service = app()->make('ShortUrlService');
        dd($service->version);
    }


    //預設不存在的函式,會做的事
    public $name = 'aaa';
    public function __set($name, $value){
        if(isset($this->name)){
            return $this->name = $value;
        } else {
            return null;
        }
    }
    public function __get($name){
        return $name;
    }

    public static function __callStatic($method, $args)
    {
        dump('iiiiii');
        dump($method);
        dump($args);
    }
}