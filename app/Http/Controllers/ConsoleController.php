<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConsoleController extends Controller
{
    public function registerAjax(Request $request)
    {
        $data=$request->all();
        Log::channel('actionuser')->info("{user:'".(Auth::check() ? Auth::user()->user : 'anonymous')."',view:'".$data['view']."',action:'".$data['action']."'}");
        return response()->json(['success'=>true]);
    }
}
