<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDirtyWord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dirtyWords = [
            'apple',
            'orange'
        ];
        $parameters = $request->all();
        foreach ( $parameters as $key =>$value ){
            if($key === 'content'){
                foreach($dirtyWords as $dirtyWord){
                    if(strpos($value, $dirtyWord) !== false){
                        return response('dirty!', 400);
                    }
                }
            }

        }
        return $next($request);
    }
}
