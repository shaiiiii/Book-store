<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookIssuance;
use Auth;

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
        if(\Auth::user()->role==1){
            $books = Book::all();
            return view('Admin.home', compact('books'));
        }
        else{

        $user = Auth::user();


        $bookIssuances =BookIssuance::where('user_id',$user->id)->get() ;
            return view('Member.home',compact('bookIssuances'));
        }

    }
}
