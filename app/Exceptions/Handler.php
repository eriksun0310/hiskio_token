<?php

namespace App\Exceptions;

use App\Models\LogError;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     * 設定當發生錯誤時,會去執行的函式
     */
    public function register(): void
    {
        //
        $this->reportable(function (Throwable $e) {
            dd($e);
            $user = auth()->user() ;//取得目前的user
            LogError::create([
                'user_Id' => $user ? $user->id : 0,
                'message' => $e->getMessage(),
                'exception'=>get_class($e),
                'line'=> $e->getLine(),
                'trace'=> array_map(function($trace){
                    unset($trace['args']); //移除掉$trace['args']多餘的參數
                    return $trace;
                }, $e->getTrace()),
                'method' =>request()->getMethod(),
                'params' =>request()->all(),
                'uri' =>request()->getPathInfo(),
                'user_agent' =>request()->userAgent(),
                'header' =>request()->headers->all(),
            ]);
        });
        // $this->renderable(function(Throwable $e){
        //     return response()->view('error');
        // });
    }

    //如果token失效的話,返回的訊息 
    public function unauthenticated($request, AuthenticationException $exception){
        return response('授權失敗',401);
    }
}
