<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function register()
    {
        return view('client/register');
    }

    public function registerAjax(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'message' => 'required'
        ]);
        if($data['name'] == 'juan') {

            //  Store data in database
            registerAjax::create($request->all());

            return response()->json(['success'=>true, 'message'=>'Lo registro']);
        }
        else {
            return response()->json(['success'=>false, 'message'=>'No lo registro']);
        }
    }

    public function list()
    {
        //comprueba el tipo de usuario
        if($usuario.rol == 1) { //todos
            $listClient = ['client1', 'cliente2'];
        }
        else { //los que registro
            $listClient = ['client1'];
        }
        return view('client/list', ['listClient'=>$listClient]);
    }
}
