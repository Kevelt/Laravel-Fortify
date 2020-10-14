<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

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

    public function list()
    {
        if(Auth::user()->rol == 1) {
            $listClient = ['client1', 'cliente2'];
        }
        else {
            $listClient = ['client1'];
        }
        return view('client/list', ['listClient'=>$listClient]);
    }
}
