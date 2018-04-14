<?php

namespace App\Http\Controllers;

use App\Models\Class;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;

class ClassesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$classes = Class::paginate();
		return view('classes.index', compact('classes'));
	}

    public function show(Class $class)
    {
        return view('classes.show', compact('class'));
    }

	public function create(Class $class)
	{
		return view('classes.create_and_edit', compact('class'));
	}

	public function store(ClassRequest $request)
	{
		$class = Class::create($request->all());
		return redirect()->route('classes.show', $class->id)->with('message', 'Created successfully.');
	}

	public function edit(Class $class)
	{
        $this->authorize('update', $class);
		return view('classes.create_and_edit', compact('class'));
	}

	public function update(ClassRequest $request, Class $class)
	{
		$this->authorize('update', $class);
		$class->update($request->all());

		return redirect()->route('classes.show', $class->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Class $class)
	{
		$this->authorize('destroy', $class);
		$class->delete();

		return redirect()->route('classes.index')->with('message', 'Deleted successfully.');
	}
}