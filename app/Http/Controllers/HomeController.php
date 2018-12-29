<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', ['money' => $user->money, 'refLink' => $user->referral_id,]);
    }

    /**
     * Recharge the balance.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function recharge(Request $request)
    {
        if ($request->post('money') <= 0){
            return $this->index();
        }

        Auth::user()->money += $request->post('money');
        Auth::user()->save();

        $parent = User::find(Auth::user()->referral_parent);
        if ($parent){
            $parent->money += $request->post('money') * 0.1;
            $parent->save();
        }
        return $this->index();
    }
}
