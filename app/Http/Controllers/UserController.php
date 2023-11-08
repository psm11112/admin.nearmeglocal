<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request){


        $user=User::when($request->tearm,function($query) use ($request)  {
            $query->where('name','like','%'.$request->tearm.'%');

        })->paginate(config('service.pagination'))->withQueryString();

        return Inertia::render('User/index',['user'=>$user]);
    }

    public function edit($id)
    {

        $user = User::FindOrFail($id);

        return Inertia::render('User/edit', [
            'user' => $user,
        ]);

    }

    public function update(UserRequest $request){

        $stats=User::FindOrFail($request->id);
        $stats->name=$request->name;
        $stats->email=$request->email;
        $stats->role_id=$request->role;
        $stats->save();

        return to_route('user.edit',['id'=>$request->id])->with('message','User successfully Updated');



    }

    public function changeStatus(Request $request)
    {
       // dd($request->all());


        $user = User::findOrFail($request->id);
        $user->is_active = $request->status[0]['value'];
        $user->save();
        return to_route('user.index')->with('message', 'User status updated');

    }

    public function itemDeleted(Request $request){

        $user=User::findOrFail($request->id);

        $user->delete();

        return to_route('state.index')->with('message','States Successfully Deleted');
    }

}
