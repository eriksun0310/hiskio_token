<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //註冊帳密
    public function signup(CreateUser $request){
        
        $validatedData = $request->validated();
        // 建構一個model
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        $user->save();
        return response('註冊成功', 201);
    } 

    //登入帳密
    public function login(Request $request){

        //先去檢查帳密的規則
        $validatedData = $request->validate([
            'email' => 'required | email | string ',
            'password' => 'required | string '
        ]);  
        //如果沒在規則裡 attempt():登入的動作
        if(!Auth::attempt($validatedData)){
            return response('登入失敗', 401);
        }
        $user = $request->user();
        //建立通行證
        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();
        return response(['token'=>$tokenResult->accessToken]);
    }

    //登出
    public  function logout(Request $request){
        //讓token失效
        $request->user()->token()->revoke();
        return response(
            ['message' =>'登出成功']
        );
    }


    //登入自己的帳號
    public function user(Request $request){
        return response(
            $request->user()
        );
    }
}
