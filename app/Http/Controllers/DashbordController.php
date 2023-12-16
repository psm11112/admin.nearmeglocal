<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;


class DashbordController extends Controller
{
    public function loginDirect($token){


        $token= Crypt::decryptString($token);

        $df=[];

        $user=User::FindOrFail($token);

        $df=[
           'email'=>$user->email,
           'password'=>$user->password
        ];



        return Inertia::render('directLogin',['user'=>$df]);






    }
}
