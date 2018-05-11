<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Handlers\ImageUploadHandler;
use Auth;
use App\Markdown\Markdown;

class TopicsController extends Controller
{
    protected $markdown ;
    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->markdown = $markdown;
    }

	// public function index()
	// {
	// 	$topics = Topic::with('user', 'klasse')->paginate(12);
	// 	return view('topics.index', compact('topics'));
	// }

    public function show(Request $request,Topic $topic)
    {

        // URL 矫正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        $html = $this->markdown->markdown($topic->body);

        return view('topics.show', compact('topic','html'));
    }

	public function create(Topic $topic)
	{
		return view('topics.create_and_edit', compact('topic'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{
		$topic->fill($request->all());
        $user = Auth::user();
		$topic->user_id = $user->id;
		$topic->class_id = $user->class_id;
        $topic->area_id = $user->area_id;
		$topic->excerpt = 1;
        $topic->save();

		return redirect()->to($topic->link())->with('message', 'Created successfully.');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);

		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '修改成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect(route('topics.index'))->with('success', '删除成功！');
	}


	public function index(Request $request, Topic $topic)
    {
       
            if( Auth::user() && !Auth::user()->hasRole('Founder')){
                $area = Auth::user()->area()->first()->id;
                $topics = $topic->withOrder($request->order)->where('area_id',$area)->with('user.belongsToClass')->paginate(8);
            }
            else { 
                $topics = $topic->withOrder($request->order)->with('user.belongsToClass')->paginate(8);
            }

        return view('topics.index', compact('topics'));

        //$topics = Topic::withOrder($request->order)->where('class_id', $klasse->id)->with('user', 'klasse')->paginate(12);
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}