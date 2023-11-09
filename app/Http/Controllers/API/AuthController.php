<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;



class AuthController extends ResponseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $randomNumber = rand(1000, 9999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'opt_number'=>$randomNumber
        ]);


       Mail::to('demo@gmail.com')->send(new SendOtpVerification($user));


        return $this->sendResponse($user,'User Successfully Register',200);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|string|email',
            'password' => ['required'],
        ]);
         $user=User::where('email',$request->email)->first();

         if(is_null($user)){
             return response()->json([
                 'message' => 'Your Account Not Found'
             ], 404);

         }


         if(is_null($user->email_verified_at)){
             return response()->json([
                 'message' => 'Your Account Not Verified'
             ], 401);

         }


        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        return $this->sendResponse($user,'Successfully Login',200);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return response()->json([
            'data' => $request->user(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function opt_verification(Request $request){
        $user=User::where('email',$request->email)->first();
        if(!is_null($user)){
            $userOpt=User::where('opt_number',$request->opt_number)->first();
            if(!is_null($userOpt)){
                $userOpt->email_verified_at=time();
                $userOpt->save();

                return $this->sendResponse($user,'Your Account Successfully Verified',200);
            }else{
                return $this->sendResponse([],'Invalid Opt Code',401);
            }

        }else{

            return $this->sendResponse('','Does Not Found This Account For This Email',404);

        }

    }
}
