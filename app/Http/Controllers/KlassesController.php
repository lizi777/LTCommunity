<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klasse;
use App\Models\Topic;
use Auth;

class KlassesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request,$klasse = null)
    {
    	if( $klasse == null){
	    	$klasse = Auth::user()->belongsToClass()->first();
	        // 读取分类 ID 关联的话题，并按每 8 条分页
	        $topics = Topic::withOrder($request->order)->where('class_id', $klasse?$klasse->id:0)->with('user', 'klasse')->paginate(8);
	        // 传参变量话题和分类到模板中
	        return view('topics.index', compact('topics', 'klasse'));
	    }
	    else{
	    	$topics = Topic::withOrder($request->order)->where('class_id', $klasse)->with('user', 'klasse')->paginate(8);
	    	return view('topics.index', compact('topics'));
	    }
    }

    public function update(Request $request,Klasse $klasse)
	{

		//$this->authorize('update', $class);
		$klasse->notice = $request->notice;
		$klasse->update();

		return redirect()->route('klasses.show')->with('success', '公告修改成功！');
	}

}
