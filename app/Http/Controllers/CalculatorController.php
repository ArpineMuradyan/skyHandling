<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculatorController extends Controller
{
    public function changeInput(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        switch ($data["type"]) {
            // case 'name':
            // 	$newValue = $data["newValue"];
            // 	break;
            // case 'year':
            // 	$newValue = (int)$data["newValue"];
            // 	if($newValue < 0) $newValue = 0;
            // 	break;
            default:
                $newValue = round(floatval($data["newValue"]), 2);
                if ($newValue < 0) $newValue = 0;
        }

        $result = DB::table('params')
            ->update([
                $data["type"] => $newValue
            ]);

        if ($result) {
            return "ok";
        } else {
            return "err";
        }


    }

    public function login(Request $request)
    {

        if ($request->get('login') == 'VicSH' && $request->get('password') == 'HondaJet420') {
            session()->put('auth',true);
//            dd(session('auth'),$request->get('login') == 'VicSH' && $request->get('password') == 'HondaJet420');
            return redirect(route('home'));
        }
        return redirect(route('login'))->with(['error'=>'Неверный логин или пароль']);
    }
    public function loginForm(Request $request)
    {

        return view('login');
    }
}
