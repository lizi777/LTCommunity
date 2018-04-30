<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;

class ActivitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$activities = Activity::paginate();
		return view('activities.index', compact('activities'));
	}

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

	public function create(Activity $activity)
	{
		return view('activities.create_and_edit', compact('activity'));
	}

	public function store(ActivityRequest $request)
	{
		$activity = Activity::create($request->all());
		return redirect()->route('activities.show', $activity->id)->with('message', 'Created successfully.');
	}

	public function edit(Activity $activity)
	{
        $this->authorize('update', $activity);
		return view('activities.create_and_edit', compact('activity'));
	}

	public function update(ActivityRequest $request, Activity $activity)
	{
		$this->authorize('update', $activity);
		$activity->update($request->all());

		return redirect()->route('activities.show', $activity->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Activity $activity)
	{
		$this->authorize('destroy', $activity);
		$activity->delete();

		return redirect()->route('activities.index')->with('message', 'Deleted successfully.');
	}
}