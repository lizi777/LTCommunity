<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Topic;

class SearchController extends Controller
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
     * Show the search dashboard.
     *
     * @return 
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $users = User::search($query, null, true)->where('area_id',Auth::user()->area_id)->get();

        $topics = Topic::search($query, null, true)->where('area_id',Auth::user()->area_id)->get();
        
        $filterd_noresult = isset($topics);

        return view('search.search_page',compact('query','users','topics','filterd_noresult'));
    }
}
