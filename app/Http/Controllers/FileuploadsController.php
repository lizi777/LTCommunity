<?php

namespace App\Http\Controllers;

use App\Models\Fileupload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileuploadRequest;
use App\Handlers\FileUploadHandler;
use Auth;

class FileuploadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$fileuploads = Fileupload::paginate(5);
		return view('fileuploads.index', compact('fileuploads'));
	}

    public function show(Fileupload $fileupload)
    {
        return view('fileuploads.show', compact('fileupload'));
    }

	public function create(Fileupload $fileupload)
	{
		return view('fileuploads.create_and_edit', compact('fileupload'));
	}

	public function store(FileuploadRequest $request, FileUploadHandler $uploader)
	{
// return dd($request->file->getClientOriginalName());
    	$fileupload = Fileupload::create([
            'class_id' => Auth::user()->class_id,
            'filename' => $request->file->getClientOriginalName(),
            'filepath' => current($uploader->save($request->file,'file',$request->class_id,'f')),
        ]);

		//$fileupload = Fileupload::create($request->all());
		
		
		return redirect()->route('fileuploads.index')->with('success', '上传成功！');
	}

	public function edit(Fileupload $fileupload)
	{
        $this->authorize('update', $fileupload);
		return view('fileuploads.create_and_edit', compact('fileupload'));
	}

	public function update(FileuploadRequest $request, Fileupload $fileupload)
	{
		$this->authorize('update', $fileupload);
		$fileupload->update($request->all());

		return redirect()->route('fileuploads.show', $fileupload->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Fileupload $fileupload)
	{
		$this->authorize('destroy', $fileupload);
		$fileupload->delete();

		return redirect()->route('fileuploads.index')->with('message', 'Deleted successfully.');
	}
}