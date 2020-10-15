<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use DataTables;

class ClientController extends Controller
{
    public function register()
    {
        return view('client/register');
    }

    public function registerAjax(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'surname'=>'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9'
        ]);

        $data = $request->all();
        $data['user'] = Auth::user()->user;
        Client::create($data);
        return response()->json(['success'=>true, 'message'=>'Success']);
    }

    public function list(Request $request)
    {
        $listClient = (Auth::user()->rol == 1)
        ? Client::all()
        : Client::where('user', Auth::user()->user)->get();
        return view('client/list', ['listClient'=>$listClient]);
    }
}