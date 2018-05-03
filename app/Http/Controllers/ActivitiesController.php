<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Handlers\ImageUploadHandler;
use Auth;

class ActivitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Activity $activitity)
	{
		$activities = $activitity->paginate();
		return view('activities.index', compact('activities'));
		//return dd($activities);
	}

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

	public function create(Activity $activity)
	{
		return view('activities.create_and_edit', compact('activity'));
	}

	public function store(ActivityRequest $request,Activity $activity)
	{
		$activity->fill($request->all());
		$activity->area = Auth::user()->area_id;
		$activity->excerpt = make_excerpt($activity->content);
		$activity->save();
		return redirect()->route('activities.show', $activity->id)->with('message', 'Created successfully.');
	}

	public function edit(Activity $activity)
	{
        $this->authorize('update', $activity);
		return view('activities.create_and_edit', compact('activity'));
	}

	public function update(ActivityRequest $request, Activity $activity)
	{
		$this->authorize('update',$activity);
		$activity->update($request->all());

		return redirect()->route('activities.show', $activity->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Activity $activity)
	{
		$this->authorize('destroy',$activity);
		$activity->delete();

		return redirect()->route('activities.index')->with('message', 'Deleted successfully.');
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
            $result = $uploader->save($request->upload_file, 'activities', \Auth::id(), 1024);
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