<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klasse;
use App\Models\Topic;

class KlassesController extends Controller
{
    
    public function show(Klasse $klasse,Request $request)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = Topic::withOrder($request->order)->where('class_id', $klasse->id)->with('user', 'klasse')->paginate(12);
        // 传参变量话题和分类到模板中
        return view('topics.index', compact('topics', 'klasse'));
    }
}
