<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request){

        $user=User::when($request->term,function($query) use ($request)  {
            $query->where('name','like','%'.$request->term.'%');
            $query->orWhere('name','like','%'.$request->term.'%');

        })->paginate(config('service.pagination'))->withQueryString();

        return Inertia::render('User/index',['user'=>$user]);
    }

    public function changeStatus(Request $request)
    {
//        $id = '';
//        $status = '';
//
//
//        foreach ($request->status as $key => $value) {
//
//            if (!is_null($value)) {
//                $id = $key;
//                $status = $value;
//
//            }
//
//        }
//
//
//        $country = State::findOrFail($id);
//        $country->is_active = $status;
//        $country->save();
//        return to_route('state.index')->with('message', 'State status updated');

    }

    public function itemDeleted(Request $request){

        $user=User::findOrFail($request->id);

        $user->delete();

        return to_route('state.index')->with('message','States Successfully Deleted');
    }

}
