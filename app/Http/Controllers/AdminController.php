<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::all();

        $trash = DB::table('users')
            ->whereNotNull('deleted_at')
            ->get();

        return view('admin', ['users' => $user, 'trashs' => $trash]);
    }

    public function delete(User $user)
    {
        User::find($user->id)->delete();
        return redirect('/admin');
    }

    public function restore($trash)
    {
        User::withTrashed()->whereId($trash)->restore();
        return redirect('/admin');
    }
}
