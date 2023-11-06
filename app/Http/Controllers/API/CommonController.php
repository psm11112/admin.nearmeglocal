<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends ResponseController
{
    public function getUser($id){
        $user=User::FindOrFail($id);

        return response()->json($user, 200);

    }
}
