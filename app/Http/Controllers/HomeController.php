<?php

namespace ceu\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;
use ceu\Http\Controllers\ArquivoController;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArquivoController::getFiles();
    }
    
    public function offline(){
        DB::table('users')
            ->where('id', Auth::id())
            ->update(['status' => 'off']);
    }
    public function online(){
        DB::table('users')
            ->where('id', Auth::id())
            ->update(['status' => 'on']);
    }

}
